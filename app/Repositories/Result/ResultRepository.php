<?php

namespace App\Repositories\Result;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ResultsImport;
use App\Models\Student;
use App\Repositories\BaseRepository;
use App\Repositories\Student\StudentRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ResultRepository extends BaseRepository implements ResultRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Result::class;
    }

    public function register($attributes)
    {
        $studentId = Student::where('user_id', Auth::user()->id)->value('id');
        if (!$studentId) {
            return false;
        }

        $register = collect($attributes)->map(function ($a) use ($studentId) {
            return [
                'student_id' => $studentId,
                'subject_id' => $a,
                'created_at' => now(),
            ];
        })->toArray();
        try {
            return DB::transaction(function () use ($register) {
                return $this->getModel()::insert($register) > 0;
            });
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getSubjectLearned($id)
    {
        $idStudent = $id ?? Student::where('user_id', Auth::user()->id)->pluck('id')->first();

        $subjectLearned = $this->getModel()::with('subject')
            ->where('student_id', $idStudent)
            ->get(['student_id', 'subject_id', 'score']);

        $results = $subjectLearned->map(function ($learned) {
            return [
                'subject_id' => $learned->subject_id,
                'subject_name' => $learned->subject->name ?? 'N/A',
                'score' => $learned->score,
            ];
        });
        $validScore = $subjectLearned->whereNotNull('score')->pluck('score');
        $gpa = $validScore->isNotEmpty() ? round($validScore->avg(), 2) : 0;
        return [$results, $gpa];
    }

    public function getResult()
    {
        $students = Student::with('results:student_id,score')->get(['id', 'full_name']);
        $studentResults  = $students->map(function ($student) {
            $studentResults = $student->results ?? collect();
            return [
                'id' => $student->id,
                'full_name' => $student->full_name,
                'count' => $studentResults->count(),
                'gpa' => $studentResults->isNotEmpty() ? round($studentResults->avg('score'), 2) : 0,
            ];
        });

        return $studentResults;
    }

    public function updateScore()
    {
        $students = Student::whereHas('results')->with('results')->get('id');

        $studentGpas = $students->map(function ($student) {
            $scores = $student->results->pluck('score')->filter();
            return [
                'id' => $student->id,
                'gpa' => $scores->isNotEmpty() ? round($scores->avg(), 2) : null,
            ];
        })->filter(fn($s) => $s['gpa'] !== null);

        $lowestStudent = $studentGpas->firstWhere('gpa', $studentGpas->min('gpa'));
        $student = $students->find($lowestStudent['id']);

        $syncData = [];
        foreach ($student->subjects as $subject) {
            $syncData[$subject->id] = ['score' => 10];
        }
        if ($student->subjects()->sync($syncData)) {
            return true;
        }
        return false;
    }


    public function enterScore($score)
    {
        $scoreUpdates = [];
        foreach ($score['subject_id'] as $key => $subjectId) {
            $scoreUpdates[$subjectId] = ['score' => $score['score'][$key]];
        }

        $student = Student::find($score['student_id'])->load('subjects');

        if ($student) {

            foreach ($student->subjects as $subject) {
                if (isset($scoreUpdates[$subject->id])) {
                    $subject->pivot->score = $scoreUpdates[$subject->id]['score'];
                    $subject->pivot->save();
                    unset($scoreUpdates[$subject->id]);
                } else {
                    $subject->pivot->score = null;
                    $subject->pivot->save();
                }
            }
        }

        return true;
    }



    public function importExcel($fileExcel)
    {
        $import = new ResultsImport();

        try {
            return DB::transaction(function () use ($fileExcel, $import) {
                Excel::import($import, $fileExcel);
                return [
                    'success' => true,
                    'message' => 'Import thành công!',
                ];
            });
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Import thất bại: ' . $e->getMessage()
            ];
        }
    }
}
