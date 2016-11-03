<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Terminal\StoreTerminalRequest;
use App\Http\Requests\Terminal\UpdateTerminalRequest;
use App\Models\Terminal;
use App\Services\FileService;
use App\User;
use Carbon\Carbon;
//use App\Usuario;
use Session;

class TerminalController extends Controller
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
        $terminales = Terminal::paginate(10);
        $terminales->setPath('terminal');
        return view('internal.admin.terminales', compact('terminales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         return view('internal.admin.nuevoTerminal');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTerminalRequest $request)
    {
        //
        $input = $request->all();

        $terminal                    =   new Terminal;
        $terminal->nombre            =   $input['nombre'];
        $terminal->direccion         =   $input['direccion'];
        $terminal->coordenadaX       =   $input['latitud'];
        $terminal->coordenadaY       =   $input['longitud'];
        $terminal->activo            =   true;

        //Control de subida de imagen por hacer
        $terminal->imagen        =   $this->file_service->upload($request->file('imagen'),'terminal');

        $terminal->save();
        
        return redirect()->route('admin.terminales');
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
        $terminal = Terminal::find($id);
        return view('internal.admin.editarTerminal', compact('terminal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTerminalRequest $request, $id)
    {
        //
        $input = $request->all();

        $terminal = Terminal::find($id);

        $terminal->nombre            =   $input['nombre'];
        $terminal->direccion         =   $input['direccion'];
        $terminal->coordenadaX       =   $input['latitud'];
        $terminal->coordenadaY       =   $input['longitud'];
        if($request->file('imagen')!=null)
            $terminal->imagen        =   $this->file_service->upload($request->file('imagen'),'terminal');

        $terminal->save();
        
        return redirect()->route('admin.terminales');
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
        $terminal = Terminal::find($id);
        $terminal->delete();
        return redirect()->route('admin.terminales');
    }
}
