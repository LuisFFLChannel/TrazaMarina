<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CertificadoProcedencia extends Model
{
    //
    protected $table = 'certificadoProcedencia';
	protected $dates = ['deleted_at'];

    public function empresarioComercializador(){
        return $this->belongsTo('App\Models\EmpresarioComercializador','empresarioComercializador_id');
    }
    public function transportista(){
        return $this->belongsTo('App\Models\Transportista','transportista_id');
    }
    public function fabrica(){
        return $this->belongsTo('App\Models\Fabrica','fabrica_id');
    }
    public function frigorifico(){
        return $this->belongsTo('App\Models\Frigorifico','frigorifico_id');
    }
}
