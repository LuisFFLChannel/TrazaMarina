<?php

namespace App\Http\Requests\Desembarque;

use App\Http\Requests\Request;

class StoreDesembarqueRequest extends Request
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
            'tallas'                =>  'required',
        ];
        $especies = $this->request->get('especies_id');
        //dd($especies = $this->request->get('tallas'));
        if($especies)
        foreach($especies as $key=>$val){
            $rules['especies_id.'.$key]              = 'required|integer';
            $rules['toneladas.'.$key]               = 'required|numeric|min:0';
            
            $rules['tallas.'.$key]           = 'required|numeric|min:0';
            
            
        }
        return $rules;
    }
    public function messages(){
        $messages = array();
        
        $especies = $this->request->get('especies_id'); 
        if($especies)
        foreach($especies as $key=>$val)
        {
            $messages['especies_id.'.$key.'.required'] = 'Se deben completar los campos de filas y columnas de la nota de ingreso '.($key+1);
            $messages['toneladas.'.$key.'.required'] = 'Se deben completar los campos de filas y columnas de la nota de ingreso '.($key+1);
            $messages['tallas.'.$key.'.required'] = 'Se deben completar los campos de filas y columnas de la nota de ingreso '.($key+1);
        }
        return $messages;
    }
}
