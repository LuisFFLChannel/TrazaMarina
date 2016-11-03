<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CertificadoMatricula extends Model
{
    //
    protected $table = 'certificadomatricula';
	protected $dates = ['deleted_at'];

	public function embarcacion() {
        return $this->hasOne('App\Models\Embarcacion');
    }
}
