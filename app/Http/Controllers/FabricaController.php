<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Fabrica\StoreFabricaRequest;
use App\Http\Requests\Fabrica\UpdateFabricaRequest;
use App\Models\Fabrica;
use App\Services\FileService;
use App\User;
use Carbon\Carbon;
//use App\Usuario;
use Session;

class FabricaController extends Controller
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
        $fabricas = Fabrica::paginate(10);
        $fabricas->setPath('fabrica');
        return view('internal.admin.fabricas', compact('fabricas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         return view('internal.admin.nuevoFabrica');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFabricaRequest $request)
    {
        //
        $input = $request->all();

        $fabrica                    =   new Fabrica;
        $fabrica->nombre            =   $input['nombre'];
        $fabrica->direccion         =   $input['direccion'];
        $fabrica->coordenadaX       =   $input['latitud'];
        $fabrica->coordenadaY       =   $input['longitud'];
        $fabrica->activo            =   true;

        //Control de subida de imagen por hacer
        $fabrica->imagen        =   $this->file_service->upload($request->file('imagen'),'fabrica');

        $fabrica->save();
        
        return redirect()->route('admin.fabricas');
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
        $fabrica = Fabrica::find($id);
        return view('internal.admin.editarFabrica', compact('fabrica'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFabricaRequest $request, $id)
    {
        //
        $input = $request->all();

        $fabrica = Fabrica::find($id);

        $fabrica->nombre            =   $input['nombre'];
        $fabrica->direccion         =   $input['direccion'];
        $fabrica->coordenadaX       =   $input['latitud'];
        $fabrica->coordenadaY       =   $input['longitud'];
        if($request->file('imagen')!=null)
            $especie->imagen        =   $this->file_service->upload($request->file('imagen'),'fabrica');

        $fabrica->save();
        
        return redirect()->route('admin.fabricas');
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
        $fabrica = Fabrica::find($id);
        $fabrica->delete();
        return redirect()->route('admin.fabricas');
    }
}
