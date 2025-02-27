<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Repositories\Department\DepartmentRepositoryInterface;
use Illuminate\Support\Facades\App;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(private DepartmentRepositoryInterface $departmentRepository)
    {
    }
    public function index()
    {
        $departments = $this->departmentRepository->getPaginate(2);       
        return view('admin.department.index', compact('departments'));
        
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.department.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {
        $this->departmentRepository->store($request->all());
        return redirect()->route('admin.department.index')->with('success', __('messages.success.create'));
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
        $department = $this->departmentRepository->find($id);
        return view('admin.department.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, string $id)
    {
        $this -> departmentRepository->update($id, $request->all());
        return redirect()->route('admin.department.index')->with('success', __('messages.success.update'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->departmentRepository->destroy($id);
        return redirect()->route('admin.department.index')->with('success', __('messages.success.delete'));
    }
}
