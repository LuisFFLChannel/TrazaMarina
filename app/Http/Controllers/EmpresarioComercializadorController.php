<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmpresarioComercializador\StoreEmpresarioComercializadorRequest;
use App\Http\Requests\EmpresarioComercializador\UpdateEmpresarioComercializadorRequest;
use App\Models\EmpresarioComercializador;
use App\Models\CertificadoProcedencia;
use App\Services\FileService;
use App\User;
use Carbon\Carbon;
//use App\Usuario;
use Session;
use Auth;

class EmpresarioComercializadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $empresarios = EmpresarioComercializador::paginate(10);
        $empresarios->setPath('empresario');
        if (Auth::user()->role_id == 4){
            return view('internal.admin.empresarioComercializadores', compact('empresarios'));
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.empresarioComercializadores', compact('empresarios'));
        }
        elseif  (Auth::user()->role_id == 7){
            return view('internal.usuarioValidacion.empresarioComercializadores', compact('empresarios'));
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
            return view('internal.admin.nuevoEmpresarioComercializador');
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.nuevoEmpresarioComercializador');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmpresarioComercializadorRequest $request)
    {
        //
        $input = $request->all();

        $empresario                    =   new EmpresarioComercializador;
        $empresario->nombres           =   $input['nombres'];
        $empresario->apellidos         =   $input['apellidos'];
        $empresario->dni               =   $input['dni'];
        $empresario->telefono          =   $input['telefono'];
        $empresario->correo            =   $input['correo'];
        $empresario->nombreEmpresa     =   $input['nombreEmpresa'];
        $empresario->ruc               =   $input['ruc'];
        $empresario->activo            =   true;

        $empresario->save();

        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.empresarioComercializadores');
        }
        elseif  (Auth::user()->role_id == 6){
            return redirect()->route('usuarioIntermediario.empresarioComercializadores');
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
        $empresario = EmpresarioComercializador::find($id);
        if (Auth::user()->role_id == 4){
            return view('internal.admin.editarEmpresarioComercializador', compact('empresario'));
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.editarEmpresarioComercializador', compact('empresario'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmpresarioComercializadorRequest $request, $id)
    {
        //
        $input = $request->all();

        $empresario = EmpresarioComercializador::find($id);

        $empresario->nombres           =   $input['nombres'];
        $empresario->apellidos         =   $input['apellidos'];
        $empresario->dni               =   $input['dni'];
        $empresario->telefono          =   $input['telefono'];
        $empresario->correo            =   $input['correo'];
        $empresario->nombreEmpresa     =   $input['nombreEmpresa'];
        $empresario->ruc               =   $input['ruc'];

        $empresario->save();

        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.empresarioComercializadores');
        }
        elseif  (Auth::user()->role_id == 6){
            return redirect()->route('usuarioIntermediario.empresarioComercializadores');
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
        $empresario = EmpresarioComercializador::find($id);
        $empresario->delete();
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.empresarioComercializadores');
        }
        elseif  (Auth::user()->role_id == 6){
            return redirect()->route('usuarioIntermediario.empresarioComercializadores');
        }
    }
}
