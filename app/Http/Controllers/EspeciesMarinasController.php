<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\EspecieMarina\StoreEspecieRequest;
use App\Http\Requests\EspecieMarina\UpdateEspecieRequest;
use App\Models\EspecieMarina;
use App\Services\FileService;
use App\User;
use Carbon\Carbon;
//use App\Usuario;
use Session;

class EspeciesMarinasController extends Controller
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
        $especies = EspecieMarina::paginate(10);
        $especies->setPath('especies');
        return view('internal.admin.especieMarinas', compact('especies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('internal.admin.nuevaEspecieMarina');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEspecieRequest $request)
    {
        //
        $input = $request->all();

        $especie                    =   new EspecieMarina;
        $especie->nombre            =   $input['nombre'];
        $especie->nombreCientifico  =   $input['nombreCientifico'];
        $especie->promedioVida      =   $input['promedioVida'];
        $especie->tamanoMin         =   $input['tamanoMin'];
        $especie->tamanoMax         =   $input['tamanoMax'];
        $especie->inicioVeda        =   new Carbon($input['inicioVeda']);
        $especie->finVeda           =   new Carbon($input['finVeda']);
        $especie->pescaPromedio     =   $input['pescaPromedio'];
        $especie->activo            =   true;

        //Control de subida de imagen por hacer
        $especie->imagen        =   $this->file_service->upload($request->file('imagen'),'especie');

        $especie->save();
        
        return redirect()->route('admin.especieMarinas');
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
    public function edit($idEspecie)
    {
        //

        $especie = EspecieMarina::find($idEspecie);
        return view('internal.admin.editarEspecieMarina', compact('especie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEspecieRequest $request, $idEspecie)
    {
        //
        $input = $request->all();

        $especie = EspecieMarina::find($idEspecie);

        $especie->nombre            =   $input['nombre'];
        $especie->nombreCientifico  =   $input['nombreCientifico'];
        $especie->promedioVida      =   $input['promedioVida'];
        $especie->tamanoMin         =   $input['tamanoMin'];
        $especie->tamanoMax         =   $input['tamanoMax'];
        $especie->inicioVeda        =   new Carbon($input['inicioVeda']);
        $especie->finVeda           =   new Carbon($input['finVeda']);
        $especie->pescaPromedio     =   $input['pescaPromedio'];
        if($request->file('imagen')!=null)
            $especie->imagen        =   $this->file_service->upload($request->file('imagen'),'especie');

        $especie->save();
        
        return redirect()->route('admin.especieMarinas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idEspecie)
    {
        //
        $especie = EspecieMarina::find($idEspecie);
        $especie->delete();
        return redirect()->route('admin.especiesMarinas');
    }
}
