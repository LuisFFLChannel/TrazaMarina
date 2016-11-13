<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Puerto extends Model
{
	protected $table = 'puerto';
	protected $dates = ['deleted_at'];
    /*public function usuarios()
    {
        return $this->hasMany('App\Usuario', 'perfilUsuario_id', 'id');
    }*/
    public function permisoZarpe(){
        return $this->hasMany('App\Models\PermisoZarpe');
    }
    public function pesca(){
        return $this->hasMany('App\Models\Pesca');
    }
}
