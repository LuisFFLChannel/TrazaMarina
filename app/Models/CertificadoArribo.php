<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CertificadoArribo extends Model
{
    //
    protected $table = 'certificadoArribo';
	protected $dates = ['deleted_at'];

	public function desembarque() {
        return $this->hasOne('App\Models\Desembarque');
    }
}
