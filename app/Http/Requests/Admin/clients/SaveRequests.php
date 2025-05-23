<?php

namespace App\Http\Requests\Admin\clients;

use Illuminate\Foundation\Http\FormRequest;

class SaveRequests extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'client_code'          => 'required|string|max:255|unique:tbl_clients,client_code',
            'name'                 => 'required|string|max:255',
            'phone'                => 'nullable|string|max:15',
            'email'                => 'nullable|email|max:255',
            'address1'             => 'nullable|string|max:255',
            'address2'             => 'nullable|string|max:255',
//            'image'                => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
         //   'commercial_register'  => 'nullable|numeric|digits_between:1,15',
            'balance'              => 'nullable|numeric|min:0',
            'governate'         => 'required|exists:tbl_area_settings,id',
            'city'              => 'nullable|exists:tbl_area_settings,id',
            'notes'                => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'client_code.required'          => trans('clients.client_code_required'),
            'client_code.unique'            => trans('clients.client_code_unique'),
            'name.required'                 => trans('clients.name_required'),
            'phone.required'                => trans('clients.phone_required'),
            'email.email'                   => trans('clients.email_invalid'),
//            'image.image'                   => trans('clients.image_invalid'),
//            'image.mimes'                   => trans('clients.image_format_invalid'),
//            'image.max'                     => trans('clients.image_size_invalid'),
            'commercial_register.numeric'   => trans('clients.commercial_register_numeric'),
            'governate.required'         => trans('clients.governate_required'),
            'governate.exists'           => trans('clients.governate_invalid'),
            'city.exists'                => trans('clients.area_invalid'),
        ];
    }
}
