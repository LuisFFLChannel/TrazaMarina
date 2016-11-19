<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Puerto\StorePuertoRequest;
use App\Http\Requests\Puerto\UpdatePuertoRequest;
use App\Models\Puerto;
use App\Services\FileService;
use App\User;
use Carbon\Carbon;
//use App\Usuario;
use Session;
use Auth;

class PuertosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->file_service = new FileService();
    }

    public function index()
    {
        //
        $puertos = Puerto::paginate(10);
        $puertos->setPath('puerto');

        if (Auth::user()->role_id == 4){
            return view('internal.admin.puertos', compact('puertos'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.puertos', compact('puertos'));
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.puertos', compact('puertos'));
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
            return view('internal.admin.nuevoPuerto');
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.nuevoPuerto');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePuertoRequest $request)
    {
        //
        $input = $request->all();

        $puerto                    =   new Puerto;
        $puerto->nombre            =   $input['nombre'];
        $puerto->direccion         =   $input['direccion'];
        $puerto->coordenadaX       =   $input['latitud'];
        $puerto->coordenadaY       =   $input['longitud'];
        $puerto->activo            =   true;

        //Control de subida de imagen por hacer
        $puerto->imagen        =   $this->file_service->upload($request->file('imagen'),'puerto');

        $puerto->save();
        
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.puertos');
        }
        elseif  (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.puertos');
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
        $puerto = Puerto::find($id);

        if (Auth::user()->role_id == 4){
            return view('internal.admin.editarPuerto', compact('puerto'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.editarPuerto', compact('puerto'));
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePuertoRequest $request, $id)
    {
        //
         $input = $request->all();

        $puerto = Puerto::find($id);

        $puerto->nombre            =   $input['nombre'];
        $puerto->direccion         =   $input['direccion'];
        $puerto->coordenadaX       =   $input['latitud'];
        $puerto->coordenadaY       =   $input['longitud'];
        if($request->file('imagen')!=null)
            $puerto->imagen        =   $this->file_service->upload($request->file('imagen'),'puerto');

        $puerto->save();
        
       if (Auth::user()->role_id == 4){
            return redirect()->route('admin.puertos');
        }
        elseif  (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.puertos');
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
        $puerto = Puerto::find($id);
        $puerto->delete();

        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.puertos');
        }
        elseif  (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.puertos');
        }

    }
    public function mostrarMapa($id)
    {
        //
        $puerto = Puerto::find($id);
        $arreglo = [
            'puerto'             => $puerto,
            'latitud'               => $puerto->coordenadaX,
            'longitud'              => $puerto->coordenadaY,
            'valorEscogido'         => 4

        ];
        //$capitania->delete();
        if (Auth::user()->role_id == 4){
            return view('internal.usuarioPesca.mostrarMapa', $arreglo);
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.mostrarMapa', $arreglo);
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.mostrarMapa', $arreglo);
        }

    }
}
