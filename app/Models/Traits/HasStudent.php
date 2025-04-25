<?php

namespace App\Models\Traits;

use App\Models\Student;

trait HasStudent
{
    public function student()
    {
        return $this->hasMany(Student::class, 'id', 'student_id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'results')
            ->withPivot('score')
            ->withTimestamps();
    }
}
