<?php

namespace App\Repositories\Student;

use App\Repositories\BaseRepository;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentRepository extends BaseRepository implements StudentRepositoryInterface
{
    public function getModel(){
        return \App\Models\Student::class;
    }
    public function getPaginate($paginate){
        return $this->model->with('user','department')->paginate($paginate);
    }
    public function store(array $student){
        $attribute=[
            'user'=>[
                'email'=>$student['email'],
                'password'=>'tlu@'.$student['phone'],
                'role'=>'student',
            ],    
            'student'=>[
                'full_name'=>$student['name'],
                'day_of_birth'=>$student['day_of_birth'],
                'gender'=>$student['gender'],
                'address'=>$student['address'],
                'phone'=>$student['phone'],
                'department_id'=>$student['department'],
            ],       
        ];
        DB::transaction(function()use($attribute){
            $user=User::create($attribute['user']);
            $attribute['student']['user_id']=$user->id;
            $this->getModel()::create($attribute['student']);
        }
        );
    }
    public function destroy($id){
        DB::transaction(function()use($id){
            $student=$this->find($id);
            User::findOrfail($student['user_id'])->delete();
            $student->delete();
        }
        );
        
    }
    public function update($id,array $student){
        $attribute=[
            'user'=>[
                'email'=>$student['email'],
                'password' => Hash::make('tlu@'.$student['phone']),
                'role'=>'student',
            ],    
            'student'=>[
                'full_name'=>$student['name'],
                'day_of_birth'=>$student['day_of_birth'],
                'gender'=>$student['gender'],
                'address'=>$student['address'],
                'phone'=>$student['phone'],
                'department_id'=>$student['department'],
            ],       
        ];
        DB::transaction(function()use($id,$attribute){
            $student=$this->find($id);
            User::where('id',$student['user_id'])->update($attribute['user']);
            $this->getModel()::where('id',$student->id)->update($attribute['student']);
        }
        );
    }
}