<?php

namespace App\Http\Requests\NotaIngreso;

use App\Http\Requests\Request;

class UpdateNotaIngresoRequest extends Request
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
            'especie_id'    => 'required',
            'toneladas' =>  'required|numeric',
            'tallaPromedio' =>  'required|numeric'
            //'toneladasExportacion' =>  'required|numeric',
            //'toneladasMercado' =>  'required|numeric'
        ];
    }
}
