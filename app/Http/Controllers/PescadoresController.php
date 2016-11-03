<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pescador\StorePescadorRequest;
use App\Http\Requests\Pescador\UpdatePescadorRequest;
use App\Models\Pescador;
use App\Services\FileService;
use App\User;
use Carbon\Carbon;
//use App\Usuario;
use Session;

class PescadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pescadores = Pescador::paginate(10);
        $pescadores->setPath('pescadores');
        return view('internal.admin.pescadores', compact('pescadores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('internal.admin.nuevoPescador');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePescadorRequest $request)
    {
        //
        $input = $request->all();

        $pescador                    =   new Pescador;
        $pescador->nombres           =   $input['nombres'];
        $pescador->apellidos         =   $input['apellidos'];
        $pescador->dni               =   $input['dni'];
        $pescador->telefono          =   $input['telefono'];
        $pescador->correo            =   $input['correo'];
        $pescador->cumpleanos        =   new Carbon($input['cumpleanos']);
        $pescador->activo            =   true;

        $pescador->save();
        
        return redirect()->route('admin.pescadores');
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
        $pescador = Pescador::find($id);
        return view('internal.admin.editarPescador', compact('pescador'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePescadorRequest $request, $id)
    {
        //
        $input = $request->all();

        $pescador = Pescador::find($id);

        $pescador->nombres           =   $input['nombres'];
        $pescador->apellidos         =   $input['apellidos'];
        $pescador->dni               =   $input['dni'];
        $pescador->telefono          =   $input['telefono'];
        $pescador->correo            =   $input['correo'];
        $pescador->cumpleanos        =   new Carbon($input['cumpleanos']);



        $pescador->save();
        return redirect()->route('admin.pescadores');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pescador = Pescador::find($id);
        $pescador->delete();
        return redirect()->route('admin.pescadores');
    }
    public function editPermisoMarinero($id)
    {
        //
        $pescador = Pescador::find($id);
        return view('internal.admin.asociarPermisoMarinero', compact('pescador'));
    }
    public function editPermisoPatron($id)
    {
        //
        $pescador = Pescador::find($id);
        return view('internal.admin.asociarPermisoPatron', compact('pescador'));
    }
    public function showPermisoMarinero($id)
    {
        //
        $pescador = Pescador::find($id);
       // $certificado = CertificadoMatricula::find($pescador->certtificadoMatricula_id);
        if ($pescador->permisoMarinero == null){
            return back()->withErrors(['Aun no se a asociado un permiso marinero al pescador']);
        }
        return view('internal.admin.mostrarPermisoMarinero', compact('pescador'));
    }
    public function showPermisoPatron($id)
    {
        //
        $pescador = Pescador::find($id);
       // $permiso = PermisoPesca::find($pescador->permisoPesca_id);
        if ($pescador->permisoPatron == null){
            return back()->withErrors(['Aun no se a asociado un permiso patron al pescador']);
        }
        return view('internal.admin.mostrarPermisoPatron', compact('pescador'));
    }
}
