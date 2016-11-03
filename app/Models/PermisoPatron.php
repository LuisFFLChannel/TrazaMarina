<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermisoPatron extends Model
{
    //
    protected $table = 'permisoPatron';
	protected $dates = ['deleted_at'];

	public function pescador() {
        return $this->hasOne('App\Models\Pescador');
    }
}
