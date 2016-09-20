<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puerto extends Model
{
	protected $table = 'puerto';
	protected $dates = ['deleted_at'];
    /*public function usuarios()
    {
        return $this->hasMany('App\Usuario', 'perfilUsuario_id', 'id');
    }*/
}
