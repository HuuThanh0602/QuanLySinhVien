<?php

namespace App\Http\Controllers\admin;

use App\Constant;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequest;
use App\Repositories\Subject\SubjectRepositoryInterface;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function __construct(private SubjectRepositoryInterface $subjectRepository) {}

    public function index()
    {

        $subjects = $this->subjectRepository->getPaginate(Constant::PAGINATE);
        return view('admin.subject.index', compact('subjects'));
    }

    public function create()
    {
        return view('admin.subject.create');
    }

    public function store(SubjectRequest $request)
    {
        if ($this->subjectRepository->store($request->all())) {
            return redirect()->route('admin.subject.index')->with('success', __('messages.success.create'));
        };
        return back()->with('error', __('messages.error.create'));
    }

    public function edit(string $id)
    {
        $subject = $this->subjectRepository->find($id);
        return view('admin.subject.edit', compact('subject'));
    }

    public function update(SubjectRequest $request, string $id)
    {
        if ($this->subjectRepository->update($id, $request->all())) {
            return redirect()->route('admin.subject.index')->with('success', __('messages.success.update'));
        };
        return back()->with('error', __('messages.error.update'));
    }

    public function destroy(string $id)
    {
        if ($this->subjectRepository->destroySubject($id)) {
            return redirect()->route('admin.subject.index')->with('success', __('messages.success.delete'));
        };
        return back()->with('error', __('messages.error.delete'));
    }
}
