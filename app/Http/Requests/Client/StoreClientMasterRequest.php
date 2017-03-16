<?php

namespace App\Http\Requests\Client;

use App\Http\Requests\Request;

class StoreClientMasterRequest extends Request
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
            'name'     => 'required|min:3|max:100',
            'lastname' => 'required|min:3|max:100',
            'password' => 'required|min:8|max:16',
            'address'  => 'required|min:3|max:100',
            'phone'    => 'required|integer|digits_between: 7,9',
            'di'       => 'required|integer|digits:8|unique:users,di,NULL,id,role_id,8',
            'email'    => 'required|email|unique:users',
            'birthday' => 'required|date'
        ];
    }
}
