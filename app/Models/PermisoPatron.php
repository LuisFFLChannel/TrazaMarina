<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermisoPatron extends Model
{
    //
    protected $table = 'permisoPatron';
	protected $dates = ['deleted_at'];

	public function pescador() {
        return $this->hasOne('App\Models\Pescador');
    }
}
