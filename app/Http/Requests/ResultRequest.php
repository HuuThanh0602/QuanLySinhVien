<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResultRequest extends FormRequest
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
            'subject_id' => 'required|array',
            'subject_id.*' => 'required|exists:subjects,id',
            'score' => 'required|array',
            'score.*' => 'required|numeric|min:0|max:10',

        ];
    }
}
