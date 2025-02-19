<?php
namespace App\Repositories\BaseRepositories;

use App\Models\Departments;
use App\Repositories\Interfaces\DepartRepositoriesInterface;

class DepartRepository implements DepartRepositoriesInterface
{
    public function getAllDepart()
    {
        return Departments::paginate(1);
    }
    public function getDepartbyId($departId)
    {
        return Departments::findOrfail($departId);
    }
    public function deleteDepart($departId)
    {
        return Departments::destroy($departId);
    }
    public function createDepart(array $departDetails)
    {
        return Departments::create($departDetails);
    }
    public function updateDepart($departId , array $newDetails)
    {
        return Departments::whereId($departId)->update($newDetails);
    }
}