<?php

namespace App\Http\Requests\PermisoPesca;

use App\Http\Requests\Request;

class UpdatePermisoPescaRequest extends Request
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
            'nombreEmbarcacion'     =>  'required|max:100',
            'nMatricula'            =>  'required|max:50|unique:permisoPesca,nMatricula,'.$this->id,
            'fechaVigencia'         =>   'required',
            'pdf'                   =>  'mimes:pdf'
        ];
    }
}
