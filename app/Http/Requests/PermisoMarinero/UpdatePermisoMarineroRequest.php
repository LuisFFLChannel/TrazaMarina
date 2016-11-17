<?php

namespace App\Http\Requests\PermisoMarinero;

use App\Http\Requests\Request;

class UpdatePermisoMarineroRequest extends Request
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
            'nombres'           =>  'required|max:100',
            'apellidos'        =>  'required|max:100',
            'dni'                   =>  'required|integer|unique:permisoMarinero,dni,'.$this->input('id'),
            'numeroMarinero'        =>  'required|max:50|unique:permisoMarinero,numeroMarineo,'.$this->input('id'),
            'fechaVigencia'         =>   'required'
        ];
    }
}
