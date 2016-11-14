<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dpa extends Model
{
    //
    protected $table = 'dpa';
	protected $dates = ['deleted_at'];

	 public function desembarque(){
        return $this->hasMany('App\Models\Desembarque');
    }
}
