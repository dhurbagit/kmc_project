<?php

namespace App\Domains\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EvaluationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // For update support (route model binding or id)
        $id = optional($this->route('evaluation'))->id ?? $this->route('evaluation');

        return [
            'program_id' => [
                'required',
                'integer',
                'exists:programs,id',
            ],

            'indicator_id' => [
                'required',
                'integer',
                'exists:indicators,id',
            ],

            'year' => [
                'nullable',
                'digits:4',
                'integer',
                'min:2000',
                'max:2100',
            ],

            'period' => [
                'nullable',
                'string',
                'max:20',
            ],

            'value' => [
                'nullable',
                'numeric',
            ],

            'progress_percent' => [
                'required',
                'integer',
                'min:0',
                'max:100',
            ],

            'notes' => [
                'nullable',
                'string',
            ],

            // Prevent duplicate evaluation for same program + indicator + year + period
            'indicator_id' => [
                'required',
                'integer',
                'exists:indicators,id',
                Rule::unique('evaluations')
                    ->ignore($id)
                    ->where(fn ($q) => $q
                        ->where('program_id', $this->input('program_id'))
                        ->where('year', $this->input('year'))
                        ->where('period', $this->input('period'))
                    ),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'program_id.required'   => 'The program field is required.',
            'program_id.exists'     => 'The selected program is invalid.',

            'indicator_id.required' => 'The indicator field is required.',
            'indicator_id.exists'   => 'The selected indicator is invalid.',
            'indicator_id.unique'   => 'This indicator evaluation already exists for the selected program, year, and period.',

            'year.digits' => 'The year must be a 4-digit value (e.g. 2024).',
            'year.min'    => 'The year must be 2000 or later.',
            'year.max'    => 'The year must not exceed 2100.',

            'period.max' => 'The period may not be greater than 20 characters.',

            'value.numeric' => 'The value must be a numeric value.',

            'progress_percent.required' => 'The progress percent field is required.',
            'progress_percent.integer'  => 'The progress percent must be an integer.',
            'progress_percent.min'      => 'The progress percent cannot be less than 0.',
            'progress_percent.max'      => 'The progress percent cannot exceed 100.',

            'notes.string' => 'The notes field must be text.',
        ];
    }
}
