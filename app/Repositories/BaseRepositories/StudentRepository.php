<?php
namespace App\Repositories\BaseRepositories;

use App\Models\Student;
use App\Repositories\Interfaces\StudentRepositoriesInterface;

class StudentRepository implements StudentRepositoriesInterface
{
    public function getAllStudents(){
        return Student::with('department')->paginate(10);
    }  
    public function getStudentById($studentId){ 
        return Student::findOrFail($studentId);
    }
    public function deleteStudent($studentId)
    {
        return Student::destroy($studentId);
    }
    public function createStudent(array $studentDetails)
    {
        return Student::create($studentDetails);
    }
    public function updateStudent($studentId, array $newDetails)
    {
        return Student::whereId($studentId)->update($newDetails);

    }
    
}
