<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
class PermisoZarpe extends Model
{
    //
    protected $table = 'permisoZarpe';
	protected $dates = ['deleted_at'];

    public function capitania(){
        return $this->belongsTo('App\Models\Capitania','capitania_id');
    }

    public function puerto(){
        return $this->belongsTo('App\Models\Puerto','puerto_id');
    }
    /*public function pescadores (){
    	$pescadores =  DB::table('permisoZarpe_pescadores') 
                    ->select(DB::raw('pescadores.id as id, pescadores.nombres as nombres, pescadores.apellidos as apellidos, pescadores.dni as dni, pescadores.telefono as telefono, pescadores.correo as correo, pescadores.cumpleanos as cumpleanos, pescadores.permiso_patron_id as permiso_patron_id, pescadores.permiso_marinero_id as permiso_marinero_id'))
                    ->where('permisoZarpe_id', $this->id)->where('tipo',2)
                    ->leftJoin('pescadores', 'pescadores.id', '=', 'permisoZarpe_pescadores.pescadores_id')
                    ->get();
        dd($pescadores);
        return $pescadores;

    }
    public function patron(){
    	$patron =  DB::table('permisoZarpe_pescadores') 
                    ->select(DB::raw('pescadores.id as id, pescadores.nombres as nombres, pescadores.apellidos as apellidos, pescadores.dni as dni, pescadores.telefono as telefono, pescadores.correo as correo, pescadores.cumpleanos as cumpleanos, pescadores.permiso_patron_id as permiso_patron_id, pescadores.permiso_marinero_id as permiso_marinero_id'))
                    ->where('permisoZarpe_id', $this->id)->where('tipo',1)
                    ->leftJoin('pescadores', 'pescadores.id', '=', 'permisoZarpe_pescadores.pescadores_id')
                    ->get();
        return $patron;
    }*/
    public function pescadores(){
        return $this->hasMany('App\Models\PermisoZarpePescadores','permisoZarpe_id')->where('permisoZarpe_id',$this->id);
    }
    public function marineros(){
    	return $this->hasMany('App\Models\PermisoZarpePescadores','permisoZarpes_id')->where('permisoZarpe_id',$this->id)->where('tipo',2);
    }
    public function patron(){
    	return $this->hasMany('App\Models\PermisoZarpePescadores','permisoZarpe_id')->where('permisoZarpe_id',$this->id)->where('tipo',1);
    }
}
