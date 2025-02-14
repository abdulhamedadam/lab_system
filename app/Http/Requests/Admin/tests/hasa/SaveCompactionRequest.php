<?php

namespace App\Http\Requests\Admin\tests\hasa;

use Illuminate\Foundation\Http\FormRequest;

class SaveCompactionRequest extends FormRequest
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
            'test_code' => 'required',
            'test_carried_date' => 'required',
            'proctor_test_date' => 'required',
            'sample_collect_date' => 'required',
            'location' => 'required',
            'proctor_ref' => 'required',
            'test_method' => 'required',
            'material_desc' => 'required',
            'mdd' => 'required',
           // 'moc' => 'required',
          //  'mold_number' => 'required',
            'diameter' => 'required',
            'height' => 'required',
            'mass_mold_sand1' => 'required',
            'mass_mold_sand2' => 'required',
            'mass_empty_sand' => 'required',
            'unit_wt_sand1' => 'required',
            'unit_wt_sand2' => 'required',
            'avg_unit_wt_sand' => 'required',
            'wt_sand_cone' => 'required',
            'sader_num' => 'required',
            'sader_date' => 'required',
            //'volume' => 'required',
            // Dynamic fields for the table
            'point_location-*' => 'nullable',
            'layer_number-*' => 'nullable',
            'can_number-*' => 'nullable',
            'wt_bottle_sand_before-*' => 'nullable',
            'wt_wet_soil-*' => 'nullable',
            'wt_bottle_sand_after-*' => 'nullable',


            'req_compaction-*' => 'nullable',
        ];
    }
}
