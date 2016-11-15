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
            return view('internal.admin.empresarios', compact('empresarios'));
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.empresarios', compact('empresarios'));
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
            return view('internal.admin.nuevoEmpresario');
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioPesca.nuevoEmpresario');
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
            return redirect()->route('admin.empresarios');
        }
        elseif  (Auth::user()->role_id == 6){
            return redirect()->route('usuarioPesca.empresarios');
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
        $empresarios = EmpresarioComercializador::find($id);
        if (Auth::user()->role_id == 4){
            return view('internal.admin.editarEmpresario', compact('empresarios'));
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioPesca.editarEmpresario', compact('empresarios'));
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
            return redirect()->route('admin.empresarios');
        }
        elseif  (Auth::user()->role_id == 6){
            return redirect()->route('usuarioPesca.empresarios');
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
            return redirect()->route('admin.empresarios');
        }
        elseif  (Auth::user()->role_id == 6){
            return redirect()->route('usuarioPesca.empresarios');
        }
    }
}
