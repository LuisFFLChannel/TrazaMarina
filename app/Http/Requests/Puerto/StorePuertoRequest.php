<?php

namespace App\Http\Requests\Puerto;

use App\Http\Requests\Request;

class StorePuertoRequest extends Request
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
            'nombre'                =>  'required|max:100',
            'direccion'             =>  'required|max:150',
            'longitud'           =>  'required|numeric',
            'latitud'           =>  'required|numeric',
             'contacto'               =>  'required|max:100',
            'categoriaPuerto_id'        =>  'required',
            'capitania_id'             =>  'required',
            'imagen'                =>  'image'
        ];
    }
}
