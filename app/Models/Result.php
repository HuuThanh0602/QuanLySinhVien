<?php

namespace App\Models;

use App\Models\Traits\HasSubject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Result extends Model
{
    use HasSubject;
    use SoftDeletes;
    protected $cats = ['deleted_at' => 'datetime'];
    protected $fillable = [
        'student_id',
        'subject_id',
        'score'
    ];
}
