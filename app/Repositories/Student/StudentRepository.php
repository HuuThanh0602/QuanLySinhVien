<?php

namespace App\Repositories\Student;

use App\Constant;
use App\Jobs\SendWelcomeJob;
use App\Mail\SendResult;
use App\Mail\WelcomeEmail;
use App\Models\Result;
use App\Models\Student;
use App\Models\Subject;
use App\Repositories\BaseRepository;
use App\Models\User;
use App\Repositories\Subject\SubjectRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Mockery\Matcher\Subset;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class StudentRepository extends BaseRepository implements StudentRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Student::class;
    }

    public function prefix($attribute)
    {
        $prefixes = [
            'vina' => ['081', '082', '083', '084', '085', '087', '091', '094'],
            'viettel' => ['032', '033', '034', '035', '036', '037', '038', '039', '086', '096', '097', '098'],
            'mobi' => ['070', '076', '077', '078', '079', '089', '090', '093']
        ];
        return $prefixes[$attribute] ?? [];
    }

    public function age($attribute)
    {
        return Carbon::now()->subYears($attribute)->format('Y-m-d');
    }

    public function search($paginate, $attribute)
    {

        $paginate = $paginate['paginate'] ?? Constant::PAGINATE;
        //dd($attribute);

        $students = $this->model->with('user', 'department');

        if (!empty($attribute['department'])) {
            $students = $students->where('department_id', $attribute['department']);
        }

        if (!empty($attribute['age_from'])) {
            $students->where('day_of_birth', '<=', $this->age($attribute['age_from']));
        }

        if (!empty($attribute['age_to'])) {
            $students->where('day_of_birth', '>=', $this->age($attribute['age_to'] + 1));
        }

        if (!empty($attribute['carrier'])) {
            $prefixes = $this->prefix($attribute['carrier']);
            $students  =  $students->where(function ($query) use ($prefixes) {
                foreach ($prefixes as $prefix) {
                    $query->orWhere('phone', 'like', "$prefix%");
                }
            });
        }

        if (!empty($attribute['finished_level'])) {
            $countSubject = Subject::count();
            $students = $students->whereIn('id', function ($query) use ($countSubject, $attribute) {
                $query->select('student_id')
                    ->from('results')
                    ->groupBy('student_id')
                    ->havingRaw('COUNT(student_id) ' . ($attribute['finished_level'] === 'finished' ? '=' : '!=') . ' ?', [$countSubject]);
            });
        }

        if (!empty($attribute['score_from']) || !empty($attribute['score_to'])) {

            $students = $students->join('results', 'students.id', '=', 'results.student_id')
                ->selectRaw('students.*,AVG(results.score) as avg_score')
                ->groupBy('students.id');
            // $students=$students->withAvg('results','score');
            if (!empty($attribute['score_from'])) {
                $students->having('avg_score', '>=', $attribute['score_from']);
            }

            if (!empty($attribute['score_to'])) {
                $students->having('avg_score', '<=', $attribute['score_to']);
            }
        }

        return $students->paginate($paginate)->appends(request()->query());
    }

    public function storeStudent($attribute)
    {
        $sql1 = $attribute['slq1'] ?? null;;
        $attribute = [
            'user' => [
                'email' => $attribute['email'],
                'password' => 'tlu@' . $attribute['phone'],
                'role' => 'student',
            ],
            'student'  => array_diff_key($attribute, ['email' => null]) + ['avatar' => 'avatars/avatar.png'],
        ];

        try {
            return DB::transaction(function () use ($attribute, $sql1) {
                $user = User::create($attribute['user']);
                if (!$user) {
                    return false;
                }
                $attribute['student']['user_id'] = $user->id;
                $student = $this->getModel()::create($attribute['student']);
                //dd($student);
                if ($sql1 != null) {
                    $this->createStudent($student);
                }
                if ($student) {
                    dispatch(new SendWelcomeJob($attribute['user']['email'], $attribute));
                }
                return $student;
            });
        } catch (\Exception) {
            return false;
        }
    }
    //tạo một sinh viên thuộc khoa B có điểm tất cả các môn học = 5 và tuổi = 50;
    public function createStudent($student)
    {
        $subjects = Subject::all();
        $dataToAttach = [];

        foreach ($subjects as $subject) {
            $dataToAttach[$subject->id] = ['score' => 5];
        }
        $day_of_birth = $this->age(50);
        $student->update(['day_of_birth' => $day_of_birth]);
        $student->subjects()->sync($dataToAttach);
    }


    public function destroyStudent($id)
    {
        try {
            if (Result::where('student_id', $id)->exists()) {
                return false;
            }
            return DB::transaction(
                function () use ($id) {
                    $student = $this->find($id);
                    $student->user()->delete();
                    return $student->delete();
                }
            );
        } catch (\Exception $e) {
            return false;
        }
    }

    public function destroyYearOld()
    {
        $students = $this->getModel()::where('day_of_birth', '<=', $this->age(31))->get();

        $deleted = 0;

        foreach ($students as $student) {
            if (Result::where('student_id', $student->id)->exists()) {
                continue;
            }

            try {
                DB::transaction(function () use ($student) {
                    $student->user()->delete();
                    $student->delete();
                });
                $deleted++;
            } catch (\Exception $e) {
                continue;
            }
        }
        return $deleted > 0;
    }
}
