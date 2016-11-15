<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EspecieMarina extends Model
{
	protected $table = 'especieMarina';
	protected $dates = ['deleted_at'];

    public function notaIngreso(){
        return $this->hasMany('App\Models\NotaIngreso');
    }
}
