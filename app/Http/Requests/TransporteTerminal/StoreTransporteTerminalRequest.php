<?php

namespace App\Http\Requests\TransporteTerminal;

use App\Http\Requests\Request;

class StoreTransporteTerminalRequest extends Request
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
            'codigo'                =>  'required|max:50',   
            'terminal_id'           =>  'required|integer',
            'frigorifico_id'        =>  'required|integer',
            'transportista_id'      =>  'required|integer',
            'fechaDictada'          =>  'required',
            'notas_id'              =>  'required',
            'toneladas'             =>  'required'
        ];
        $notas = $this->request->get('notas_id');
        //dd($especies = $this->request->get('tallas'));
        if($notas)
        foreach($notas as $key=>$val){
            $rules['notas_id.'.$key]              = 'required|integer';
            $rules['toneladas.'.$key]               = 'required|numeric|min:0';   
        }
        return $rules;
    }
}
