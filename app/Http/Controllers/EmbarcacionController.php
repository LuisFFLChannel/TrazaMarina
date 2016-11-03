<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Embarcacion\StoreEmbarcacionRequest;
use App\Http\Requests\Embarcacion\UpdateEmbarcacionRequest;
use App\Models\Embarcacion;
use App\Services\FileService;
use App\User;
use Carbon\Carbon;
use App\Models\PermisoPesca;
use App\Models\CertificadoMatricula;
//use App\Usuario;
use Session;

class EmbarcacionController extends Controller
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
        $embarcaciones = Embarcacion::paginate(10);
        $embarcaciones->setPath('embaracion');
        return view('internal.admin.embarcaciones', compact('embarcaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         return view('internal.admin.nuevoEmbarcacion');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmbarcacionRequest $request)
    {
        //
        $input = $request->all();

        $embarcacion                    =   new Embarcacion;
        $embarcacion->nombre            =   $input['nombre'];
        $embarcacion->nMatricula        =   $input['nMatricula'];
        $embarcacion->nombreDueno       =   $input['nombreDueno'];
        $embarcacion->apellidoDueno     =   $input['apellidoDueno'];
        $embarcacion->capacidad         =   $input['capacidad'];
        $embarcacion->estara            =   $input['estara'];
        $embarcacion->manga             =   $input['manga'];
        $embarcacion->puntual           =   $input['puntual'];
        $embarcacion->activo            =   true;
        //Control de subida de imagen por hacer
        $embarcacion->imagen        =   $this->file_service->upload($request->file('imagen'),'embarcacion');

        $embarcacion->save();
        
        return redirect()->route('admin.embarcaciones');
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
        $embarcacion = Embarcacion::find($id);
        return view('internal.admin.editarEmbarcacion', compact('embarcacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmbarcacionRequest $request, $id)
    {
        //
        $input = $request->all();

        $embarcacion = Embarcacion::find($id);

        $embarcacion->nombre            =   $input['nombre'];
        $embarcacion->nMatricula        =   $input['nMatricula'];
        $embarcacion->nombreDueno       =   $input['nombreDueno'];
        $embarcacion->apellidoDueno     =   $input['apellidoDueno'];
        $embarcacion->capacidad         =   $input['capacidad'];
        $embarcacion->estara            =   $input['estara'];
        $embarcacion->manga             =   $input['manga'];
        $embarcacion->puntual           =   $input['puntual'];
        $embarcacion->activo            =   true;
        //Control de subida de imagen por hacer
        if($request->file('imagen')!=null)
            $embarcacion->imagen        =   $this->file_service->upload($request->file('imagen'),'embarcacion');

        $embarcacion->save();
        return redirect()->route('admin.embarcaciones');
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
        $embarcacion = Embarcacion::find($id);
        $embarcacion->delete();
        return redirect()->route('admin.embarcaciones');
    }
    public function editCertificado($id)
    {
        //
        $embarcacion = Embarcacion::find($id);
        return view('internal.admin.asociarCertificadoMatricula', compact('embarcacion'));
    }
    public function editPermiso($id)
    {
        //
        $embarcacion = Embarcacion::find($id);
        return view('internal.admin.asociarPermisoPesca', compact('embarcacion'));
    }
    public function showCertificado($id)
    {
        //
        $embarcacion = Embarcacion::find($id);
       // $certificado = CertificadoMatricula::find($embarcacion->certtificadoMatricula_id);
        if ($embarcacion->certificado == null){
            return back()->withErrors(['Aun no se a asociado un certificado de matricula a la embarcacion']);
        }
        return view('internal.admin.mostrarCertificadoMatricula', compact('embarcacion','certificado'));
    }
    public function showPermiso($id)
    {
        //
        $embarcacion = Embarcacion::find($id);
        $permiso = PermisoPesca::find($embarcacion->permisoPesca_id);
        if ($permiso == null){
            return back()->withErrors(['Aun no se a asociado un permiso de pesca a la embarcacion']);
        }
        return view('internal.admin.mostrarPermisoPesca', compact('embarcacion','permiso'));
    }
}
