<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResultRequest;
use App\Repositories\Result\ResultRepositoryInterface;
use Illuminate\Http\Request;

class AdminResultController extends Controller
{
    public function __construct(
        private ResultRepositoryInterface $resultRepository,
    ) {}

    public function index()
    {
        $students = $this->resultRepository->getResult();
        return view('admin.result.index', compact('students'));
    }

    public function show($id)
    {
        $results = $this->resultRepository->getSubjectLearned($id);
        $gpa = $results[1];
        $results = $results[0];
        return view('admin.result.detail', compact('results', 'gpa', 'id'));
    }

    public function store(ResultRequest $request)
    {
        if ($this->resultRepository->enterScore($request->except('_token'))) {
            session()->flash('success', __('messages.success.update'));
            return response()->json([
                'success' => true,
            ]);
        };

        return response()->json([
            'success' => false,
        ]);
    }

    public function importExcel(Request $request)
    {
        $import = $this->resultRepository->importExcel($request->file('file_excel'));
        if ($import['success']) {
            return back()->with('success', __('messages.success.update'));
        };
    }



    //yc2
    public function updateScore()
    {
        if ($this->resultRepository->updateScore()) {
            return back()->with('success', __('messages.success.update'));
        }
        return back()->with('error', __('messages.error.update'));
    }
}
