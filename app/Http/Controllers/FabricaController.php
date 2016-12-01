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
use Auth;

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

        if (Auth::user()->role_id == 4){
            return view('internal.admin.fabricas', compact('fabricas'));
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.fabricas', compact('fabricas'));
        }
        elseif  (Auth::user()->role_id == 7){
            return view('internal.usuarioValidacion.fabricas', compact('fabricas'));
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
            return view('internal.admin.nuevoFabrica');
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.nuevoFabrica');
        }
 
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
        
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.fabricas');
        }
        elseif  (Auth::user()->role_id == 6){
            return redirect()->route('usuarioIntermediario.fabricas');
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
        $fabrica = Fabrica::find($id);
        if ($fabrica ==null){
            return response()->view('errors.503', [], 404);
        }
        if (Auth::user()->role_id == 4){
            return view('internal.admin.editarFabrica', compact('fabrica'));
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.editarFabrica', compact('fabrica'));
        }
        
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
            $fabrica->imagen        =   $this->file_service->upload($request->file('imagen'),'fabrica');

        $fabrica->save();
        
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.fabricas');
        }
        elseif  (Auth::user()->role_id == 6){
            return redirect()->route('usuarioIntermediario.fabricas');
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
            $fabrica = Fabrica::find($id);
            $fabrica->delete();
            if (Auth::user()->role_id == 4){
                return redirect()->route('admin.fabricas');
            }
            elseif  (Auth::user()->role_id == 6){
                return redirect()->route('usuarioIntermediario.fabricas');
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
        $fabrica = Fabrica::find($id);
        if ($fabrica ==null){
            return response()->view('errors.503', [], 404);
        }
        $arreglo = [
            'fabrica'             => $fabrica,
            'latitud'               => $fabrica->coordenadaX,
            'longitud'              => $fabrica->coordenadaY,
            'valorEscogido'         => 3

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
