<?php

namespace App\Repositories\Subject;

use App\Models\Result;
use App\Models\Student;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

class SubjectRepository extends BaseRepository implements SubjectRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Subject::class;
    }

    public function getSubjectWithStatus()
    {
        $getIdStudent = Student::where('user_id', Auth::id())->value('id');

        $registeredSubjects = Result::where('student_id', $getIdStudent)
            ->pluck('subject_id')
            ->toArray();
        //$this->getSubjectNotStudied($getIdStudent);
        return $this->model->get(['id', 'name', 'description'])->map(function ($subject) use ($registeredSubjects) {
            $isRegistered = in_array($subject->id, $registeredSubjects);
            return [
                'id' => $subject->id,
                'name' => $subject->name,
                'description' => $subject->description,
                'status' => $isRegistered ? 'registered' : 'not_registered',
                'color' => $isRegistered ? 'btn-success' : 'btn-danger'
            ];
        });
    }

    public function destroySubject($id)
    {
        try {
            if (Result::where('subject_id', $id)->exists()) {
                return false;
            }
            return $this->destroy($id);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getSubjectNotStudied($studentId)
    {
        $studiedSubjectIds = Student::find($studentId)
            ->subjects()
            ->pluck('subjects.id')
            ->toArray();
        $subjectsNotStudied = $this->model::whereNotIn('id', $studiedSubjectIds)->get();

        return $subjectsNotStudied;
    }
}
