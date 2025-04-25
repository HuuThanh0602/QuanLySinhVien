<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Repositories\Department\DepartmentRepositoryInterface;
use Illuminate\Http\Request;
use App\Repositories\Student\StudentRepositoryInterface;
use App\Repositories\Subject\SubjectRepositoryInterface;

class StudentController extends Controller
{
    public function __construct(
        private StudentRepositoryInterface $studentRepository,
        private DepartmentRepositoryInterface $departmentRepository,
        private SubjectRepositoryInterface $subjectRepository
    ) {}

    public function index(Request $request)
    {
        $students = $this->studentRepository->search($request->only('paginate'), $request->except('token', 'paginate'));
        $departments = $this->departmentRepository->getAll();


        return view('admin.student.index', compact('students', 'departments'));
    }

    public function create()
    {

        $departments = $this->departmentRepository->getAll();
        return view('admin.student.create', compact('departments'));
    }

    public function store(StudentRequest $request)
    {
        if ($this->studentRepository->storeStudent($request->except('_token'))) {
            return redirect()->route('admin.student.index')->with('success', __('messages.success.create'));
        };
        return back()->with('error', __('messages.error.create'));
    }

    public function edit(string $id)
    {
        $departments = $this->departmentRepository->getAll();
        $student = $this->studentRepository->find($id);
        return response()->json([
            'student' => $student,
            'departments' => $departments
        ]);
    }

    public function update(StudentRequest $request, string $id)
    {
        $attribute = $request->except('_token', '_method');
        if ($this->studentRepository->update($id, $attribute)) {
            session()->flash('success', __('messages.success.update'));
            return response()->json([
                'success' => true,
            ]);
        }
        session()->flash('error', __('messages.error.update'));
        return response()->json([
            'success' => false,
        ]);
    }

    public function destroy(string $id)
    {
        if ($this->studentRepository->destroyStudent($id)) {
            return redirect()->route('admin.student.index')->with('success', __('messages.success.delete'));
        };
        return back()->with('error', __('messages.error.delete'));
    }

    public function destroyYearOld()
    {
        if ($this->studentRepository->destroyYearOld()) {
            return redirect()->route('admin.student.index')->with('success', __('messages.success.delete'));
        }
        return back()->with('error', __('messages.error.delete'));
    }

    public function subjectNotStudied($id)
    {

        $subjectNotStudieds = $this->subjectRepository->getSubjectNotStudied($id);

        return response()->json([
            'subjectNotStudieds' => $subjectNotStudieds,
            'id' => $id
        ]);
    }
}
