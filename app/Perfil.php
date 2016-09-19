<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    public function usuarios()
    {
        return $this->hasMany('App\Usuario', 'perfilUsuario_id', 'id');
    }
}
