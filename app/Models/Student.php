<?php

namespace App\Models;

use App\Models\Traits\HasDepartment;
use App\Models\Traits\HasUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasUser;
    use HasDepartment;
    use SoftDeletes;
    protected $cats = ['deleted_at' => 'datetime'];
    protected $fillable=[
        'full_name',
        'day_of_birth',
        'gender',
        'address',
        'phone',
        'user_id',
        'avatar',
        'department_id'
    ];
}
