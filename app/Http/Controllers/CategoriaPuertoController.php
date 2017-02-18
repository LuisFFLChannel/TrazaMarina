<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriaPuerto\StoreCategoriaPuertoRequest;
use App\Http\Requests\CategoriaPuerto\UpdateCategoriaPuertoRequest;
use App\Models\CategoriaPuerto;
use App\Services\FileService;
use App\User;
use Carbon\Carbon;
//use App\Usuario;
use Session;
use Auth;

class CategoriaPuertoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categoriaPuertos = CategoriaPuerto::paginate(10);
        $categoriaPuertos->setPath('categoriaPuerto');

        if (Auth::user()->role_id == 4){
            return view('internal.admin.categoriaPuertos', compact('categoriaPuertos'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.categoriaPuertos', compact('categoriaPuertos'));
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.categoriaPuertos', compact('categoriaPuertos'));
        }
        elseif  (Auth::user()->role_id == 7){
            return view('internal.usuarioValidacion.categoriaPuertos', compact('categoriaPuertos'));
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
            return view('internal.admin.nuevoCategoriaPuerto');
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.nuevoCategoriaPuerto');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoriaPuertoRequest $request)
    {
        //
        $input = $request->all();

        $categoriaPuerto                    =   new CategoriaPuerto;
        $categoriaPuerto->nombre            =   $input['nombre'];
        $categoriaPuerto->descripcion       =   $input['descripcion'];
        $categoriaPuerto->activo            =   true;

        //Control de subida de imagen por hacer

        $categoriaPuerto->save();

        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.categoriaPuertos');
        }
        elseif  (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.categoriaPuertos');
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
        $categoriaPuerto = CategoriaPuerto::find($id);
        if ($categoriaPuerto ==null){
            return response()->view('errors.503', [], 404);
        }
        if (Auth::user()->role_id == 4){
            return view('internal.admin.editarCategoriaPuerto', compact('categoriaPuerto'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.editarCategoriaPuerto', compact('categoriaPuerto'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoriaPuertoRequest $request, $id)
    {
        //
        $input = $request->all();

        $categoriaPuerto = CategoriaPuerto::find($id);

        $categoriaPuerto->nombre            =   $input['nombre'];
        $categoriaPuerto->descripcion       =   $input['descripcion'];
        $categoriaPuerto->activo            =   true;


        $categoriaPuerto->save();
        
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.categoriaPuertos');
        }
        elseif  (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.categoriaPuertos');
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
            $categoriaPuerto = CategoriaPuerto::find($id);
            $categoriaPuerto->delete();
            if (Auth::user()->role_id == 4){
                return redirect()->route('admin.categoriaPuertos');
            }
            elseif  (Auth::user()->role_id == 5){
                return redirect()->route('usuarioPesca.categoriaPuertos');
            }
            } 
        catch(\Exception $e){
           // catch code
             return redirect()->back()->withInput()->withErrors(['errors' => 'NO SE PUEDE ELIMINAR DEBIDO A QUE ESTA SIENDO USADA EN TRANSACCIONES']);
        }
    }
}
