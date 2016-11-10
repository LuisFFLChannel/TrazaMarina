<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pescador extends Model
{
    //
     protected $table = 'pescadores';
	protected $dates = ['deleted_at'];

	public function permisoMarinero(){
        return $this->belongsTo('App\Models\PermisoMarinero');
    }
    public function permisoPatron(){
        return $this->belongsTo('App\Models\PermisoPatron');
    }
    public function permisoZarpe(){
    	 return $this->hasMany('App\Models\PermisoZarpePescadores','pescadores_id')->where('pescadores_id',$this->id);
    }

}
