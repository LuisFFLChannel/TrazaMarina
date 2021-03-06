<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
	protected $table = 'perfilUsuario';
	protected $dates = ['deleted_at'];
    public function usuarios()
    {
        return $this->hasMany('App\Usuario', 'perfilUsuario_id', 'id');
    }
}
