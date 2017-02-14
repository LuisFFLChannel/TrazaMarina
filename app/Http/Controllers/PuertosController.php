<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Puerto\StorePuertoRequest;
use App\Http\Requests\Puerto\UpdatePuertoRequest;
use App\Models\Puerto;
use App\Models\CategoriaPuerto;
use App\Models\Capitania;
use App\Services\FileService;
use App\User;
use Carbon\Carbon;
//use App\Usuario;
use Session;
use Auth;

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

        if (Auth::user()->role_id == 4){
            return view('internal.admin.puertos', compact('puertos'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.puertos', compact('puertos'));
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.puertos', compact('puertos'));
        }
        elseif  (Auth::user()->role_id == 7){
            return view('internal.usuarioValidacion.puertos', compact('puertos'));
        }
        
    }
    public function indexExternal()
    {
        //
        $puertos = Puerto::paginate(5);
        $puertos->setPath('puerto');

        return view('external.puertos', compact('puertos'));
   
    }
    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categoriaPuerto_lista = CategoriaPuerto::all()->lists('nombre','id');
        $capitania_lista = Capitania::all()->lists('nombre','id');
        $arreglo = [
        'categoriaPuerto_lista'   =>$categoriaPuerto_lista,
        'capitania_lista'   =>$capitania_lista];

        if (Auth::user()->role_id == 4){
            return view('internal.admin.nuevoPuerto',$arreglo);
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.nuevoPuerto',$arreglo);
        }
        
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
        $puerto->contacto       =   $input['contacto'];
        $puerto->categoria_id       =   $input['categoriaPuerto_id'];
        $puerto->capitania_id       =   $input['capitania_id'];
        $puerto->activo            =   true;

        //Control de subida de imagen por hacer
        if($request->file('imagen')!=null)
            $puerto->imagen        =   $this->file_service->upload($request->file('imagen'),'puerto');

        $puerto->save();
        
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.puertos');
        }
        elseif  (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.puertos');
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
        $puerto = Puerto::find($id);

        if ($puerto ==null){
            return response()->view('errors.503', [], 404);
        }
        $categoriaPuerto_lista = CategoriaPuerto::all()->lists('nombre','id');
        $capitania_lista = Capitania::all()->lists('nombre','id');
        $arreglo = [
        'categoriaPuerto_lista'   =>$categoriaPuerto_lista,
        'capitania_lista'   =>$capitania_lista,
        'puerto'    =>  $puerto];

        if (Auth::user()->role_id == 4){
            return view('internal.admin.editarPuerto', $arreglo);
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.editarPuerto', $arreglo);
        }

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
        $puerto->contacto       =   $input['contacto'];
        $puerto->categoria_id       =   $input['categoriaPuerto_id'];
        $puerto->capitania_id       =   $input['capitania_id'];
        if($request->file('imagen')!=null)
            $puerto->imagen        =   $this->file_service->upload($request->file('imagen'),'puerto');

        $puerto->save();
        
       if (Auth::user()->role_id == 4){
            return redirect()->route('admin.puertos');
        }
        elseif  (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.puertos');
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
            $puerto = Puerto::find($id);
            $puerto->delete();

            if (Auth::user()->role_id == 4){
                return redirect()->route('admin.puertos');
            }
            elseif  (Auth::user()->role_id == 5){
                return redirect()->route('usuarioPesca.puertos');
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
        $puerto = Puerto::find($id);
        if ($puerto ==null){
            return response()->view('errors.503', [], 404);
        }
        $arreglo = [
            'puerto'             => $puerto,
            'latitud'               => $puerto->coordenadaX,
            'longitud'              => $puerto->coordenadaY,
            'valorEscogido'         => 4

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
