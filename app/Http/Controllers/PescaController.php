<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pesca\StorePescaRequest;
use App\Http\Requests\Pesca\UpdatePescaRequest;
use App\Models\Pesca;
use App\Models\PermisoZarpe;
use App\Models\Embarcacion;
use App\Models\Pescador;
use App\Models\Puerto;
use App\User;
use Carbon\Carbon;
use Auth;
//use App\Usuario;
use Session;

class PescaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $pescas = Pesca::paginate(10);

        $pescas->setPath('pesca');
        if (Auth::user()->role_id == 4){
            return view('internal.admin.pescas', compact('pescas'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.pescas', compact('pescas'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $embarcaciones_lista = Embarcacion::all()->lists('nombre','id');
        $puertos_lista = Puerto::all()->lists('nombre','id');
        $permisoZarpe_lista = PermisoZarpe::all()->lists('nombre','id');
       
      
        $arreglo = [
        'embarcaciones_lista'   =>$embarcaciones_lista,
        'puertos_lista'      =>$puertos_lista,
        'permisoZarpe_lista' =>$permisoZarpe_lista];


        if (Auth::user()->role_id == 4){
            return view('internal.admin.nuevoPesca',$arreglo);
        }
        elseif (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.nuevoPesca',$arreglo);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
