<?php

namespace App\Http\Controllers\admin;

use App\Constant;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Repositories\Department\DepartmentRepositoryInterface;
use Illuminate\Contracts\View\View;

class DepartmentController extends Controller
{

    public function __construct(
        private DepartmentRepositoryInterface $departmentRepository
    ) {}

    public function index()
    {
        $departments = $this->departmentRepository->getPaginate(Constant::PAGINATE);
        return view('admin.department.index', compact('departments'));
    }

    public function create():View
    {
        return view('admin.department.create');
    }

    public function store(DepartmentRequest $request)
    {
        if ($this->departmentRepository->store($request->all())) {
            return redirect()->route('admin.department.index')->with('success', __('messages.success.create'));
        };
        return back()->with('error', __('messages.error.create'));
    }

    public function edit(string $id)
    {
        $department = $this->departmentRepository->find($id);
        return view('admin.department.edit', compact('department'));
    }

    public function update(DepartmentRequest $request, string $id)
    {
        if ($this->departmentRepository->update($id, $request->all())) {
            return redirect()->route('admin.department.index')->with('success', __('messages.success.update'));
        };
        return back()->with('error', __('messages.error.update'));
    }

    public function destroy(string $id)
    {
        if ($this->departmentRepository->destroyDepartment($id)) {
            return back()->with('success', __('messages.success.delete'));
        };
        return back()->with('error', __('messages.error.delete'));
    }
}
