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
use App\Models\Embarcacion;
use App\Models\Pesca;
use App\User;
use Carbon\Carbon;
use Auth;
use App\Services\FileService;
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
    public function __construct(){
        $this->file_service = new FileService();
    }
    public function index()
    {
        //
        $permisoZarpes = PermisoZarpe::paginate(10);

        $permisoZarpes->setPath('permisoZarpes');
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
        $embarcaciones_lista = Embarcacion::select('id', DB::raw('CONCAT(nMatricula, " - ",nombre) AS nombreCompleto'))->lists('nombreCompleto','id'); 
        $arreglo = [
        'capitanias_lista'   =>$capitanias_lista,
        'puertos_lista'      =>$puertos_lista,
        'pescadores'         =>$pescadores,
        'patrones'           =>$patrones,
        'embarcaciones_lista'           =>$embarcaciones_lista];
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
        $permisoPatron->embarcacion_id              =   $input['embarcacion_id'];
        $permisoPatron->coordenadaX             =   $input['latitud'];
        $permisoPatron->coordenadaY             =   $input['longitud'];
        $permisoPatron->zonapesca             =   $input['zonaPesca'];
        $permisoPatron->fechaZarpe              =   new Carbon($input['fechaZarpe']);
        $permisoPatron->fechaArribo             =   new Carbon($input['fechaArribo']);
        $permisoPatron->puerto_id               =   $input['puerto_id'];
        $permisoPatron->capitania_id            =   $input['capitania_id'];
        $permisoPatron->asignado                =   false;
        $permisoPatron->activo                  =   true;
        //Control de subida de imagen por hacer
        if($request->file('pdf')!=null)
            $ppermisoPatron->pdf        =   $this->file_service->uploadpdf($request->file('pdf'),'permisoZarpe');

        $pescas = Pesca::where("arribo","=","false")->where('activo',true)->get();

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

            foreach ($pescas as $pes ) {
                //dd($pes->embarcacion->nombre);
                /*if ($pes->embarcacion->id == $input['embarcacion_id']){
                    return redirect()->back()->withInput()->withErrors(['errors' => 'La Embarcacion seleccionada se encuentra en alta mar en estos momentos']);
                }*/
                $pescadoresTotales = $pes->permisoZarpe->pescadores;
                
                    foreach ($pescadoresTotales as $auxPescadorTotal ) {
                        //dd($auxPescadorActual->id);
                        if ($pes_data['pescadores_id'] == $auxPescadorTotal->id){
                            return redirect()->back()->withInput()->withErrors(['errors' => 'Hay pescadores en el permiso de Zarpe que se encuentran en alta mar en estos momentos. Revise el Permiso Zarpe']);
                        }
                    }
                
            }

        }

        foreach($patrones_data ['patrones_id'] as $key1=>$value1){
            $pats_data = [
                'patrones_id' => $value1
            ];
            
            foreach ($pescas as $pes ) {
                //dd($pes->embarcacion->nombre);
                /*if ($pes->embarcacion->id == $input['embarcacion_id']){
                    return redirect()->back()->withInput()->withErrors(['errors' => 'La Embarcacion seleccionada se encuentra en alta mar en estos momentos']);
                }*/
                $pescadoresTotales = $pes->permisoZarpe->pescadores;
                
                    foreach ($pescadoresTotales as $auxPescadorTotal ) {
                        //dd($auxPescadorActual->id);
                        if ($pats_data['patrones_id'] == $auxPescadorTotal->id){
                            return redirect()->back()->withInput()->withErrors(['errors' => 'El patrón se encuentran en alta mar en estos momentos. Revise el Permiso Zarpe']);
                        }
                    }
                
            }

        }



        
         $embarcacion = Embarcacion::find($input['embarcacion_id']);
        //dd($embarcacion->certificado_matricula_id);
        if ($embarcacion->certificado_matricula_id == null or $embarcacion->certificado_matricula_id == 0 ){
            return redirect()->back()->withInput()->withErrors(['errors' => 'La Embarcacion seleccionada no tiene asociado ningun Certificado de Matricula']);
        }
        if ($embarcacion->permiso_pesca_id == null or $embarcacion->permiso_pesca_id == 0 ){
            return redirect()->back()->withInput()->withErrors(['errors' => 'La Embarcacion seleccionada no tiene asociado ningun Permiso de Pesca']);
        }

        
        




        /*$permisoZarpe = PermisoZarpe::find($input['permisoZarpe_id']);*/
        foreach ($pescas as $pes ) {
            //dd($pes->embarcacion->nombre);
            if ($pes->embarcacion->id == $input['embarcacion_id']){
                return redirect()->back()->withInput()->withErrors(['errors' => 'La Embarcacion seleccionada se encuentra en alta mar en estos momentos']);
            }
        }


         /*por motivos de necesidad el controller pesca no se usará ya que pesca se manejara internamente"*/


        $permisoPatron->asignado             =true;
        $permisoPatron->save();

        $pesca                              =   new Pesca;
        $pesca->embarcacion_id              =   $permisoPatron->embarcacion_id; 
        $pesca->coordenadaX                 =   $permisoPatron->coordenadaX;
        $pesca->coordenadaY                 =   $permisoPatron->coordenadaY;
        $pesca->fechaZarpe                  =   $permisoPatron->fechaZarpe; 
        $pesca->puerto_id                   =   $permisoPatron->puerto_id;
        $pesca->permisoZarpe_id             =   $permisoPatron->id;  
        $pesca->activo                      =   true;
        $pesca->arribo                      =   false;
        $pesca->save();
        
        





        
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
        $capitanias_lista = Capitania::all()->lists('nombre','id');
        $puertos_lista = Puerto::all()->lists('nombre','id');
        $pescadores_lista = Pescador::whereNotNull('permiso_marinero_id')->get();
        $patrones_lista = Pescador::whereNotNull('permiso_patron_id')->get();
         $embarcaciones_lista = Embarcacion::select('id', DB::raw('CONCAT(nMatricula, " - ",nombre) AS nombreCompleto'))->lists('nombreCompleto','id');


        $permisoZarpe = PermisoZarpe::find($id);
        if ($permisoZarpe ==null){
            return response()->view('errors.503', [], 404);
        }
        $arreglo = [
        'permisoZarpe'      =>$permisoZarpe,
        'capitanias_lista'   =>$capitanias_lista,
        'puertos_lista'      =>$puertos_lista,
        'pescadores'  =>$pescadores_lista,
        'patrones'    =>$patrones_lista,
        'embarcaciones_lista' => $embarcaciones_lista];
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
        $permisoPatron->embarcacion_id              =   $input['embarcacion_id'];
        $permisoPatron->coordenadaX             =   $input['latitud'];
        $permisoPatron->coordenadaY             =   $input['longitud'];
        $permisoPatron->zonapesca             =   $input['zonaPesca'];
        $permisoPatron->fechaZarpe              =   new Carbon($input['fechaZarpe']);
        $permisoPatron->fechaArribo             =   new Carbon($input['fechaArribo']);
        $permisoPatron->puerto_id               =   $input['puerto_id'];
        $permisoPatron->capitania_id            =   $input['capitania_id'];
        //Control de subida de imagen por hacer
        if($request->file('pdf')!=null)
            $permisoPatron->pdf        =   $this->file_service->uploadpdf($request->file('pdf'),'permisoZarpe');

        $pescas = Pesca::where("arribo","=","false")->where('activo',true)->where('permisozarpe_id','!=',$permisoPatron->id)->get();

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
            foreach ($pescas as $pes ) {
                //dd($pes->embarcacion->nombre);
                /*if ($pes->embarcacion->id == $input['embarcacion_id']){
                    return redirect()->back()->withInput()->withErrors(['errors' => 'La Embarcacion seleccionada se encuentra en alta mar en estos momentos']);
                }*/
                $pescadoresTotales = $pes->permisoZarpe->pescadores;
                
                    foreach ($pescadoresTotales as $auxPescadorTotal ) {
                        //dd($auxPescadorActual->id);
                        if ($pes_data['pescadores_id'] == $auxPescadorTotal->id){
                            return redirect()->back()->withInput()->withErrors(['errors' => 'Hay pescadores en el permiso de Zarpe que se encuentran en alta mar en estos momentos. Revise el Permiso Zarpe']);
                        }
                    }
                
            }
        }

        foreach($patrones_data ['patrones_id'] as $key1=>$value1){
            $pats_data = [
                'patrones_id' => $value1
            ];
            
            foreach ($pescas as $pes ) {
                //dd($pes->embarcacion->nombre);
                /*if ($pes->embarcacion->id == $input['embarcacion_id']){
                    return redirect()->back()->withInput()->withErrors(['errors' => 'La Embarcacion seleccionada se encuentra en alta mar en estos momentos']);
                }*/
                $pescadoresTotales = $pes->permisoZarpe->pescadores;
                
                    foreach ($pescadoresTotales as $auxPescadorTotal ) {
                        //dd($auxPescadorActual->id);
                        if ($pats_data['patrones_id'] == $auxPescadorTotal->id){
                            return redirect()->back()->withInput()->withErrors(['errors' => 'El patrón se encuentran en alta mar en estos momentos. Revise el Permiso Zarpe']);
                        }
                    }
                
            }

        }


         $embarcacion = Embarcacion::find($input['embarcacion_id']);
        //dd($embarcacion->certificado_matricula_id);
        if ($embarcacion->certificado_matricula_id == null or $embarcacion->certificado_matricula_id == 0 ){
            return redirect()->back()->withInput()->withErrors(['errors' => 'La Embarcacion seleccionada no tiene asociado ningun Certificado de Matricula']);
        }
        if ($embarcacion->permiso_pesca_id == null or $embarcacion->permiso_pesca_id == 0 ){
            return redirect()->back()->withInput()->withErrors(['errors' => 'La Embarcacion seleccionada no tiene asociado ningun Permiso de Pesca']);
        }

        

        /*$permisoZarpe = PermisoZarpe::find($input['permisoZarpe_id']);*/
        foreach ($pescas as $pes ) {
            //dd($pes->embarcacion->nombre);
            if ($pes->embarcacion->id == $input['embarcacion_id']){
                return redirect()->back()->withInput()->withErrors(['errors' => 'La Embarcacion seleccionada se encuentra en alta mar en estos momentos']);
            }
        }

        $antiguosPescadores = PermisoZarpePescadores::where("permisoZarpe_id",'=',$permisoPatron->id)->get();

        foreach ($antiguosPescadores as $auxPes) {
            //dd($auxPes);
            DB::table('permisoZarpe_pescadores')->where("permisoZarpe_id",'=',$permisoPatron->id)->delete();
            //$auxPes->delete();
        }

        $permisoPatron->asignado             = true;
        $permisoPatron->save();

        $pesca = $permisoPatron->pesca;

        $pesca->embarcacion_id              =   $permisoPatron->embarcacion_id; 
        $pesca->coordenadaX                 =   $permisoPatron->coordenadaX;
        $pesca->coordenadaY                 =   $permisoPatron->coordenadaY;
        $pesca->fechaZarpe                  =   $permisoPatron->fechaZarpe; 
        $pesca->puerto_id                   =   $permisoPatron->puerto_id;
        $pesca->permisoZarpe_id             =   $permisoPatron->id;  
        $pesca->save();

        




        
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
    public function pdf($id)
    {
        //
            $certificado = PermisoZarpe::find($id);
            if ($certificado->pdf == null){
                 return redirect()->back()->withInput()->withErrors(['errors' => 'No tiene asociado ningun pdf']);
            }


            try{

                $myfile = fopen($certificado->pdf, "r");

                $fileSize = filesize($certificado->pdf);
                header("HTTP/1.1 200 OK");
                header("Pragma: public");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

                header("Cache-Control: private", false);

                header("Content-type: application/pdf");
                header("Content-Disposition: attachment; filename=\"".$certificado->pdf."\""); 

                header("Content-Transfer-Encoding: binary");
                header("Content-Length: " . $fileSize);

                echo fread($myfile, $fileSize);

            } 
            catch(\Exception $e){
               // catch code
                 return redirect()->back()->withInput()->withErrors(['errors' => 'El archivo está mal direccionado']);
            }

    }

}
