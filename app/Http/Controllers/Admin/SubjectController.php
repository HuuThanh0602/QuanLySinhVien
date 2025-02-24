<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequest;
use App\Repositories\Subject\SubjectRepositoryInterface;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(private SubjectRepositoryInterface $subjectRepository)
    {
        
    }
    public function index()
    {
        $subjects=$this->subjectRepository->getPaginate(2);
        return view('admin.subject.index',compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.subject.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubjectRequest $request)
    {
        $this->subjectRepository->store($request->all());
        return redirect()->route('admin.subject.index')->with('success',__('messages.success.create'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subject = $this->subjectRepository->find($id);
        return view('admin.subject.edit',compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubjectRequest $request, string $id)
    {
        $this->subjectRepository->update($id,$request->all());
        return redirect()->route('admin.subject.index')->with('success',__('messages.success.update'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->subjectRepository->destroy($id);
        return redirect()->route('admin.subject.index')->with('success',__('messages.success.delete'));
    }
}
