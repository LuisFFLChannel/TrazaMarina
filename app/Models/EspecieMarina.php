<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EspecieMarina extends Model
{
	protected $table = 'EspecieMarina';
	protected $dates = ['deleted_at'];

    /*public function usuarios()
    {
        return $this->hasMany('App\Usuario', 'perfilUsuario_id', 'id');
    }*/
}
