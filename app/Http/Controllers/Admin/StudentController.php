<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Repositories\Department\DepartmentRepositoryInterface;
use Illuminate\Http\Request;
use App\Repositories\Student\StudentRepositoryInterface;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(private StudentRepositoryInterface $studentRepository, private DepartmentRepositoryInterface $departmentRepository)
    {
    }
    public function index()
    {
        $students = $this->studentRepository->getPaginate(2);
        return view('admin.student.index',compact('students'));   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments=$this->departmentRepository->getAll();
        return view('admin.student.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
       
        $this->studentRepository->store($request->all());
        return redirect()->route('admin.student.index')->with('success',__('messages.success.create'));
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
        $departments=$this->departmentRepository->getAll();
        $student=$this->studentRepository->find($id);
        return view('admin.student.edit',compact('departments','student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, string $id)
    {
        $this->studentRepository->update($id,$request->all());
        return redirect()->route('admin.student.index')->with('success',__('messages.success.update'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->studentRepository->destroy($id);
        return redirect()->route('admin.student.index')->with('success',__('messages.success.delete'));
    }
}
