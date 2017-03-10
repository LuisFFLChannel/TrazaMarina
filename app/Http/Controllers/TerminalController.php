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
use Auth;

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
        $terminales->setPath('terminales');

        if (Auth::user()->role_id == 4){
            return view('internal.admin.terminales', compact('terminales'));
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.terminales', compact('terminales'));
        }
        elseif  (Auth::user()->role_id == 7){
            return view('internal.usuarioValidacion.terminales', compact('terminales'));
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
            return view('internal.admin.nuevoTerminal');
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.nuevoTerminal');
        }
         
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
        if($request->file('imagen')!=null)
            $terminal->imagen        =   $this->file_service->upload($request->file('imagen'),'terminal');

        $terminal->save();

        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.terminales');
        }
        elseif  (Auth::user()->role_id == 6){
            return redirect()->route('usuarioIntermediario.terminales');
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
        $terminal = Terminal::find($id);
        if ($terminal ==null){
            return response()->view('errors.503', [], 404);
        }
        if (Auth::user()->role_id == 4){
            return view('internal.admin.editarTerminal', compact('terminal'));
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.editarTerminal', compact('terminal'));
        }
        
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
        
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.terminales');
        }
        elseif  (Auth::user()->role_id == 6){
            return redirect()->route('usuarioIntermediario.terminales');
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
        try{
            $terminal = Terminal::find($id);
            $terminal->delete();
            if (Auth::user()->role_id == 4){
                return redirect()->route('admin.terminales');
            }
            elseif  (Auth::user()->role_id == 6){
                return redirect()->route('usuarioIntermediario.terminales');
            }
            } 
        catch(\Exception $e){
           // catch code
             return redirect()->back()->withInput()->withErrors(['errors' => 'NO SE PUEDE ELIMINAR DEBIDO A QUE ESTA SIENDO USADA EN TRANSACCIONES']);
        }
    }
    public function mostrarMapa($id)
    {
        //
        $terminal = Terminal::find($id);
        if ($terminal ==null){
            return response()->view('errors.503', [], 404);
        }
        $arreglo = [
            'terminal'             => $terminal,
            'latitud'               => $terminal->coordenadaX,
            'longitud'              => $terminal->coordenadaY,
            'valorEscogido'         => 5

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
