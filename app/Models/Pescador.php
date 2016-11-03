<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

}
