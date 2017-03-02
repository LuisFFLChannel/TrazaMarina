<?php

namespace App\Http\Requests\Pesca;

use App\Http\Requests\Request;

class UpdatePescaRequest extends Request
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
            
            'embarcacion_id'                     =>  'required|integer',
            'longitud'                      =>  'required|numeric',
            'latitud'                       =>  'required|numeric',
            'fechaZarpe'                    =>  'required',
            'puerto_id'                     =>  'required|integer',
            'permisoZarpe_id'               =>  'required|integer'
        ];
    }
}
