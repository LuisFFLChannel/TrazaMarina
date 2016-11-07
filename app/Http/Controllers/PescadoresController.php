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
use Auth;

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
        if (Auth::user()->role_id == 4){
            return view('internal.admin.pescadores', compact('pescadores'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.pescadores', compact('pescadores'));
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
            return view('internal.admin.nuevoPescador');
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.nuevoPescador');
        }
        
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

        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.pescadores');
        }
        elseif  (Auth::user()->role_id == 5){
            return redirect()->route('admin.pescadores');
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
        $pescador = Pescador::find($id);
        if (Auth::user()->role_id == 4){
            return view('internal.admin.editarPescador', compact('pescador'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.editarPescador', compact('pescador'));
        }
        
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
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.pescadores');
        }
        elseif  (Auth::user()->role_id == 5){
            return redirect()->route('admin.pescadores');
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
        $pescador = Pescador::find($id);
        $pescador->delete();
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.pescadores');
        }
        elseif  (Auth::user()->role_id == 5){
            return redirect()->route('admin.pescadores');
        }
   
    }
    public function editPermisoMarinero($id)
    {
        //
        $pescador = Pescador::find($id);
        if (Auth::user()->role_id == 4){
            return view('internal.admin.asociarPermisoMarinero', compact('pescador'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.asociarPermisoMarinero', compact('pescador'));;
        }
        
    }
    public function editPermisoPatron($id)
    {
        //
        $pescador = Pescador::find($id);
        if (Auth::user()->role_id == 4){
            return view('internal.admin.asociarPermisoPatron', compact('pescador'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.asociarPermisoPatron', compact('pescador'));
        }
        
    }
    public function showPermisoMarinero($id)
    {
        //
        $pescador = Pescador::find($id);
       // $certificado = CertificadoMatricula::find($pescador->certtificadoMatricula_id);
        if ($pescador->permisoMarinero == null){
            return back()->withErrors(['Aun no se a asociado un permiso marinero al pescador']);
        }
        if (Auth::user()->role_id == 4){
           return view('internal.admin.mostrarPermisoMarinero', compact('pescador'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.mostrarPermisoMarinero', compact('pescador'));
        }
        
    }
    public function showPermisoPatron($id)
    {
        //
        $pescador = Pescador::find($id);
       // $permiso = PermisoPesca::find($pescador->permisoPesca_id);
        if ($pescador->permisoPatron == null){
            return back()->withErrors(['Aun no se a asociado un permiso patron al pescador']);
        }
         if (Auth::user()->role_id == 4){
           return view('internal.admin.mostrarPermisoPatron', compact('pescador'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.mostrarPermisoPatron', compact('pescador'));
        }
        
    }
}
