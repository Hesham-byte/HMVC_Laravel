<?php

namespace Modules\Advertises\app\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AdvertiseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name_en' => 'required',
            'name_ar' => 'required',
            'description_en' => 'nullable',
            'description_ar' => 'nullable',
            'image' => 'nullable|mimes:png,jpg,jpeg,webp,svg,gif|max:1000',
            'send_directly' => 'nullable',
            'start_date' => 'nullable|date|after:now',
            'end_date' =>  'nullable|date|after:start_date',
            'famous_ids.*'=>'nullable'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
