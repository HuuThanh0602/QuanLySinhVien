<?php
namespace App\Repositories\Interfaces;

interface DepartRepositoriesInterface
{
    public function getAllDepart();
    public function getDepartmentbyId($departmentId);
    public function deleteDepartment($departmentId);
    public function softDeleteDepartment($departmentId);
    public function createDepartment(array $departDetails);
    public function updateDepartment($departmentId , array $newDetails);
}