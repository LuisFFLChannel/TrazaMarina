<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Embarcacion\StoreEmbarcacionRequest;
use App\Http\Requests\Embarcacion\UpdateEmbarcacionRequest;
use App\Models\Embarcacion;
use App\Services\FileService;
use App\User;
use Carbon\Carbon;
use App\Models\PermisoPesca;
use App\Models\CertificadoMatricula;
//use App\Usuario;
use Session;
use Auth;
use DB;
class EmbarcacionController extends Controller
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
        $embarcaciones = Embarcacion::paginate(10);
        $embarcaciones->setPath('embarcacion');
        if (Auth::user()->role_id == 4){
            return view('internal.admin.embarcaciones', compact('embarcaciones'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.embarcaciones', compact('embarcaciones'));
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
            return view('internal.admin.nuevoEmbarcacion');
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.nuevoEmbarcacion');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmbarcacionRequest $request)
    {
        //
        $input = $request->all();

        $embarcacion                    =   new Embarcacion;
        $embarcacion->nombre            =   $input['nombre'];
        $embarcacion->nMatricula        =   $input['nMatricula'];
        $embarcacion->nombreDueno       =   $input['nombreDueno'];
        $embarcacion->apellidoDueno     =   $input['apellidoDueno'];
        $embarcacion->capacidad         =   $input['capacidad'];
        $embarcacion->estara            =   $input['estara'];
        $embarcacion->manga             =   $input['manga'];
        $embarcacion->puntual           =   $input['puntual'];
        $embarcacion->activo            =   true;
        //Control de subida de imagen por hacer
        $embarcacion->imagen        =   $this->file_service->upload($request->file('imagen'),'embarcacion');

        $embarcacion->save();
        
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.embarcaciones');
        }
        elseif  (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.embarcaciones');
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
        $embarcacion = Embarcacion::find($id);
        if (Auth::user()->role_id == 4){
            return view('internal.admin.editarEmbarcacion', compact('embarcacion'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.editarEmbarcacion', compact('embarcacion'));
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmbarcacionRequest $request, $id)
    {
        //
        $input = $request->all();

        $embarcacion = Embarcacion::find($id);

        $embarcacion->nombre            =   $input['nombre'];
        $embarcacion->nMatricula        =   $input['nMatricula'];
        $embarcacion->nombreDueno       =   $input['nombreDueno'];
        $embarcacion->apellidoDueno     =   $input['apellidoDueno'];
        $embarcacion->capacidad         =   $input['capacidad'];
        $embarcacion->estara            =   $input['estara'];
        $embarcacion->manga             =   $input['manga'];
        $embarcacion->puntual           =   $input['puntual'];
        $embarcacion->activo            =   true;
        //Control de subida de imagen por hacer
        if($request->file('imagen')!=null)
            $embarcacion->imagen        =   $this->file_service->upload($request->file('imagen'),'embarcacion');

        $embarcacion->save();

        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.embarcaciones');
        }
        elseif  (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.embarcaciones');
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
        $embarcacion = Embarcacion::find($id);
        $embarcacion->delete();

        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.embarcaciones');
        }
        elseif  (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.embarcaciones');
        }
        
    }
    public function editCertificado($id)
    {
        //
        $embarcacion = Embarcacion::find($id);
        /*$certificadoMatriculas = DB::table('embarcacion')
                    ->select(DB::raw('certificadoMatricula.id as id, certificadoMatricula.nombreDueno as nombreDueno, certificadoMatricula.apellidosDueno as apellidosDueno, certificadoMatricula.nMatricula as nMatricula'))
                    ->whereNotNull('embarcacion.certificado_matricula_id')
                    ->rightJoin('certificadoMatricula', 'embarcacion.certificado_matricula_id', '!=', 'certificadoMatricula.id')
                    ->get();

        dd($certificadoMatriculas) ;          
        if($certificadoMatriculas==null){
            $certificadoMatriculas =CertificadoMatricula::where('id','>=',0)->toList();
        }
        
        if($certificadoMatriculas[0]->id==null){
            unset($certificadoMatriculas[0]);
        }*/
        $certificadoMatriculas =CertificadoMatricula::where('asignado','=',false)->get();
        
        if (Auth::user()->role_id == 4){
            return view('internal.admin.asociarCertificadoMatricula', compact('embarcacion','certificadoMatriculas'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.asociarCertificadoMatricula', compact('embarcacion','certificadoMatriculas'));
        }

        
    }
    public function editPermiso($id)
    {
        //
        $embarcacion = Embarcacion::find($id);
        /*$permisoPescas = DB::table('embarcacion')
                    ->select(DB::raw('permisoPesca.id as id, permisoPesca.nombre as nombre, permisoPesca.fechaVigencia as fechaVigencia, permisoPesca.nMatricula as nMatricula'))
                    ->whereNotNull('embarcacion.permiso_pesca_id')
                    ->leftJoin('permisoPesca', 'embarcacion.permiso_pesca_id', '!=', 'permisoPesca.id')
                    ->get();
        
        if($permisoPescas==null){
            $permisoPescas =PermisoPesca::where('id','>=',0)->get();
        }
        if($permisoPescas[0]->id==null){
            unset($permisoPescas[0]);
        }*/
        $permisoPescas =PermisoPesca::where('asignado','=',false)->get();

        if (Auth::user()->role_id == 4){
            return view('internal.admin.asociarPermisoPesca', compact('embarcacion','permisoPescas'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.asociarPermisoPesca', compact('embarcacion','permisoPescas'));
        }

        
    }
    public function showCertificado($id)
    {
        //
        $embarcacion = Embarcacion::find($id);
       // $certificado = CertificadoMatricula::find($embarcacion->certtificadoMatricula_id);
        if ($embarcacion->certificadoMatricula == null){
            return back()->withErrors(['Aun no se a asociado un certificado de matricula a la embarcacion']);
        }

        if (Auth::user()->role_id == 4){
            return view('internal.admin.mostrarCertificadoMatricula', compact('embarcacion'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.mostrarCertificadoMatricula', compact('embarcacion'));
        }

        
    }
    public function showPermiso($id)
    {
        //
        $embarcacion = Embarcacion::find($id);
        //$permiso = PermisoPesca::find($embarcacion->permisoPesca_id);
        if ($embarcacion->permisoPesca == null){
            return back()->withErrors(['Aun no se a asociado un permiso de pesca a la embarcacion']);
        }

        if (Auth::user()->role_id == 4){
            return view('internal.admin.mostrarPermisoPesca', compact('embarcacion'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.mostrarPermisoPesca', compact('embarcacion'));
        }
        
    }
    public function updateCertificado(Request $request, $id)
    {
        //
        $input = $request->all();

        $embarcacion = Embarcacion::find($id);

        $embarcacion->certificado_matricula_id            =   $input['certificadoMatricula'];
        $certificado= CertificadoMatricula::find($input['certificadoMatricula']);
        $certificado->asignado=true;
        $embarcacion->save();
        $certificado->save();
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.embarcaciones');
        }
        elseif  (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.embarcaciones');
        }

    }
    public function updatePermiso(Request $request, $id)
    {
        //
        $input = $request->all();

        $embarcacion = Embarcacion::find($id);

        $embarcacion->permiso_pesca_id            =   $input['permisoPesca'];
        $permiso= PermisoPesca::find($input['permisoPesca']);
        $permiso->asignado=true;

        $embarcacion->save();
        $permiso->save();
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.embarcaciones');
        }
        elseif  (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.embarcaciones');
        }

    }
}
