<?php

namespace App\Http\Requests\admin;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $id = $this->route('user')? $this->route('user')->id : ''; 
        return [
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>['required','email',Rule::unique('users')->ignore($id)],
            // 'role_id'=>'required',
            'mobile_number'=>'sometimes',
            'password'=>'sometimes|confirmed'
        ];
    }
}
