<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TipoPesca extends Model
{
    //
    protected $table = 'tipoPesca';
	protected $dates = ['deleted_at'];

	public function especies(){
        return $this->hasMany('App\Models\EspecieMarina','tipoPesca_id','id');
    }
}
