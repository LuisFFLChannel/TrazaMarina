<?php

namespace App\Http\Requests\Transportista;

use App\Http\Requests\Request;

class StoreTransportistaRequest extends Request
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
            'nombres'           =>  'required|max:100',
            'apellidos'         =>  'required|max:100',
            'dni'               =>  'required|integer|unique:transportista',
            'telefono'          =>  'required|integer',
            'correo'            =>  'required|max:100',
            'brevete'           =>  'required|max:10'
        ];
    }
}
