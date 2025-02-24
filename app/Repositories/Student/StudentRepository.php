<?php

namespace App\Repositories\Student;

use App\Repositories\BaseRepository;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class StudentRepository extends BaseRepository implements StudentRepositoryInterface
{
    public function getModel(){
        return \App\Models\Student::class;
    }
    public function getPaginate($paginate){
        return $this->model->with('user','department')->paginate($paginate);
    }
    public function store(array $attribute){
        DB::transaction(function()use($attribute){
            $user=User::create($attribute['user']);
            $attribute['student']['user_id']=$user->id;
            $this->getModel()::create($attribute['student']);
        }
        );
    }
    public function destroy($id){
        $student=$this->find($id);
        User::findOrfail($student['user_id'])->delete();
        $student->delete();
    }
    public function update($id,array $attribute){
        $student=$this->find($id);
        User::where('id',$student['user_id'])->update($attribute['user']);
        $this->getModel()::where('id',$student->id)->update($attribute['student']);
    }
}