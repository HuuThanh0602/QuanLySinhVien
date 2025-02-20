<?php
namespace App\Models\Traits;

use App\Models\Subject;

trait HasSubject
{
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}