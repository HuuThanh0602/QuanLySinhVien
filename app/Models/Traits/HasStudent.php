<?php
namespace App\Models\Traits;

use App\Models\Student;

trait HasStudent
{
    public function Student()
    {
        return $this->hasMany(Student::class,'student_id');
    }
}