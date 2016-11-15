<?php

namespace App\Http\Requests\EmpresarioComercializador;

use App\Http\Requests\Request;

class StoreEmpresarioComercializadorRequest extends Request
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
            'apellidos'         =>  'required|max:100',
            'dni'               =>  'required|integer|unique:pescadores',
            'telefono'          =>  'required|integer',
            'correo'            =>  'required|email|max:100',
            'nombreEmpresa'     =>  'required|max:100',
            'ruc'               =>  'required|max:50'
        ];
    }
}
