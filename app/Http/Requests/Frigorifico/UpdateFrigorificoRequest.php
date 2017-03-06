<?php

namespace App\Http\Requests\Frigorifico;

use App\Http\Requests\Request;

class UpdateFrigorificoRequest extends Request
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
            'nombre'            =>  'required|max:100',
            'placa'             =>  'required|max:50|unique:frigorifico,placa,'.$this->id,
            'capacidad'          =>  'required|numeric',
            'imagen'          =>  'image'
        ];
    }
}
