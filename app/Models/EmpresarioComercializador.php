<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmpresarioComercializador extends Model
{
    //
    protected $table = 'empresarioComercializador';
	protected $dates = ['deleted_at'];

    public function certificadoProcedencia(){
        return $this->hasMany('App\Models\CertificadoProcedencia');
    }
}
