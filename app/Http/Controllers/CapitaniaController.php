<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Controller;
use App\Http\Requests\Capitania\StoreCapitaniaRequest;
use App\Http\Requests\Capitania\UpdateCapitaniaRequest;
use App\Models\Capitania;
use App\Services\FileService;
use App\User;
use Carbon\Carbon;
//use App\Usuario;
use Session;

class CapitaniaController extends Controller
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
        $capitanias = Capitania::paginate(10);
        $capitanias->setPath('capitania');
        return view('internal.admin.capitanias', compact('capitanias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('internal.admin.nuevoCapitania');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCapitaniaRequest $request)
    {
        //
        $input = $request->all();

        $capitania                    =   new Capitania;
        $capitania->nombre            =   $input['nombre'];
        $capitania->direccion         =   $input['direccion'];
        $capitania->coordenadaX       =   $input['latitud'];
        $capitania->coordenadaY       =   $input['longitud'];
        $capitania->activo            =   true;

        //Control de subida de imagen por hacer
        $capitania->imagen        =   $this->file_service->upload($request->file('imagen'),'capitania');

        $capitania->save();
        
        return redirect()->route('admin.capitanias');
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
        $capitania = Capitania::find($id);
        return view('internal.admin.editarCapitania', compact('capitania'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCapitaniaRequest $request, $id)
    {
        //
        $input = $request->all();

        $capitania = Capitania::find($id);

        $capitania->nombre            =   $input['nombre'];
        $capitania->direccion         =   $input['direccion'];
        $capitania->coordenadaX       =   $input['latitud'];
        $capitania->coordenadaY       =   $input['longitud'];
        if($request->file('imagen')!=null)
            $especie->imagen        =   $this->file_service->upload($request->file('imagen'),'capitania');

        $capitania->save();
        
        return redirect()->route('admin.capitanias');
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
        $capitania = Capitania::find($id);
        $capitania->delete();
        return redirect()->route('admin.capitanias');
    }
}
