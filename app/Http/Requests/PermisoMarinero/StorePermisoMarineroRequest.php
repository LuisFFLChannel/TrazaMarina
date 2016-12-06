<?php

namespace App\Http\Requests\PermisoMarinero;

use App\Http\Requests\Request;

class StorePermisoMarineroRequest extends Request
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
            'codigo'            =>  'required|max:50',
            'nombres'           =>  'required|max:100',
            'apellidos'        =>  'required|max:100',
            'dni'                   =>  'required|integer',
            'numeroMarinero'        =>  'required|max:50|unique:permisoMarinero',
            'fechaVigencia'         =>   'required'
        ];
    }
}
