<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Repositories\Result\ResultRepositoryInterface;
use App\Repositories\Subject\SubjectRepositoryInterface;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(private SubjectRepositoryInterface $subjectRepository, private ResultRepositoryInterface $resultRepository)
    {
        
    }
    public function index()
    {
        $subjects=$this->subjectRepository->getAll();
        return view('student.register',compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function register(Request $request)
    {
        $this->resultRepository->store($request->all());
        return redirect()->route('student.register.index')->with('success','Dang ky thanh cong');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
