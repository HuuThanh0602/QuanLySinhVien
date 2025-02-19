<?php
namespace App\Repositories\BaseRepositories;

use App\Models\Department;
use App\Repositories\Interfaces\DepartRepositoriesInterface;

class DepartRepository implements DepartRepositoriesInterface
{

    public function getAllDepart()
    {
        return Department::whereNULL('deleted_at')->paginate(1);
    }
    public function getDepartmentbyId($departmentId)
    {
        return Department::findOrfail($departmentId);
    }
    public function deleteDepartment($departmentId)
    {
        return Department::destroy($departmentId);
    }
    public function softDeleteDepartment($departmentId)
    {
        return Department::whereId($departmentId)->update(['deleted_at'=>now()]);
    }
    public function createDepartment(array $departDetails)
    {
        return Department::create($departDetails);
    }
    public function updateDepartment($departmentId , array $newDetails)
    {
        return Department::whereId($departmentId)->update($newDetails);
    }
}