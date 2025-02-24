<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
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
            'description'=>'max:255',
        ];
    }
    public function messages()
    {
        return[
            'name.required'=>__('validation.required',['attribute'=>__('common.subject_name')]),
            'name.max'=>__('validation.max.string',['attribute'=>__('common.subject_name'),'max'=>50]),
            'description.max'=>__('validation.max.string',['attribute'=>__('common.description'),'max'=>50]),
        ];
    }
}
