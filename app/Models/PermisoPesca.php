<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermisoPesca extends Model
{
    //
    protected $table = 'permisoPesca';
	protected $dates = ['deleted_at'];

	public function embarcacion() {
        return $this->hasOne('App\Models\Embarcacion');
    }
}
