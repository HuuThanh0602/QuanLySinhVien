<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|max:50',
            'day_of_birth'=>'required|date',
            'gender'=>'required',
            'address'=>'required|max:255',
            'phone'=>'required|digits:10',
            'department'=>'required',
            'email'=>'required|email',
        ];
    }
    public function messages(){
        return [
            'name.required'=>__('validation.required',['attribute'=>__('common.department')]),
            'name.max'=>__('validation.max.string',['attribute'=>__('common.name'),'max'=>50]),
            'day_of_birth.required'=>__('validation.required',['attribute'=>__('common.day_of_birth')]),
            'gender.required'=>__('validation.required',['attribute'=>__('common.gender')]),
            'address.required'=>__('validation.required',['attribute'=>__('common.address')]),
            'address.max'=>__('validation.max.string',['attribute'=>__('common.address'),'max'=>255]),
            'phone.required'=>__('validation.required',['attribute'=>__('common.phone')]),
            'phone.digits'=>__('validation.numeric',['attribute'=>__('common.phone'),'digits'=>10]),
            'phone.unique'=>__('validation.unique',['attribute'=>__('common.phone')]),
            'department.required'=>__('validation.required',['attribute'=>__('common.department')]),
            'email.required'=>__('validation.required',['attribute'=>__('common.email')]),
            'email.email'=>__('validation.email',['attribute'=>__('common.email')]),
            'email.unique'=>__('validation.unique',['attribute'=>__('common.email')]),
        ];
    }
}
