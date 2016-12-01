<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;

class UpdateAdminRequest extends Request
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
        return [
        //
              'name'     => 'required|max:100',
              'lastname' => 'required|max:100',
              'password' => '',
              'di'       => 'required|integer|digits:8|unique:users,di,'.$this->input('id').',id,role_id,4|unique:users,di,'.$this->input('id').',id,role_id,5|unique:users,di,'.$this->input('id').',id,role_id,6|unique:users,di,'.$this->input('id').',id,role_id,7',
              'address'  => 'required|max:100', 
              'phone'    => 'required|integer|digits_between:7,9',
              'email'    => 'required|unique:users,email,'.$this->input('id'), 
              'birthday' => 'date|required',
              'role_id'  => 'required',
            
        ];
    } 
}
