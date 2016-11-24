<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pescador\StorePescadorRequest;
use App\Http\Requests\Pescador\UpdatePescadorRequest;
use App\Models\Pescador;
use App\Models\PermisoMarinero;
use App\Models\PermisoPatron;
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
        $pescadores->setPath('pescador');
        if (Auth::user()->role_id == 4){
            return view('internal.admin.pescadores', compact('pescadores'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.pescadores', compact('pescadores'));
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.pescadores', compact('pescadores'));
        }
        elseif  (Auth::user()->role_id == 7){
            return view('internal.usuarioValidacion.pescadores', compact('pescadores'));
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
            return redirect()->route('usuarioPesca.pescadores');
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
            return redirect()->route('usuarioPesca.pescadores');
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
            return redirect()->route('usuarioPesca.pescadores');
        }
   
    }
    public function editPermisoMarinero($id)
    {
        //
        $pescador = Pescador::find($id);
        $permisoMarineros =PermisoMarinero::where('asignado','=',false)->get();
        //dd($permisoMarineros);
        if (Auth::user()->role_id == 4){
            return view('internal.admin.asociarPermisoMarinero', compact('pescador','permisoMarineros'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.asociarPermisoMarinero', compact('pescador','permisoMarineros'));;
        }
        
    }
    public function editPermisoPatron($id)
    {
        //
        $pescador = Pescador::find($id);
        $permisoPatrones = PermisoPatron::where('asignado','=',false)->get();
        //$dd($permisoPatrones);
        $pescador = Pescador::find($id);
        if (Auth::user()->role_id == 4){
            return view('internal.admin.asociarPermisoPatron', compact('pescador','permisoPatrones'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.asociarPermisoPatron', compact('pescador','permisoPatrones'));
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
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.mostrarPermisoMarinero', compact('pescador'));
        }
        elseif  (Auth::user()->role_id == 7){
            return view('internal.usuarioValidacion.mostrarPermisoMarinero', compact('pescador'));
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
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.mostrarPermisoPatron', compact('pescador'));
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioValidacion.mostrarPermisoPatron', compact('pescador'));
        }
        
    }
    public function updatePermisoPatron(Request $request, $id)
    {
        //
        $input = $request->all();

        $pescador = Pescador::find($id);
        if($pescador->permiso_patron_id !=null){
            $permi= PermisoPatron::find($pescador->permiso_patron_id );
            $permi->asignado=false;
            $permi->save();
        }
        $pescador->permiso_patron_id            =   $input['permisoPatron'];
        $permiso= PermisoPatron::find($input['permisoPatron']);
        $permiso->asignado=true;

        $permiso->save();

        $pescador->save();

        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.pescadores');
        }
        elseif  (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.pescadores');
        }

    }
    public function updatePermisoMarinero(Request $request, $id)
    {
        //
        $input = $request->all();

        $pescador = Pescador::find($id);
        if($pescador->permiso_marinero_id !=null){
            $permi= PermisoMarinero::find($pescador->permiso_marinero_id );
            $permi->asignado=false;
            $permi->save();
        }
        $pescador->permiso_marinero_id            =   $input['permisoMarinero'];
        $permiso= PermisoMarinero::find($input['permisoMarinero']);
        $permiso->asignado=true;

        $permiso->save();

        $pescador->save();

        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.pescadores');
        }
        elseif  (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.pescadores');
        }
    }
    public function ajaxPermisoZarpe($id_variable)
    {

        $pescad = Pescador::where("id","=",$id_variable)->get()->toArray() ;



    return  json_encode(  $pescad);  
    }
    public function validarPescador($id)
    {
        //
        $pescador = Pescador::find($id);
        
     
        
        $validarMarinero = false;
        if ($pescador->permisoMarinero){
           $validarMarinero = Carbon::parse($pescador->permisoMarinero->fechaVigencia)->gte(Carbon::now());
        }
        $validarPatron = false;
        if ($pescador->permisoPatron){
           $validarPatron = Carbon::parse($pescador->permisoPatron->fechaVigencia)->gte(Carbon::now());
        }
        $arreglo =[
            'pescador' =>   $pescador,
            'validarMarinero'   => $validarMarinero,
            'validarPatron'     => $validarPatron
        ];
        
        if  (Auth::user()->role_id == 7){
            return view('internal.usuarioValidacion.validarPescador', $arreglo);
        }

    }
}
