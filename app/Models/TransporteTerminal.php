<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransporteTerminal extends Model
{
    //
    protected $table = 'transporteTerminal';
	protected $dates = ['deleted_at'];

    public function transportista(){
        return $this->belongsTo('App\Models\Transportista','transportista_id');
    }
    public function terminal(){
        return $this->belongsTo('App\Models\Terminal','terminal_id');
    }
    public function frigorifico(){
        return $this->belongsTo('App\Models\Frigorifico','frigorifico_id');
    }
    public function notasIngreso(){
        return $this->hasMany('App\Models\NotaIngresoTransporteTerminal','transporteTerminal_id','id');
    } 
}
