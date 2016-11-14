<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermisoPatron\StorePermisoPatronRequest;
use App\Http\Requests\PermisoPatron\UpdatePermisoPatronRequest;
use App\Models\PermisoPatron;
use App\User;
use Carbon\Carbon;
use Auth;
//use App\Usuario;
use Session;

class PermisoPatronController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $permisoPatrones = PermisoPatron::paginate(10);
        $permisoPatrones->setPath('permisoPatron');
        if (Auth::user()->role_id == 4){
            return view('internal.admin.permisoPatrones', compact('permisoPatrones'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.permisoPatrones', compact('permisoPatrones'));
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
            return view('internal.admin.nuevoPermisoPatron');
        }
        elseif (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.nuevoPermisoPatron');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermisoPatronRequest $request)
    {
        //
        $input = $request->all();

        $permisoPatron                        =   new PermisoPatron;
        $permisoPatron->nombres               =   $input['nombres'];
        $permisoPatron->apellidos             =   $input['apellidos'];
        $permisoPatron->dni                   =   $input['dni'];
        $permisoPatron->numeroPatron          =   $input['numeroPatron'];
        $permisoPatron->fechaVigencia         =   new Carbon($input['fechaVigencia']);
        $permisoPatron->asignado              =   false;
        $permisoPatron->activo                =   true;
        //Control de subida de imagen por hacer

        $permisoPatron->save();
        
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.permisoPatrones');
        }
        elseif (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.permisoPatrones');
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
        $permisoPatron = PermisoPatron::find($id);
        if (Auth::user()->role_id == 4){
            return view('internal.admin.editarPermisoPatron', compact('permisoPatron'));
        }
        elseif (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.editarPermisoPatron', compact('permisoPatron'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermisoPatronRequest $request, $id)
    {
        //
        $input = $request->all();

        $permisoPatron = PermisoPatron::find($id);

        $permisoPatron->nombres               =   $input['nombres'];
        $permisoPatron->apellidos             =   $input['apellidos'];
        $permisoPatron->dni                   =   $input['dni'];
        $permisoPatron->numeroPatron          =   $input['numeroPatron'];
        $permisoPatron->fechaVigencia         =   new Carbon($input['fechaVigencia']);
        //Control de subida de imagen por hacer

        $permisoPatron->save();
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.permisoPatrones');
        }
        elseif (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.permisoPatrones');     
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
        $permisoPatron = PermisoPatron::find($id);
        $permisoPatron->delete();
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.permisoPatrones');
        }
        elseif (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.permisoPatrones');
        }
    }
}
