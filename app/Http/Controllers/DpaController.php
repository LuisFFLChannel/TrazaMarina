<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dpa\StoreDpaRequest;
use App\Http\Requests\Dpa\UpdateDpaRequest;
use App\Models\Dpa;
use App\Services\FileService;
use App\User;
use Carbon\Carbon;
use Auth;
//use App\Usuario;
use Session;

class DpaController extends Controller
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
        $dpas = Dpa::paginate(10);
        $dpas->setPath('dpa');
        if (Auth::user()->role_id == 4){
            return view('internal.admin.dpas', compact('dpas'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.dpas', compact('dpas'));
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.dpas', compact('dpas'));
        }
        elseif  (Auth::user()->role_id == 7){
            return view('internal.usuarioValidacion.dpas', compact('dpas'));
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
            return view('internal.admin.nuevoDpa');
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.nuevoDpa');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDpaRequest $request)
    {
        //
        $input = $request->all();

        $dpa                    =   new Dpa;
        $dpa->nombre            =   $input['nombre'];
        $dpa->direccion         =   $input['direccion'];
        $dpa->coordenadaX       =   $input['latitud'];
        $dpa->coordenadaY       =   $input['longitud'];
        $dpa->activo            =   true;

        //Control de subida de imagen por hacer
        $dpa->imagen        =   $this->file_service->upload($request->file('imagen'),'dpa');

        $dpa->save();
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.dpas');
        }
        elseif  (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.dpas');
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
        $dpa = Dpa::find($id);
        if (Auth::user()->role_id == 4){
            return view('internal.admin.editarDpa', compact('dpa'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.editarDpa', compact('dpa'));
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDpaRequest $request, $id)
    {
        //
        $input = $request->all();

        $dpa = Dpa::find($id);

        $dpa->nombre            =   $input['nombre'];
        $dpa->direccion         =   $input['direccion'];
        $dpa->coordenadaX       =   $input['latitud'];
        $dpa->coordenadaY       =   $input['longitud'];
        if($request->file('imagen')!=null)
            $dpa->imagen        =   $this->file_service->upload($request->file('imagen'),'dpa');

        $dpa->save();
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.dpas');
        }
        elseif  (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.dpas');
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
         $dpa = Dpa::find($id);
        $dpa->delete();
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.dpas');
        }
        elseif  (Auth::user()->role_id == 5){
            return redirect()->route('admin.usuarioPesca');
        }
        
    }
    public function mostrarMapa($id)
    {
        //
        $dpa = Dpa::find($id);
        $arreglo = [
            'dpa'             => $dpa,
            'latitud'               => $dpa->coordenadaX,
            'longitud'              => $dpa->coordenadaY,
            'valorEscogido'         => 2

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
        elseif  (Auth::user()->role_id == 7){
            return view('internal.usuarioValidacion.mostrarMapa', $arreglo);
        }

    }
}
