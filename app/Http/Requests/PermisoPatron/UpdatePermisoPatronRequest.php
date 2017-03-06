<?php

namespace App\Http\Requests\PermisoPatron;

use App\Http\Requests\Request;

class UpdatePermisoPatronRequest extends Request
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
            'dni'                   =>  'required|integer|unique:permisoPatron,dni,'.$this->id,
            'numeroPatron'          =>  'required|max:50|unique:permisoPatron,numeroPatron,'.$this->id,
            'fechaVigencia'         =>   'required'
        ];
    }
}
