<?php

namespace App\Repositories\Student;

use App\Repositories\BaseRepository;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentRepository extends BaseRepository implements StudentRepositoryInterface
{
    public function getModel(){
        return \App\Models\Student::class;
    }
    public function prefix($attribute){
        $vina=['081', '082', '083', '084', '085', '087', '091', '094'];
        $viettel = ['032', '033', '034', '035', '036', '037', '038', '039', '086', '096', '097', '098'];
        $mobi = ['070', '076', '077', '078', '079', '089', '090', '093'];
        $prefixes =[];
        if($attribute['carrier']=='vina'){
            $prefixes = $vina;
        }
        elseif($attribute['carrier']=='viettel'){
            $prefixes=$viettel;
        }
        elseif($attribute['carrier']=='mobi'){
            $prefixes=$mobi;
        }
        return $prefixes;
    }
    public function age_from($attribute){
        return Carbon::now()->subYears($attribute['age_to']+1)->format('Y-m-d');
    }
    public function age_to($attribute){
        return Carbon::now()->subYears($attribute['age_from']-1)->format('Y-m-d');
    }
    public function search($paginate, $attribute)
    {
        $student=$this->model->with('user','department');
        if(empty($attribute)){
            return $student->paginate($paginate);
        }
        if(!empty($attribute['age_from']) && !empty($attribute['age_to']) && !empty($attribute['carrier']) && !empty($attribute['score_from'] && !empty($attribute['score_to'] && !empty($attribute['finished_level'])))){
            $student=$student->whereBetween('day_of_birth',[$this->age_from($attribute),$this->age_to($attribute)])
                            ->whereBetween('day_of_birth',[$this->age_from($attribute),$this->age_to($attribute)]) ;
            $prefixes=$this->prefix($attribute);
            $student = $student->where(function ($query) use ($prefixes) {
                foreach ($prefixes as $prefix) {
                    $query->orWhere('phone', 'like', $prefix . '%');
                }
            });
        }
        else{
            if(empty($attribute['carrier'])){
                if(!empty($attribute['age_from']) && !empty($attribute['age_to'])){ 
                    $student=$student->whereBetween('day_of_birth',[$this->age_from($attribute),$this->age_to($attribute)]);
                }
                
                elseif(!empty($attribute['age_to'])){
                    $student=$student->where('day_of_birth','>=',$this->age_from($attribute));
                }
                elseif(!empty($attribute['age_from'])){
                    $student=$student->where('day_of_birth','<=',$this->age_to($attribute));
                }
            }
            else{
                $prefixes=$this->prefix($attribute);
                if(!empty($attribute['age_from'])){
                    $student=$student->where('day_of_birth','<=',$this->age_to($attribute));
                    $student = $student->where(function ($query) use ($prefixes) {
                        foreach ($prefixes as $prefix) {
                            $query->orWhere('phone', 'like', $prefix . '%');
                        }
                    });
                }
                elseif(!empty($attribute['age_to'])){
                    $student=$student->where('day_of_birth','>=',$this->age_from($attribute));
                    $student = $student->where(function ($query) use ($prefixes) {
                        foreach ($prefixes as $prefix) {
                            $query->orWhere('phone', 'like', $prefix . '%');
                        }
                    });
                }
            }
        }
        return $student->paginate($paginate)->appends(request()->query());
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