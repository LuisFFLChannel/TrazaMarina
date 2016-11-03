<?php

namespace App\Http\Requests\CertificadoMatricula;

use App\Http\Requests\Request;

class UpdateCertificadoMatriculaRequest extends Request
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
            'nombreDueno'           =>  'required|max:100',
            'apellidoDueno'         =>  'required|max:100',
            'dniDueno'              =>  'required|numeric|max:8',
            'nMatricula'            =>  'required|max:50'
        ];
    }
}
