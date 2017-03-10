<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Capitania\StoreCapitaniaRequest;
use App\Http\Requests\Capitania\UpdateCapitaniaRequest;
use App\Models\Capitania;
use App\Services\FileService;
use App\User;
use Carbon\Carbon;
//use App\Usuario;
use Session;
use Auth;

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
        $capitanias->setPath('capitanias');
        if (Auth::user()->role_id == 4){
            return view('internal.admin.capitanias', compact('capitanias'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.capitanias', compact('capitanias'));
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.capitanias', compact('capitanias'));
        }
        elseif  (Auth::user()->role_id == 7){
            return view('internal.usuarioValidacion.capitanias', compact('capitanias'));
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
            return view('internal.admin.nuevoCapitania');
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.nuevoCapitania');
        }
        
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
        if($request->file('imagen')!=null)
            $capitania->imagen        =   $this->file_service->upload($request->file('imagen'),'capitania');

        $capitania->save();
        
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.capitanias');
        }
        elseif  (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.capitanias');
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
        $capitania = Capitania::find($id);
        if ($capitania==null){
            return response()->view('errors.503', [], 404);
        }
        if (Auth::user()->role_id == 4){
            return view('internal.admin.editarCapitania', compact('capitania'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.editarCapitania', compact('capitania'));
        }
        
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
            $capitania->imagen        =   $this->file_service->upload($request->file('imagen'),'capitania');

        $capitania->save();
        
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.capitanias');
        }
        elseif  (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.capitanias');
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
            // try code
            $capitania = Capitania::find($id);
            $capitania->delete();
            if (Auth::user()->role_id == 4){
                return redirect()->route('admin.capitanias');
            }
            elseif  (Auth::user()->role_id == 5){
                return redirect()->route('usuarioPesca.capitanias');
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
        $capitania = Capitania::find($id);
        if ($capitania ==null){
            return response()->view('errors.503', [], 404);
        }
        $arreglo = [
            'capitania'             => $capitania,
            'valorEscogido'         => 1,
            'latitud'               => $capitania->coordenadaX,
            'longitud'              => $capitania->coordenadaY

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
