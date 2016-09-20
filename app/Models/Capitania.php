<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Capitania extends Model
{
	protected $table = 'capitania';
	protected $dates = ['deleted_at'];
    /*public function usuarios()
    {
        return $this->hasMany('App\Usuario', 'perfilUsuario_id', 'id');
    }*/
}