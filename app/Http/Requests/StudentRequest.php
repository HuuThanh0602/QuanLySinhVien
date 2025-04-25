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
        $rules = [
            'full_name' => 'required|max:50',
            'day_of_birth' => 'required|date',
            'gender' => 'required',
            'address' => 'required|max:255',
            'phone' => 'required|digits:10',
            'department_id' => 'required',
        ];
        if ($this->route()->getName() == "admin.student.store") {
            $rules['email'] = 'required|unique:users|email';
        }
        return $rules;
    }
}
