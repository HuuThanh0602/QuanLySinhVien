<?php

namespace App\Jobs;

use App\Mail\SendResult;
use App\Models\Student;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendResultJob implements ShouldQueue
{
    use Queueable;
    public function __construct()
    {
        //
    }

    public function handle(): void
    {
        $students = Student::join('users', 'students.user_id', '=', 'users.id')
            ->join('results', 'students.id', '=', 'results.student_id')
            ->whereNotNull('results.score')
            ->groupBy('students.id', 'users.email')
            ->selectRaw('students.*, users.email, AVG(results.score) as avg_score')
            ->get();
        foreach ($students as $student) {
            if ($student->avg_score < 5) {
                Mail::to($student->email)->send(new SendResult($students));
            }
        }
    }
}
