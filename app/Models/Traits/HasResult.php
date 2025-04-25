<?php

namespace App\Models\Traits;

use App\Models\Result;
use App\Models\Subject;

trait HasResult
{
    public function results()
    {
        return $this->hasMany(Result::class, 'student_id');
    }
}
