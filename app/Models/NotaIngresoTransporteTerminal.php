<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotaIngresoTransporteTerminal extends Model
{
    //
    protected $table = 'notaIngreso_transporteTerminal';
	protected $dates = ['deleted_at'];

    public function nota(){
        return $this->belongsTo('App\Models\NotaIngreso','notaIngreso_id');
    }
    public function certificadoTerminal(){
        return $this->belongsTo('App\Models\TransporteTerminal','transporte_id');
    }
}
