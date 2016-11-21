<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Terminal extends Model
{
    //
    protected $table = 'terminal';
	protected $dates = ['deleted_at'];
    /*public function usuarios()
    {
        return $this->hasMany('App\Usuario', 'perfilUsuario_id', 'id');
    }*/
    public function transporteTerminal(){
        return $this->hasMany('App\Models\TransporteTerminal');
    }
}
