<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Repositories\Result\ResultRepositoryInterface;

class ResultController extends Controller
{
    public function __construct(private ResultRepositoryInterface $resultRepository) {}

    public function index()
    {
        $results = $this->resultRepository->getSubjectLearned(null);
        $gpa = $results[1];
        $results = $results[0];
        return view('student.result', compact('results', 'gpa'));
    }
}
