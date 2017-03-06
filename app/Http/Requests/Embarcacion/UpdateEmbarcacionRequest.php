<?php

namespace App\Http\Requests\Embarcacion;

use App\Http\Requests\Request;

class UpdateEmbarcacionRequest extends Request
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
            'nMatricula'            =>  'required|max:50|unique:embarcacion,nMatricula,'.$this->id,
            'armador_id'            =>  'required',
            'capacidad'             =>  'required|numeric|min:0',
            'estara'                =>  'required|numeric|min:0',
            'manga'                 =>  'required|numeric|min:0',
            'puntual'               =>  'required|numeric|min:0',
            'imagen'                =>  'image'
        ];
    }
}
