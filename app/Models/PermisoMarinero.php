<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermisoMarinero extends Model
{
    //
    protected $table = 'permisoMarinero';
	protected $dates = ['deleted_at'];

	public function pescador() {
        return $this->hasOne('App\Models\Pescador');
    }
}
