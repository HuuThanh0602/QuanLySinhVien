<?php

namespace App\Models;

use App\Models\Traits\HasStudent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasStudent;
    use SoftDeletes;
    protected $cats = ['deleted_at' => 'datetime'];
    protected $fillable = [
        'name',
        'description'
    ];
}
