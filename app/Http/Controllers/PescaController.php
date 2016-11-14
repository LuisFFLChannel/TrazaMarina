<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pesca\StorePescaRequest;
use App\Http\Requests\Pesca\UpdatePescaRequest;
use App\Models\Pesca;
use App\Models\PermisoZarpe;
use App\Models\Embarcacion;
use App\Models\Pescador;
use App\Models\Puerto;
use App\User;
use Carbon\Carbon;
use Auth;
//use App\Usuario;
use Session;

class PescaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $pescas = Pesca::paginate(10);
       ;
        $pescas->setPath('pesca');
        if (Auth::user()->role_id == 4){
            return view('internal.admin.pescas', compact('pescas'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.pescas', compact('pescas'));
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
        $embarcaciones_lista = Embarcacion::all()->lists('nombre','id');
        $puertos_lista = Puerto::all()->lists('nombre','id');
        $permisoZarpe_lista = PermisoZarpe::where("asignado","=","false")->get()->lists('nombre','id');
       
      
        $arreglo = [
        'embarcaciones_lista'   =>$embarcaciones_lista,
        'puertos_lista'      =>$puertos_lista,
        'permisoZarpe_lista' =>$permisoZarpe_lista];


        if (Auth::user()->role_id == 4){
            return view('internal.admin.nuevoPesca',$arreglo);
        }
        elseif (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.nuevoPesca',$arreglo);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePescaRequest $request)
    {
        //
        $input = $request->all();


        $embarcacion = Embarcacion::find($input['embarcacion_id']);
        //dd($embarcacion->certificado_matricula_id);
        if ($embarcacion->certificado_matricula_id == null or $embarcacion->certificado_matricula_id == 0 ){
            return redirect()->back()->withInput()->withErrors(['errors' => 'La Embarcacion seleccionada no tiene asociado ningun Certificado de Matricula']);
        }
        if ($embarcacion->permiso_pesca_id == null or $embarcacion->permiso_pesca_id == 0 ){
            return redirect()->back()->withInput()->withErrors(['errors' => 'La Embarcacion seleccionada no tiene asociado ningun Permiso de Pesca']);
        }

        $pescas = Pesca::where("arribo","=","false")->where('activo',true)->get();
        
        $permisoZarpe = PermisoZarpe::find($input['permisoZarpe_id']);
        foreach ($pescas as $pes ) {
            //dd($pes->embarcacion->nombre);
            if ($pes->embarcacion->id == $input['embarcacion_id']){
                return redirect()->back()->withInput()->withErrors(['errors' => 'La Embarcacion seleccionada se encuentra en alta mar en estos momentos']);
            }
            $pescadoresActuales = $permisoZarpe->pescadores;
            $pescadoresTotales = $pes->permisoZarpe->pescadores;
            foreach ($pescadoresActuales as $auxPescadorActual ) {
                foreach ($pescadoresTotales as $auxPescadorTotal ) {
                    //dd($auxPescadorActual->id);
                    if ($auxPescadorActual->id == $auxPescadorTotal->id){
                        return redirect()->back()->withInput()->withErrors(['errors' => 'Hay pescadores en el permiso de Zarpe que se encuentran en alta mar en estos momentos. Revise el Permiso Zarpe']);
                    }
                }
            }
        }


        
        $pesca                              =   new Pesca;
        $pesca->embarcacion_id              =   $input['embarcacion_id'];
        $pesca->coordenadaX                 =   $input['latitud'];
        $pesca->coordenadaY                 =   $input['longitud'];
        $pesca->fechaZarpe                  =   new Carbon($input['fechaZarpe']);
        $pesca->puerto_id                   =   $input['puerto_id'];
        $pesca->permisoZarpe_id             =   $input['permisoZarpe_id'];  
        $pesca->activo                      =   true;
        $pesca->arribo                      =   false;
        $pesca->save();
        $permisoZarpe->asignado             =true;
        $permisoZarpe->save();


        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.pescas');
        }
        elseif  (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.pescas');
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
        $pesca = Pesca::find($id);
        $embarcaciones_lista = Embarcacion::all()->lists('nombre','id');
        $puertos_lista = Puerto::all()->lists('nombre','id');
        $permisoZarpe_lista = PermisoZarpe::where("asignado","=","false")->get()->lists('nombre','id');
       
      
        $arreglo = [
        'pesca'     =>$pesca,
        'embarcaciones_lista'   =>$embarcaciones_lista,
        'puertos_lista'      =>$puertos_lista,
        'permisoZarpe_lista' =>$permisoZarpe_lista];
        if (Auth::user()->role_id == 4){
            return view('internal.admin.editarPesca', $arreglo);
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.editarPesca', $arreglo);
        }

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePescaRequest $request, $id)
    {
        //
        $input = $request->all();

        $embarcacion = Embarcacion::find($input['embarcacion_id']);
        //dd($embarcacion->certificado_matricula_id);
        if ($embarcacion->certificado_matricula_id == null or $embarcacion->certificado_matricula_id == 0 ){
            return redirect()->back()->withInput()->withErrors(['errors' => 'La Embarcacion seleccionada no tiene asociado ningun Certificado de Matricula']);
        }
        if ($embarcacion->permiso_pesca_id == null or $embarcacion->permiso_pesca_id == 0 ){
            return redirect()->back()->withInput()->withErrors(['errors' => 'La Embarcacion seleccionada no tiene asociado ningun Permiso de Pesca']);
        }

        $pescas = Pesca::where("arribo","=","false")->where('activo',true)->where("id","<>",$id)->get();
        
        $permisoZarpe = PermisoZarpe::find($input['permisoZarpe_id']);

        foreach ($pescas as $pes ) {
            //dd($pes->embarcacion->nombre);
            if ($pes->embarcacion->id == $input['embarcacion_id']){
                return redirect()->back()->withInput()->withErrors(['errors' => 'La Embarcacion seleccionada se encuentra en alta mar en estos momentos']);
            }
            $pescadoresActuales = $permisoZarpe->pescadores;
            $pescadoresTotales = $pes->permisoZarpe->pescadores;
            foreach ($pescadoresActuales as $auxPescadorActual ) {
                foreach ($pescadoresTotales as $auxPescadorTotal ) {
                    //dd($auxPescadorActual->id);
                    if ($auxPescadorActual->id == $auxPescadorTotal->id){
                        return redirect()->back()->withInput()->withErrors(['errors' => 'Hay pescadores en el permiso de Zarpe que se encuentran en alta mar en estos momentos. Revise el Permiso Zarpe']);
                    }
                }
            }
        }
       
        $pesca = Pesca::find($id);
        if ($permisoZarpe->asociado == true and  $permisoZarpe->pesca->id != $id){
            return redirect()->back()->withInput()->withErrors(['errors' => 'El permiso Zarpe ya ha sido asignado a una pesca']);
        }
        if ($pesca->permisoZarpe_id != null){
            $permiso = PermisoZarpe::find($pesca->permisoZarpe_id );
            $permiso->asignado             =  false;
            $permiso->save();
        }
        $pesca->embarcacion_id              =   $input['embarcacion_id'];
        $pesca->coordenadaX                 =   $input['latitud'];
        $pesca->coordenadaY                 =   $input['longitud'];
        $pesca->fechaZarpe                  =   new Carbon($input['fechaZarpe']);
        $pesca->puerto_id                   =   $input['puerto_id'];
        $pesca->permisoZarpe_id             =   $input['permisoZarpe_id'];  
        $pesca->save();
        $permisoZarpe->asignado             = true;
        $permisoZarpe->save();



        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.pescas');
        }
        elseif  (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.pescas');
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
    }
}
