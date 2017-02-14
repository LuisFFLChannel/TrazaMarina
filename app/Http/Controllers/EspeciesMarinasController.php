<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\EspecieMarina\StoreEspecieRequest;
use App\Http\Requests\EspecieMarina\UpdateEspecieRequest;
use App\Models\EspecieMarina;
use App\Models\TipoPesca;
use App\Services\FileService;
use App\User;
use Carbon\Carbon;
//use App\Usuario;
use Session;
use Auth;

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

        if (Auth::user()->role_id == 4){
            return view('internal.admin.especieMarinas', compact('especies'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.especieMarinas', compact('especies'));
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.especieMarinas', compact('especies'));
        }
        elseif  (Auth::user()->role_id == 7){
            return view('internal.usuarioValidacion.especieMarinas', compact('especies'));
        }
        
    }
    public function indexExternal()
    {
        //
        $especies = EspecieMarina::paginate(5);
        $especies->setPath('especies');

        return view('external.especieMarinas', compact('especies'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tipoPesca_lista = TipoPesca::all()->lists('nombre','id');
        $arreglo = [
        'tipoPesca_lista'   =>$tipoPesca_lista];

        if (Auth::user()->role_id == 4){
            return view('internal.admin.nuevaEspecieMarina',$arreglo);
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.nuevaEspecieMarina',$arreglo);  
        }
        
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
        $especie->tipoPesca_id         =   $input['tipoPesca_id'];
        //$especie->pescaPromedio     =   $input['pescaPromedio'];
        $especie->factorHielo     =   $input['factorHielo'];
        $especie->activo            =   true;

        //Control de subida de imagen por hacer
        if($request->file('imagen')!=null)
            $especie->imagen        =   $this->file_service->upload($request->file('imagen'),'especie');

        $especie->save();
        
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.especieMarinas');
        }
        elseif  (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.especieMarinas');
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
    public function edit($idEspecie)
    {
        //

        $especie = EspecieMarina::find($idEspecie);
        $tipoPesca_lista = TipoPesca::all()->lists('nombre','id');
        $arreglo = [
        'especie'       =>  $especie,
        'tipoPesca_lista'   =>$tipoPesca_lista];

        if ($especie==null){
            return response()->view('errors.503', [], 404);
        }

        if (Auth::user()->role_id == 4){
            return view('internal.admin.editarEspecieMarina', $arreglo);
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.editarEspecieMarina', $arreglo);
        }

        


        
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
        $especie->tipoPesca_id         =   $input['tipoPesca_id'];
        //$especie->pescaPromedio     =   $input['pescaPromedio'];
        $especie->factorHielo     =   $input['factorHielo'];
        if($request->file('imagen')!=null)
            $especie->imagen        =   $this->file_service->upload($request->file('imagen'),'especie');

        $especie->save();
        
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.especieMarinas');
        }
        elseif  (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.especieMarinas');
        }
  
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
        try{
            $especie = EspecieMarina::find($idEspecie);
            if ($especie==null){
                return response()->view('errors.503', [], 404);
            }
            $especie->delete();

            if (Auth::user()->role_id == 4){
                return redirect()->route('admin.especieMarinas');
            }
            elseif  (Auth::user()->role_id == 5){
                return redirect()->route('usuarioPesca.especieMarinas');
            }
        } 
        catch(\Exception $e){
           // catch code
             return redirect()->back()->withInput()->withErrors(['errors' => 'NO SE PUEDE ELIMINAR DEBIDO A QUE ESTA SIENDO USADA EN TRANSACCIONES']);
        }

    }
}
