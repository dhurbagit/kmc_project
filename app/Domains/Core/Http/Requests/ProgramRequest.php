<?php

namespace App\Domains\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProgramRequest extends FormRequest
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
            'name_en' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'sector_id' => 'required|exists:sectors,id',
            'sub_sector_id' => 'required|exists:sub_sectors,id',
            'main_program_id' => 'required|exists:main_programs,id',
            'lifecycle_status' => 'required|string|max:100',
            'progress_percent' => 'required|numeric|min:0|max:100',
            'kharcha_sanket' => 'required|string|max:255',

        ];
    }

    public function messages(): array
    {
        return [
            'name_en.required' => 'The English name field is required.',
            'name_en.string' => 'The English name must be a string.',
            'name_en.max' => 'The English name may not be greater than 255 characters.',
            'department_id.required' => 'The department field is required.',
            'department_id.exists' => 'The selected department is invalid.',
            'sector_id.required' => 'The sector field is required.',
            'sector_id.exists' => 'The selected sector is invalid.',
            'sub_sector_id.required' => 'The sub-sector field is required.',   
            'main_program_id.required' => 'The main program field is required.',
            'lifecycle_status.required' => 'The lifecycle status field is required.',
            'lifecycle_status.string' => 'The lifecycle status must be a string.',
            'lifecycle_status.max' => 'The lifecycle status may not be greater than 100 characters.',
            'progress_percent.numeric' => 'The progress percent must be a number.',
            'progress_percent.min' => 'The progress percent must be at least 0.',
            'progress_percent.max' => 'The progress percent may not be greater than 100.',
            'kharcha_sanket.string' => 'The kharcha sanket must be a string.',
            'kharcha_sanket.max' => 'The kharcha sanket may not be greater than 255 characters.',
        ];
    }   
}
