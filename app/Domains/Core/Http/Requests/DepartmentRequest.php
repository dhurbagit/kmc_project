<?php

namespace App\Domains\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
            'code' => 'required|string|max:255|unique:departments,code',
            'name_ne' => 'required|string|max:255|unique:departments,name_ne',
         
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'The Department code is required.',
            'code.string' => 'The Department code must be a string.',
            'code.max' => 'The Department code may not be greater than 255 characters.',
            'name_ne.required' => 'The Department name field is required.',
            'name_ne.string' => 'The Department name must be a string.',
            'name_ne.max' => 'The Department name may not be greater than 255 characters.',
            'name_ne.unique' => 'The Department name already exists.',
        ];
    }   
}

// namespace App\Domains\Core\Http\Requests;

// use Illuminate\Foundation\Http\FormRequest;

// class DepartmentRequest extends FormRequest
// {
//     public function authorize(): bool
//     {
//         return true;
//     }

//     public function rules(): array
//     {
//         return [
//             'name' => 'required|string|max:255|unique:departments,name',
//         ];
//     }
// }
