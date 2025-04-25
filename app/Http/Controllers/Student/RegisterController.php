<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Repositories\Result\ResultRepositoryInterface;
use App\Repositories\Subject\SubjectRepositoryInterface;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct(private SubjectRepositoryInterface $subjectRepository, private ResultRepositoryInterface $resultRepository) {}

    public function index()
    {
        $subjects = $this->subjectRepository->getSubjectWithStatus();
        return view('student.register', compact('subjects'));
    }

    public function register(Request $request)
    {
        if ($this->resultRepository->register($request->all())) {
            return redirect()->route('student.register.index')->with('success', __('messages.success.register'));
        };;
        return back()->with('error', __('messages.error.register'));
    }
}
