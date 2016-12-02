<?php

namespace App\Http\Requests\EspecieMarina;

use App\Http\Requests\Request;

class StoreEspecieRequest extends Request
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
            'nombre'                =>  'required|max:100',
            'nombreCientifico'      =>  'required|max:100',
            'promedioVida'          =>  'required|numeric',
            'tamanoMin'             =>  'required|numeric',
            'tamanoMax'             =>  'required|numeric',
            'inicioVeda'            =>  'required|date',
            'finVeda'               =>  'required|date',
            'pescaPromedio'         =>  'required|numeric',
            'factorHielo'           =>  'required|numeric',
            'imagen'                =>  'required|image'
        ];
    }
}
