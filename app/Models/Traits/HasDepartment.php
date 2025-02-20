<?php
namespace App\Models\Traits;

use App\Models\Department;

trait HasDepartment
{
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}