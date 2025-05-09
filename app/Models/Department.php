<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;
    protected $cats = ['deleted_at' => 'datetime'];
    protected $fillable = [
        'name',
        'description'
    ];
}
