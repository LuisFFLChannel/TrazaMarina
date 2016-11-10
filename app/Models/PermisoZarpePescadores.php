<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermisoZarpePescadores extends Model
{
    //
    protected $table = 'permisoZarpe_pescadores';
	protected $dates = ['deleted_at'];

	public function pescador(){
        return $this->belongsTo('App\Models\Pescador','pescadores_id');
    }

    public function permizoZarpe(){
        return $this->belongsTo('App\Models\Puerto','permisoZarpe_id');
    }
}
