<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;
use App\Services\FileService;

class StoreAdminRequest extends Request
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
              'password' => 'required|max:16',
              'di'       => 'required|integer|digits:8|unique:users,di,NULL,id,role_id,4|unique:users,di,NULL,id,role_id,5|unique:users,di,NULL,id,role_id,6|unique:users,di,NULL,id,role_id,7',
              'address'  => 'required|max:100',
              'phone'    => 'required|integer|digits_between:7,9',
              'email'    => 'required|unique:users',
              'birthday' => 'date|required',
              'role_id'  => 'required|exists:roles,id',
            
        ];
    }
}
