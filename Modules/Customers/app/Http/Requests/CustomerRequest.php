<?php

namespace Modules\Customers\app\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $id = $this->route('customer')? $this->route('customer')->user_id : ''; 

        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email'=>['required','email',Rule::unique('users')->ignore($id)],
            'mobile_number' => 'required',
            'password'=>'sometimes | confirmed',
            'country_id' => 'required',
            'gander' => 'required'
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
