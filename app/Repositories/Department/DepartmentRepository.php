<?php

namespace App\Repositories\Department;

use App\Models\Student;
use App\Repositories\BaseRepository;

class DepartmentRepository extends BaseRepository implements DepartmentRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Department::class;
    }

    public function destroyDepartment($id)
    {
        try {
            if (Student::where('department_id', '=', $id)->exists()) {
                return false;
            }
            return $this->find($id)->delete();
        } catch (\Exception $e) {
            return false;
        }
    }
}
