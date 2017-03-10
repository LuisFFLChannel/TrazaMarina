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
            'codigo'                =>  'required|max:50',
            'libro'                 =>  'required|max:10',
            'folio'                 =>  'required|max:10',
            'nombreDueno'           =>  'required|max:100',
            'apellidosDueno'        =>  'required|max:100',
            'dniDueno'              =>  'required|integer',
            'nombreEmbarcacion'     =>  'required|max:100',
            'nMatricula'            =>  'required|max:50|unique:certificadoMatricula,nMatricula,'.$this->id,
            'pdf'                   =>  'mimes:pdf'
        ];
    }
}
