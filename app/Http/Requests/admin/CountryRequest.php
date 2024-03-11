<?php

namespace App\Http\Requests\admin;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $flag =  request()->isMethod('put') ?
            'nullable|mimes:png,jpg,jpeg,webp,svg,gif|max:1000' :
            'required|mimes:png,jpg,jpeg,webp,svg,gif|max:1000';
        return [
            'name_en' => 'required|max:100',
            'name_ar' => 'required|max:100',
            'iso_code_2' => 'required|max:2',
            'iso_code_3' => 'required|max:3',
            'flag' => $flag,
            'country_code' => 'required|max:10',
            'is_active' => 'nullable',

        ];
    }
}
