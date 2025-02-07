<?php

namespace App\Http\Requests\Admin\tests;

use Illuminate\Foundation\Http\FormRequest;

class SaveCompactionTesrRequest extends FormRequest
{
    /***********************************************************/
    public function authorize(): bool
    {
        return true;
    }

    /***********************************************************/
    public function rules(): array
    {
        return [
            'test_code' => 'required',
            'test_carried_date' => 'required',
            'proctor_test_date' => 'required',
            'sample_collect_date' => 'required',
            'location' => 'required',
            'proctor_ref' => 'required',
            'test_method' => 'required',
            'material_desc' => 'required',
            'mdd' => 'required',
            'moc' => 'required',
            'mold_number' => 'required',
            'diameter' => 'required',
            'height' => 'required',
            'volume' => 'required',
            // Dynamic fields for the table
            'point_location-*' => 'nullable',
            'layer_number-*' => 'nullable',
            'can_number-*' => 'nullable',
            'wt_wet_soil_can-*' => 'nullable',
            'wt_dry_soil_can-*' => 'nullable',
            'wt_can-*' => 'nullable',
            'wt_wet_soil_gm-*' => 'nullable',
            'req_compaction-*' => 'nullable',
        ];
    }

    /***********************************************************/
    public function messages(): array
    {
        return [
            'required' => 'The :attribute field is required.',
            'numeric' => 'The :attribute must be a number.',
            'min' => 'The :attribute must be at least :min.',
            'max' => 'The :attribute must not exceed :max characters.',
        ];
    }
}
