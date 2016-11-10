<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermisoMarinero\StorePermisoMarineroRequest;
use App\Http\Requests\PermisoMarinero\UpdatePermisoMarineroRequest;
use App\Models\PermisoMarinero;
use App\User;
use Carbon\Carbon;
use Auth;
//use App\Usuario;
use Session;

class PermisoMarineroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        //
        $permisoMarineros = PermisoMarinero::paginate(10);
        $permisoMarineros->setPath('permisoMarinero');
        if (Auth::user()->role_id == 4){
            return view('internal.admin.permisoMarineros', compact('permisoMarineros'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.permisoMarineros', compact('permisoMarineros'));
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
        if (Auth::user()->role_id == 4){
            return view('internal.admin.nuevoPermisoMarinero');
        }
        elseif (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.nuevoPermisoMarinero');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermisoMarineroRequest $request)
    {
        //
        $input = $request->all();

        $permisoMarinero                        =   new PermisoMarinero;
        $permisoMarinero->nombres               =   $input['nombres'];
        $permisoMarinero->apellidos             =   $input['apellidos'];
        $permisoMarinero->dni                   =   $input['dni'];
        $permisoMarinero->numeroMarinero        =   $input['numeroMarinero'];
        $permisoMarinero->fechaVigencia         =   $input['fechaVigencia'];
        $permisoMarinero->asignado                =   false;
        $permisoMarinero->activo                =   true;
        //Control de subida de imagen por hacer

        $permisoMarinero->save();
        
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.permisoMarineros');
        }
        elseif (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.permisoMarineros');
        }
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
        $permisoMarinero = PermisoMarinero::find($id);
        if (Auth::user()->role_id == 4){
            return view('internal.admin.editarPermisoMarinero', compact('permisoMarinero'));
        }
        elseif (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.editarPermisoMarinero', compact('permisoMarinero'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermisoMarineroRequest $request, $id)
    {
        //
        $input = $request->all();

        $permisoMarinero = PermisoMarinero::find($id);

        $permisoMarinero->nombres               =   $input['nombres'];
        $permisoMarinero->apellidos             =   $input['apellidos'];
        $permisoMarinero->dni                   =   $input['dni'];
        $permisoMarinero->numeroMarinero        =   $input['numeroMarinero'];
        $permisoMarinero->fechaVigencia         =   $input['fechaVigencia'];
        //Control de subida de imagen por hacer

        $permisoMarinero->save();
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.permisoMarineros');
        }
        elseif (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.permisoMarineros');     
        }
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
        $permisoMarinero = PermisoMarinero::find($id);
        $permisoMarinero->delete();
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.permisoMarineros');
        }
        elseif (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.permisoMarineros');
        }
    }
}
