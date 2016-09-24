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
        return view('internal.admin.puertos', compact('puertos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('internal.admin.nuevoPuerto');
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
        
        return redirect()->route('admin.puertos');
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
        return view('internal.admin.editarPuerto', compact('puerto'));
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
            $especie->imagen        =   $this->file_service->upload($request->file('imagen'),'puerto');

        $puerto->save();
        
        return redirect()->route('admin.puertos');
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
        return redirect()->route('admin.puertos');
    }
}
