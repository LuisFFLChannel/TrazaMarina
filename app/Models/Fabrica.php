<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fabrica extends Model
{
    //
    protected $table = 'fabrica';
	protected $dates = ['deleted_at'];

	public function certificadoProcedencia(){
        return $this->hasMany('App\Models\CertificadoProcedencia');
    }
    
}
