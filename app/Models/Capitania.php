<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Capitania extends Model
{
	protected $table = 'capitania';
	protected $dates = ['deleted_at'];
    /*public function usuarios()
    {
        return $this->hasMany('App\Usuario', 'perfilUsuario_id', 'id');
    }*/
    public function permisoZarpe(){
        return $this->hasMany('App\Models\PermisoZarpe');
    }
    public function puerto(){
        return $this->hasMany('App\Models\Puerto','capitania_id');
    }
}