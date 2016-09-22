<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EspecieMarina extends Model
{
	protected $table = 'EspecieMarina';
	protected $dates = ['deleted_at'];

    /*public function usuarios()
    {
        return $this->hasMany('App\Usuario', 'perfilUsuario_id', 'id');
    }*/
}
