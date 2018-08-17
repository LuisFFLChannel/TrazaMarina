<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
class HistorialHielo extends Model
{
    //
    protected $table = 'historialHielo';
	protected $dates = ['deleted_at'];

    public function especieMarina(){
        return $this->belongsTo('App\Models\EspecieMarina','especie_id');
    }

    public function puerto(){
        return $this->belongsTo('App\Models\Puerto','puerto_id');
    }

    public function embarcacion(){
        return $this->belongsTo('App\Models\Embarcacion','embarcacion_id');
    }

}
