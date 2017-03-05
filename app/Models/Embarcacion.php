<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Embarcacion extends Model
{
    //
    protected $table = 'embarcacion';
	protected $dates = ['deleted_at'];

	public function certificadoMatricula(){
        return $this->belongsTo('App\Models\CertificadoMatricula');
    }
    public function permisoPesca(){
        return $this->belongsTo('App\Models\PermisoPesca');
    }
    public function pesca(){
        return $this->hasMany('App\Models\Pesca');
    }
    public function armador(){
        return $this->belongsTo('App\Models\Pescador')->where('id',$this->armador_id);
    }
    public function desembarque(){
        return $this->hasMany('App\Models\Desembarque');
    }
    public function permisoZarpe(){
        return $this->hasMany('App\Models\PermisoZarpe');//->where('permisoZarpe_id',$this->id)->where('tipo',1);
    }
}
