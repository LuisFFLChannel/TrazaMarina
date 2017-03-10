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
        $rules = [
            //
                'codigo'                =>  'required|max:50',
                'embarcacion_id'                     =>  'required|integer',
                'longitud'              =>  'required|numeric',
                'latitud'               =>  'required|numeric',
                'zonaPesca'             =>  'required|max:150',
                'fechaZarpe'            =>  'required',
                'fechaArribo'           =>  'required',
                'puerto_id'             =>  'required|integer',
                'capitania_id'          =>  'required|integer',
                'pescadores_id'         =>  'required',
                'patrones_id'           =>  'required',
                'pdf'                   =>  'mimes:pdf'
        ];
        $pescadores = $this->request->get('pescadores_id');
        //dd($pescadores);
        if($pescadores)
        foreach($pescadores as $key=>$val){
            $rules['pescadores_id.'.$key]  = 'required';
            //$rules['start_time.'.$key]  = 'required_with:start_date';

        }
        return $rules;
    }
}
