<?php
namespace App\Repositories\BaseRepositories;

use App\Models\Students;
use App\Repositories\Interfaces\StudentRepositoriesInterface;

class StudentRepository implements StudentRepositoriesInterface
{
    public function getAllStudents(){
        return Students::with('department')->paginate(10);
    }  
    public function getStudentById($studentId){ 
        return Students::findOrFail($studentId);
    }
    public function deleteStudent($studentId)
    {
        return Students::destroy($studentId);
    }
    public function createStudent(array $studentDetails)
    {
        return Students::create($studentDetails);
    }
    public function updateStudent($studentId, array $newDetails)
    {
        return Students::whereId($studentId)->update($newDetails);

    }
    
}
