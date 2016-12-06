<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermisoZarpe\StorePermisoZarpeRequest;
use App\Http\Requests\PermisoZarpe\UpdatePermisoZarpeRequest;
use App\Models\PermisoZarpe;
use App\Models\PermisoZarpePescadores;
use App\Models\Capitania;
use App\Models\Pescador;
use App\Models\Puerto;
use App\User;
use Carbon\Carbon;
use Auth;
//use App\Usuario;
use Session;
use DB;

class PermisoZarpeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $permisoZarpes = PermisoZarpe::paginate(10);

        $permisoZarpes->setPath('permisoZarpe');
        if (Auth::user()->role_id == 4){
            return view('internal.admin.PermisoZarpes', compact('permisoZarpes'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.PermisoZarpes', compact('permisoZarpes'));
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.PermisoZarpes', compact('permisoZarpes'));
        }
        elseif  (Auth::user()->role_id == 7){
            return view('internal.usuarioValidacion.PermisoZarpes', compact('permisoZarpes'));
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
        $capitanias_lista = Capitania::all()->lists('nombre','id');
        $puertos_lista = Puerto::all()->lists('nombre','id');
        $pescadores = Pescador::whereNotNull('permiso_marinero_id')->get();
        $patrones = Pescador::whereNotNull('permiso_patron_id')->get();
        $arreglo = [
        'capitanias_lista'   =>$capitanias_lista,
        'puertos_lista'      =>$puertos_lista,
        'pescadores'         =>$pescadores,
        'patrones'           =>$patrones];
        if (Auth::user()->role_id == 4){
            return view('internal.admin.nuevoPermisoZarpe',$arreglo);
        }
        elseif (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.nuevoPermisoZarpe',$arreglo);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePescadores($data, $permiso){
        $var = new PermisoZarpePescadores();
        $var->pescadores_id = $data['pescadores_id'];
        $var->permisoZarpe_id = $permiso->id;
        $var->tipo = 2;
        $var->save();
        return $var;
    }
    public function storePatrones($data, $permiso){
        $var = new PermisoZarpePescadores();
        $var->pescadores_id = $data['patrones_id'];
        $var->permisoZarpe_id = $permiso->id;
        $var->tipo = 1;
        $var->save();
        return $var;
    }
    public function store(StorePermisoZarpeRequest $request)
    {
        //
        $input = $request->all();

        $permisoPatron                          =   new PermisoZarpe;
        $permisoPatron->codigo                  =   $input['codigo'];
        $permisoPatron->nombreEmbarcacion       =   $input['nombreEmbarcacion'];
        $permisoPatron->nMatricula              =   $input['nMatricula'];
        $permisoPatron->coordenadaX             =   $input['latitud'];
        $permisoPatron->coordenadaY             =   $input['longitud'];
        $permisoPatron->fechaZarpe              =   new Carbon($input['fechaZarpe']);
        $permisoPatron->fechaArribo             =   new Carbon($input['fechaArribo']);
        $permisoPatron->puerto_id               =   $input['puerto_id'];
        $permisoPatron->capitania_id            =   $input['capitania_id'];
        $permisoPatron->asignado                =   false;
        $permisoPatron->activo                  =   true;
        //Control de subida de imagen por hacer

    
        $pescadores_data = [
            'pescadores_id'     => $request->input('pescadores_id')
        ];
        $patrones_data = [
            'patrones_id'       => $request->input('patrones_id')
        ];
        foreach($pescadores_data ['pescadores_id'] as $key=>$value1){
            $pes_data = [
                'pescadores_id' => $value1
            ];
            foreach($patrones_data ['patrones_id'] as $key=>$value2){
                $pats_data = [
                    'patrones_id' => $value2
                ];
                if ($pes_data['pescadores_id']==$pats_data['patrones_id']){
                     return redirect()->back()->withInput()->withErrors(['errors' => 'El Patron no puede ser marinero a la vez']);
                }
            }
        }
        foreach($pescadores_data ['pescadores_id'] as $key1=>$value1){
            $pes_data = [
                'pescadores_id' => $value1
            ];
            foreach($pescadores_data ['pescadores_id'] as $key2=>$value2){
                $pes2_data = [
                    'pescadores_id' => $value2
                ];
                if ($key1!= $key2 and $pes_data['pescadores_id']==$pes2_data['pescadores_id']){
                     return redirect()->back()->withInput()->withErrors(['errors' => 'Existen Marineros Repetidos']);
                }
            }
        }
        
        $permisoPatron->save();
        foreach($pescadores_data ['pescadores_id'] as $key=>$value){
            $pes_data = [
                'pescadores_id' => $value
            ];
            $var = $this->storePescadores($pes_data , $permisoPatron);
        }
        foreach($patrones_data ['patrones_id'] as $key=>$value){
            $pats_data = [
                'patrones_id' => $value
            ];
            $var = $this->storePatrones($pats_data , $permisoPatron);
        }


        
        
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.permisoZarpes');
        }
        elseif (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.permisoZarpes');
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
        $capitanias_lista = Capitania::all()->lists('nombre','id');;
        $puertos_lista = Puerto::all()->lists('nombre','id');
        $pescadores_lista = Pescador::whereNotNull('permiso_marinero_id')->get();
        $patrones_lista = Pescador::whereNotNull('permiso_patron_id')->get();
        $permisoZarpe = PermisoZarpe::find($id);
        if ($permisoZarpe ==null){
            return response()->view('errors.503', [], 404);
        }
        $arreglo = [
        'permisoZarpe'      =>$permisoZarpe,
        'capitanias_lista'   =>$capitanias_lista,
        'puertos_lista'      =>$puertos_lista,
        'pescadores'  =>$pescadores_lista,
        'patrones'    =>$patrones_lista];
        if (Auth::user()->role_id == 4){
            return view('internal.admin.editarPermisoZarpe', $arreglo);
        }
        elseif (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.editarPermisoZarpe', $arreglo);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermisoZarpeRequest $request, $id)
    {
        //
        $input = $request->all();

        $permisoPatron = PermisoZarpe::find($id);

        $permisoPatron->codigo                  =   $input['codigo'];
        $permisoPatron->nombreEmbarcacion       =   $input['nombreEmbarcacion'];
        $permisoPatron->nMatricula              =   $input['nMatricula'];
        $permisoPatron->coordenadaX             =   $input['latitud'];
        $permisoPatron->coordenadaY             =   $input['longitud'];
        $permisoPatron->fechaZarpe              =   new Carbon($input['fechaZarpe']);
        $permisoPatron->fechaArribo             =   new Carbon($input['fechaArribo']);
        $permisoPatron->puerto_id               =   $input['puerto_id'];
        $permisoPatron->capitania_id            =   $input['capitania_id'];
        //Control de subida de imagen por hacer

        $pescadores_data = [
            'pescadores_id'     => $request->input('pescadores_id')
        ];
        $patrones_data = [
            'patrones_id'       => $request->input('patrones_id')
        ];

        foreach($pescadores_data ['pescadores_id'] as $key=>$value1){
            $pes_data = [
                'pescadores_id' => $value1
            ];
            foreach($patrones_data ['patrones_id'] as $key=>$value2){
                $pats_data = [
                    'patrones_id' => $value2
                ];
                if ($pes_data['pescadores_id']==$pats_data['patrones_id']){
                     return redirect()->back()->withInput()->withErrors(['errors' => 'El Patron no puede ser marinero a la vez']);
                }
            }
        }
        foreach($pescadores_data ['pescadores_id'] as $key1=>$value1){
            $pes_data = [
                'pescadores_id' => $value1
            ];
            foreach($pescadores_data ['pescadores_id'] as $key2=>$value2){
                $pes2_data = [
                    'pescadores_id' => $value2
                ];
                if ($key1!= $key2 and $pes_data['pescadores_id']==$pes2_data['pescadores_id']){
                     return redirect()->back()->withInput()->withErrors(['errors' => 'Existen Marineros Repetidos']);
                }
            }
        }
        $antiguosPescadores = PermisoZarpePescadores::where("permisoZarpe_id",'=',$permisoPatron->id)->get();

        foreach ($antiguosPescadores as $auxPes) {
            //dd($auxPes);
            DB::table('permisoZarpe_pescadores')->where("permisoZarpe_id",'=',$permisoPatron->id)->delete();
            //$auxPes->delete();
        }
        $permisoPatron->save();
        foreach($pescadores_data ['pescadores_id'] as $key=>$value){
            $pes_data = [
                'pescadores_id' => $value
            ];
            $var = $this->storePescadores($pes_data , $permisoPatron);
        }
        foreach($patrones_data ['patrones_id'] as $key=>$value){
            $pats_data = [
                'patrones_id' => $value
            ];
            $var = $this->storePatrones($pats_data , $permisoPatron);
        }

        
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.permisoZarpes');
        }
        elseif (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.permisoZarpes');
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
            $permisoZarpe = PermisoZarpe::find($id);
            $permisoZarpe->delete();
            if (Auth::user()->role_id == 4){
                return redirect()->route('admin.permisoZarpes');
            }
            elseif (Auth::user()->role_id == 5){
                return redirect()->route('usuarioPesca.permisoZarpes');
            }
        } 
        catch(\Exception $e){
           // catch code
             return redirect()->back()->withInput()->withErrors(['errors' => 'NO SE PUEDE ELIMINAR DEBIDO A QUE ESTA SIENDO USADA EN TRANSACCIONES']);
        }
    }
}
