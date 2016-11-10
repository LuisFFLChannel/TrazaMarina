<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermisoZarpe\StorePermisoZarpeRequest;
use App\Http\Requests\PermisoZarpe\UpdatePermisoZarpeRequest;
use App\Models\PermisoZarpe;
use App\Models\Capitania;
use App\Models\Puerto;
use App\User;
use Carbon\Carbon;
use Auth;
//use App\Usuario;
use Session;

class PermisoZarpeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $permisoZarpes = PermisoZarpe::paginate(10);
        //dd($permisoZarpes);
        $permisoZarpes->setPath('permisoZarpe');
        if (Auth::user()->role_id == 4){
            return view('internal.admin.PermisoZarpes', compact('permisoZarpes'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.PermisoZarpes', compact('permisoZarpes'));
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
        $capitanias_lista = Capitania::all()->lists('nombre','id');
        $puertos_lista = Puerto::all()->lists('nombre','id');
        $arreglo = [
        'capitanias_lista'   =>$capitanias_lista,
        'puertos_lista'      =>$puertos_lista];
        if (Auth::user()->role_id == 4){
            return view('internal.admin.nuevoPermisoZarpe',$arreglo);
        }
        elseif (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.nuevoPermisoZarpe',$arreglo);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermisoZarpeRequest $request)
    {
        //
        $input = $request->all();

        $permisoPatron                          =   new PermisoZarpe;
        $permisoPatron->nombre                  =   $input['nombre'];
        $permisoPatron->nMatricula              =   $input['nMatricula'];
        $permisoPatron->coordenadaX             =   $input['latitud'];
        $permisoPatron->coordenadaY             =   $input['longitud'];
        $permisoPatron->fechaZarpe              =   $input['fechaZarpe'];
        $permisoPatron->fechaArribo             =   $input['fechaArribo'];
        $permisoPatron->puerto_id               =   $input['puerto_id'];
        $permisoPatron->capitania_id            =   $input['capitania_id'];
        $permisoPatron->asignado                =   false;
        $permisoPatron->activo                  =   true;
        //Control de subida de imagen por hacer

        $permisoPatron->save();
        
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.permisoZarpes');
        }
        elseif (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.permisoZarpes');
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
        $capitanias_lista = Capitania::all()->lists('nombre','id');;
        $puertos_lista = Puerto::all()->lists('nombre','id');;
        $permisoZarpe = PermisoZarpe::find($id);
        $arreglo = [
        'permisoZarpe'      =>$permisoZarpe,
        'capitanias_lista'   =>$capitanias_lista,
        'puertos_lista'      =>$puertos_lista];
        if (Auth::user()->role_id == 4){
            return view('internal.admin.editarPermisoZarpe', $arreglo);
        }
        elseif (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.editarPermisoZarpe', $arreglo);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermisoZarpeRequest $request, $id)
    {
        //
        $input = $request->all();

        $permisoPatron = PermisoZarpe::find($id);

        $permisoPatron->nombre                  =   $input['nombre'];
        $permisoPatron->nMatricula              =   $input['nMatricula'];
        $permisoPatron->coordenadaX             =   $input['latitud'];
        $permisoPatron->coordenadaY             =   $input['longitud'];
        $permisoPatron->fechaZarpe              =   $input['fechaZarpe'];
        $permisoPatron->fechaArribo             =   $input['fechaArribo'];
        $permisoPatron->puerto_id               =   $input['puerto_id'];
        $permisoPatron->capitania_id            =   $input['capitania_id'];
        //Control de subida de imagen por hacer

        $permisoPatron->save();
        
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.permisoZarpes');
        }
        elseif (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.permisoZarpes');
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
        $permisoZarpe = PermisoZarpe::find($id);
        $permisoZarpe->delete();
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.permisoZarpes');
        }
        elseif (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.permisoZarpes');
        }
    }
}
