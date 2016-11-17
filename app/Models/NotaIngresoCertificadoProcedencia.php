<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotaIngresoCertificadoProcedencia extends Model
{
    //
    protected $table = 'notaingreso_certificadoprocedencia';
	protected $dates = ['deleted_at'];

    public function nota(){
        return $this->belongsTo('App\Models\NotaIngreso','notaIngreso_id');
    }
    public function certificado(){
        return $this->belongsTo('App\Models\CertificadoProcedencia','certificado_id');
    }


    /*public function transportista(){
        return $this->belongsTo('App\Models\Transportista','transportista_id');
    }
    public function fabrica(){
        return $this->belongsTo('App\Models\Fabrica','fabrica_id');
    }
    public function frigorifico(){
        return $this->belongsTo('App\Models\Frigorifico','frigorifico_id');
    }*/
}
