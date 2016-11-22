<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class NotaIngreso extends Model
{
    //
    protected $table = 'notaIngreso';
	protected $dates = ['deleted_at'];

	public function desembarque() {
        return $this->belongsTo('App\Models\Desembarque','desembarque_id');
    }
    public function especieMarina() {
        return $this->belongsTo('App\Models\EspecieMarina','especie_id');
    }
    public function notasPorFabrica(){
        return $this->hasMany('App\Models\NotaIngresoCertificadoProcedencia','notaIngreso_id','id');
    } 
    public function notasPorTerminal(){
        return $this->hasMany('App\Models\NotaIngresoTransporteTerminal','notaIngreso_id','id');
    } 

}
