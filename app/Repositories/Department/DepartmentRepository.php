<?php
namespace App\Repositories\Department;

use App\Repositories\BaseRepository;

class DepartmentRepository extends BaseRepository implements DepartmentRepositoriesInterface
{
    public function getModel()
    {
        return \App\Models\Department::class;
    }

}
