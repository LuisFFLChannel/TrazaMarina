<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CategoriaPuerto extends Model
{
    //
    protected $table = 'categoriaPuerto';
	protected $dates = ['deleted_at'];

	/*public function puertos(){
        return $this->hasMany('App\Models\Puerto','categoria_id','id');
    } */
}
