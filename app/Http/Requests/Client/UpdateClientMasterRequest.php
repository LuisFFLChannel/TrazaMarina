<?php

namespace App\Http\Requests\Client;

use App\Http\Requests\Request;
use Auth;

class UpdateClientMasterRequest extends Request
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
            'address'  => 'required|min:3|max:100',
            'phone'    => 'required|integer|digits_between: 7,9',
            //'email' => 'required|email|unique:users',
            'email'    => 'required|email',
            'di'       => 'required|integer|digits:8|unique:users,di,'.Auth::user()->id.',id,role_id,8',
        ];
    }
}
