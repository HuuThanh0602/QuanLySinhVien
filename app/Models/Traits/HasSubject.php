<?php

namespace App\Models\Traits;

use App\Models\Subject;

trait HasSubject
{
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'results')
            ->withPivot('score')
            ->withTimestamps();
    }
}
