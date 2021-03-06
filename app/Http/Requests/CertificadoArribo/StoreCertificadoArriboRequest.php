<?php

namespace App\Http\Requests\CertificadoArribo;

use App\Http\Requests\Request;

class StoreCertificadoArriboRequest extends Request
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
            'codigo'           =>  'required|max:100',
            'nMatricula'            =>  'required|max:50|unique:certificadoArribo',
            'fechaArribo'         =>  'required'
        ];
    }
}
