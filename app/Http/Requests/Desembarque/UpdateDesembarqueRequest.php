<?php

namespace App\Http\Requests\Desembarque;

use App\Http\Requests\Request;

class UpdateDesembarqueRequest extends Request
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
            
            'embarcacion_id'                =>  'required|integer',
            'dpa_id'                        =>  'required|integer',
            'fechaLlegada'                  =>  'required',
            'puerto_id'                     =>  'required|integer',
            'especies_id'                   =>  'required',
            'toneladas'                     =>  'required',
            'tallas'                =>  'required'
        ];
                $especies = $this->request->get('especies_id');
        
        if($especies)
        foreach($especies as $key=>$val){
            $rules['especies_id.'.$key]              = 'required|integer';
            $rules['toneladas.'.$key]               = 'required|numeric|min:0';
            $rules['tallas.'.$key]           = 'required|numeric|min:0';
            //$rules['start_time.'.$key]  = 'required_with:start_date';

        }

        return $rules;
    }
}
