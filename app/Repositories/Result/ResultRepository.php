<?php
namespace App\Repositories\Result;

use App\Models\Student;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ResultRepository extends BaseRepository implements ResultRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Result::class;
    }
    public function store($attributes){
        $attributes=array_values($attributes);
        $getIdStudent=Student::where('user_id',21)->value('id');
        $register=[];
        foreach($attributes as $attribute){
            $register[]=['student_id'=>$getIdStudent,
                    'subject_id'=>$attribute];
        }
        DB::transaction(function() use($register){
            foreach($register as $rig){
                $this->getModel()::create($rig);
            }
        } );
        
    }
}