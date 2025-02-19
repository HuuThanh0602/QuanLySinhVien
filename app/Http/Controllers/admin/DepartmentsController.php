<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartRequest;
use App\Repositories\Interfaces\DepartRepositoriesInterface;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // private DepartRepositoriesInterface $departRepository;
    public function __construct(private DepartRepositoriesInterface $departRepository)
    {
        // $this->departRepository = $departRepository;
    }
    public function index()
    {
        $departments = $this->departRepository->getAllDepart();   
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
    public function store(DepartRequest $request)
    {
        $this->departRepository->createDepartment($request->validated());
        return redirect()->route('admin.department.index')->with('success','Thêm mới thành công');
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
        $department = $this->departRepository->getDepartmentbyId($id);
        return view('admin.department.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartRequest $request, string $id)
    {
        $this -> departRepository->updateDepartment($id, $request->validated());
        return redirect()->route('admin.department.index')->with('success','Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->departRepository->softDeleteDepartment($id);
        return redirect()->route('admin.department.index')->with('success','Xoá thành công');
    }
}
