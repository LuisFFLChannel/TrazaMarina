<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Desembarque extends Model
{
    //
    protected $table = 'desembarque';
	protected $dates = ['deleted_at'];

	public function embarcacion(){
        return $this->belongsTo('App\Models\Embarcacion');
    }
    public function puerto(){
        return $this->belongsTo('App\Models\Puerto');
    }
    /*public function dpa(){
        return $this->belongsTo('App\Models\Dpa');
    }*/
    public function pesca(){
        return $this->belongsTo('App\Models\Pesca','pesca_id');
    }
    public function certificadoArribo(){
        return $this->belongsTo('App\Models\CertificadoArribo','certificado_arribo_id');
    }
    public function notaIngreso(){
        return $this->hasMany('App\Models\NotaIngreso');
    }
}
