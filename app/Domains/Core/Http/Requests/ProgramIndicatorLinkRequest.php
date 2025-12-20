<?php

namespace App\Domains\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProgramIndicatorLinkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // If you pass {program_indicator_link} in route model binding, this will work.
        // Otherwise it safely falls back to null.
        $id = optional($this->route('program_indicator_link'))->id ?? $this->route('program_indicator_link') ?? null;

        return [
            'program_id'   => ['required', 'integer', 'exists:programs,id'],
            'indicator_id' => ['required', 'integer', 'exists:indicators,id'],
            'link_type'    => ['required', Rule::in(['direct', 'indirect'])],

            'extent_score' => ['required', 'integer', 'min:0', 'max:5'],

            'evidence_level' => ['required', Rule::in(['discuss', 'research', 'concurrence', 'declare'])],

            'weight' => ['required', 'integer', 'min:1', 'max:255'],

            // Prevent duplicate (program_id + indicator_id + link_type)
            'indicator_id' => [
                'required',
                'integer',
                'exists:indicators,id',
                Rule::unique('program_indicator_links')
                    ->ignore($id)
                    ->where(fn ($q) => $q
                        ->where('program_id', $this->input('program_id'))
                        ->where('link_type', $this->input('link_type'))
                    ),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'program_id.required' => 'The program field is required.',
            'program_id.exists'   => 'The selected program is invalid.',

            'indicator_id.required' => 'The indicator field is required.',
            'indicator_id.exists'   => 'The selected indicator is invalid.',
            'indicator_id.unique'   => 'This program is already linked to this indicator for the selected link type.',

            'link_type.required' => 'The link type field is required.',
            'link_type.in'       => 'The selected link type is invalid.',

            'extent_score.required' => 'The extent score field is required.',
            'extent_score.integer'  => 'The extent score must be an integer.',
            'extent_score.min'      => 'The extent score must be at least 0.',
            'extent_score.max'      => 'The extent score may not be greater than 5.',

            'evidence_level.required' => 'The evidence level field is required.',
            'evidence_level.in'       => 'The selected evidence level is invalid.',

            'weight.required' => 'The weight field is required.',
            'weight.integer'  => 'The weight must be an integer.',
            'weight.min'      => 'The weight must be at least 1.',
        ];
    }
}
