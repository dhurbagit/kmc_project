<?php

namespace App\Domains\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProgramBudgetsRequest extends FormRequest
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
            'program_id' => 'required|exists:programs,id',
            'allocated_budget' => 'required|numeric|min:0',
            
        ];
    }

    public function messages(): array
    {
        return [
            'program_id.required' => 'The program field is required.',
            'program_id.exists' => 'The selected program is invalid.',
            'allocated_budget.required' => 'The allocated budget field is required.',
            'allocated_budget.numeric' => 'The allocated budget must be a number.',
            'allocated_budget.min' => 'The allocated budget must be at least 0.',
        ];
    }   
}
