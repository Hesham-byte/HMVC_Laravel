<?php

namespace Modules\Products\app\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $images =  request()->isMethod('put') ?
            'nullable' :
            'required';

        $master_image =  request()->isMethod('put') ?
            'nullable|mimes:png,jpg,jpeg,webp,svg,gif|max:1000' :
            'required|mimes:png,jpg,jpeg,webp,svg,gif|max:1000';
        return [
            'product_category_id' => 'required|integer',
            'display_id' => 'required',
            'name_en' => 'required',
            'name_ar' => 'required',
            'description_en' => 'required',
            'description_ar' => 'required',
            'brand_name' => 'required',
            'master_image'=>$master_image,
            'is_active' => 'nullable',
            'allow_cash_on_delivery' => 'nullable',
            'auto_update_stock' => 'nullable',
            'show_stock_less_5' => 'nullable',
            'images' => $images,
            'images.*' => 'mimes:jpeg,jpg,png,gif,webp,svg|max:2048',
            'famous_ids.*' => 'nullable',
            'tag_ids.*' => 'nullable',
            'options.*' => 'nullable',
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
