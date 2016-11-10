<?php

namespace App\Http\Requests\PermisoZarpe;

use App\Http\Requests\Request;

class UpdatePermisoZarpeRequest extends Request
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
                'nMatricula'            =>  'required|max:50',
                'longitud'              =>  'required|numeric',
                'latitud'               =>  'required|numeric',
                'fechaZarpe'            =>  'required',
                'fechaArribo'           =>  'required',
                'puerto'                =>  'integer',
                'capitania'             =>  'integer',
        ];
    }
}
