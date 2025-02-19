<?php
namespace App\Repositories\Interfaces;

interface StudentRepositoriesInterface
{
    public function getAllStudents();
    public function getStudentById($studentId);
    public function deleteStudent($studentId);
    public function createStudent(array $studentDetails);
    public function updateStudent($studentId, array $newDetails);
}