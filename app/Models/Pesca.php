<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Pesca extends Model
{
    //
    protected $table = 'pesca';
	protected $dates = ['deleted_at'];

	public function embarcacion(){
        return $this->belongsTo('App\Models\Embarcacion');
    }
    public function puerto(){
        return $this->belongsTo('App\Models\Puerto');
    }
    public function permisoZarpe(){
        return $this->belongsTo('App\Models\PermisoZarpe','permisoZarpe_id');
    }


}
