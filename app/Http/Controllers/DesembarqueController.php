<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Desembarque\StoreDesembarqueRequest;
use App\Http\Requests\Desembarque\UpdateDesembarqueRequest;
use App\Models\Pesca;
use App\Models\Desembarque;
use App\Models\CertificadoArribo;
use App\Models\Embarcacion;
use App\Models\Pescador;
use App\Models\EspecieMarina;
use App\Models\NotaIngreso;
use App\Models\Puerto;
use App\Models\Dpa;
use App\User;
use Carbon\Carbon;
use Auth;
use DB;
//use App\Usuario;
use Session;

class DesembarqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $desembarques = Desembarque::paginate(10);
        
        $desembarques->setPath('desembarque');
        if (Auth::user()->role_id == 4){
            return view('internal.admin.desembarques', compact('desembarques'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.desembarques', compact('desembarques'));
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.desembarques', compact('desembarques'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $embarcaciones_lista = Embarcacion::all()->lists('nombre','id');
        $puertos_lista = Puerto::all()->lists('nombre','id');
        $dpas_lista = Dpa::all()->lists('nombre','id');
        $especies_lista = EspecieMarina::all()->lists('nombre','id');
        $pesca = Pesca::find($id);
       
      
        $arreglo = [
        'dpas_lista'   =>$dpas_lista,
        'embarcaciones_lista'   =>$embarcaciones_lista,
        'puertos_lista'      =>$puertos_lista,
        'especies_lista'        =>$especies_lista,
        'pesca' =>$pesca];


        if (Auth::user()->role_id == 4){
            return view('internal.admin.nuevoDesembarque',$arreglo);
        }
        elseif (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.nuevoDesembarque',$arreglo);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeNotaIngreso($data, $desembarque){
        $var = new NotaIngreso();
        $var->especie_id           = $data['especies_id'];
        $var->desembarque_id        = $desembarque->id;
        $var->toneladas             = $data['toneladas'];
        $var->tallaPromedio         = $data['tallas'];
        $var->toneladasSobrantes    = $data['toneladas'];
        $var->toneladasExportacion  = 0;
        $var->toneladasMercado      = 0;
        $var->save();
        return $var;
    }

    public function store(StoreDesembarqueRequest $request, $id)
    {
        //
        $input = $request->all();
        $pesca = Pesca::find($id);
        //dd($pesca);

        $desembarque                               =   new Desembarque;
        $desembarque ->embarcacion_id              =   $input['embarcacion_id'];
        $desembarque ->fechaLlegada                =   new Carbon($input['fechaLlegada']);

        $val = Carbon::parse($desembarque->fechaLlegada);
        $val2 = Carbon::parse($pesca->fechaZarpe);
        
        if($val->gt($val2)==false){
            return redirect()->back()->withInput()->withErrors(['errors' => 'La fecha de Arribo sucede antes que la fecha de Zarpe']);
        }   

        $especies_data = [
            'especies_id'     => $request->input('especies_id'),
            'toneladas'     => $request->input('toneladas'),
            'tallas'     => $request->input('tallas'),
        ];
        
        foreach($especies_data ['especies_id'] as $key1=>$value1){
            $pes_data = [
                'especies_id' => $value1
            ];
            foreach($especies_data ['especies_id'] as $key2=>$value2){
                $pes2_data = [
                    'especies_id' => $value2
                ];
                if ($key1!= $key2 and $pes_data['especies_id']==$pes2_data['especies_id']){
                     return redirect()->back()->withInput()->withErrors(['errors' => 'Se esta Repitiendo Especies Marinas en la creación de Notas de Ingreso']);
                }
            }
        }
        

        $desembarque ->puerto_id                   =   $input['puerto_id'];
        $desembarque ->dpa_id                      =   $input['dpa_id']; 
        $desembarque ->pesca_id                    =   $id; 
        $desembarque ->activo                      =   true;
        $desembarque ->save();
        $pesca->arribo                      =   true;
        $pesca->save();

        foreach($especies_data ['especies_id'] as $key=>$value){
            $pes_data = [
                'especies_id' => $value,
                'toneladas'   => $especies_data['toneladas'][$key],
                'tallas'   => $especies_data['tallas'][$key],
            ];
            $var = $this->storeNotaIngreso($pes_data , $desembarque);
        }

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
        $embarcaciones_lista = Embarcacion::all()->lists('nombre','id');
        $puertos_lista = Puerto::all()->lists('nombre','id');
        $dpas_lista = Dpa::all()->lists('nombre','id');
        $desembarque = Desembarque::find($id);
        $especies_lista = EspecieMarina::all()->lists('nombre','id');
        $pesca = Pesca::find($desembarque->pesca_id);
       
      
        $arreglo = [
        'dpas_lista'   =>$dpas_lista,
        'embarcaciones_lista'   =>$embarcaciones_lista,
        'puertos_lista'      =>$puertos_lista,
        'pesca' =>$pesca,
        'especies_lista'    =>$especies_lista,
        'desembarque' =>$desembarque];


        if (Auth::user()->role_id == 4){
            return view('internal.admin.editarDesembarque',$arreglo);
        }
        elseif (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.editarDesembarque',$arreglo);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDesembarqueRequest $request, $id)
    {
        //
        $input = $request->all();
        $desembarque= Desembarque::find($id);
       

        $desembarque ->embarcacion_id              =   $input['embarcacion_id'];
        $val = Carbon::parse($desembarque->fechaLlegada);
        $desembarque ->fechaLlegada                =   new Carbon($input['fechaLlegada']);

        $val2 = Carbon::parse($desembarque->pesca->fechaLlegaZarpe);

      
        if($val->gt($val2)==false){
            return redirect()->back()->withInput()->withErrors(['errors' => 'La fecha de Arribo sucede antes que la fecha de Zarpe']);
        }   

        $especies_data = [
            'especies_id'     => $request->input('especies_id'),
            'toneladas'     => $request->input('toneladas'),
            'tallas'     => $request->input('tallas'),
        ];

        foreach($especies_data ['especies_id'] as $key1=>$value1){
            $pes_data = [
                'especies_id' => $value1
            ];
            foreach($especies_data ['especies_id'] as $key2=>$value2){
                $pes2_data = [
                    'especies_id' => $value2
                ];
                if ($key1!= $key2 and $pes_data['especies_id']==$pes2_data['especies_id']){
                     return redirect()->back()->withInput()->withErrors(['errors' => 'Se esta Repitiendo Especies Marinas en la creación de Notas de Ingreso']);
                }
            }
        }

        $desembarque ->puerto_id                   =   $input['puerto_id'];
        $desembarque ->dpa_id                      =   $input['dpa_id']; 
        
        $desembarque ->save();

        $antiguosEspecies = NotaIngreso::where("desembarque_id",'=',$desembarque->id)->get();

        foreach ($antiguosEspecies as $auxPes) {
            //dd($auxPes);
            DB::table('notaIngreso')->where("desembarque_id",'=',$desembarque->id)->delete();
            //$auxPes->delete();
        }

        foreach($especies_data ['especies_id'] as $key=>$value){
            $pes_data = [
                'especies_id' => $value,
                'toneladas'   => $especies_data['toneladas'][$key],
                'tallas'   => $especies_data['tallas'][$key],
            ];
            $var = $this->storeNotaIngreso($pes_data , $desembarque);
        }
      
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.desembarques');
        }
        elseif  (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.desembarques');
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
    public function editCertificado($id)
    {
        //
        $desembarque = Desembarque::find($id);
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
        $certificadoArribos =CertificadoArribo::where('asignado','=',false)->get();
        
        if (Auth::user()->role_id == 4){
            return view('internal.admin.asociarCertificadoArribo', compact('desembarque','certificadoArribos'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.asociarCertificadoArribo', compact('desembarque','certificadoArribos'));
        }

        
    }
    public function showCertificado($id)
    {
        //
        $desembarque = Desembarque::find($id);
       // $certificado = CertificadoMatricula::find($embarcacion->certtificadoMatricula_id);
        if ($desembarque->certificadoArribo == null){
            return back()->withErrors(['Aun no se a asociado un certificado de arribo al desembarque']);
        }

        if (Auth::user()->role_id == 4){
            return view('internal.admin.mostrarCertificadoArribo', compact('desembarque'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.mostrarCertificadoArribo', compact('desembarque'));
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.mostrarCertificadoArribo', compact('desembarque'));
        }

        
    }
    public function updateCertificado(Request $request, $id)
    {
        //
        $input = $request->all();

        $desembarque = Desembarque::find($id);

        if($desembarque->certificado_matricula_id!=null){
            $certif= CertificadoArribo::find($desembarque->certificado_arribo_id);
            $certif->asignado=false;
            $certif->save();
        }


        $desembarque->certificado_arribo_id            =   $input['certificadoArribo'];
        $certificado= CertificadoArribo::find($input['certificadoArribo']);
        $certificado->asignado=true;
        $desembarque->save();
        $certificado->save();
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.certificadoArribos');
        }
        elseif  (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.certificadoArribos');
        }

    }
    public function getEspecieToAjax($id)
    {

        $especie = EspecieMarina::where("id","=",$id)->get()->toArray() ;



        return  json_encode( $especie);  
    }
    public function showNota($id){

        $desembarque      =Desembarque::find($id);
       
        $arreglo = [
        'desembarque'      =>$desembarque];


        if (Auth::user()->role_id == 4){
            return view('internal.admin.mostrarNota',$arreglo);
        }
        elseif (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.mostrarNota',$arreglo);
        }
        elseif (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.mostrarNota',$arreglo);
        }
    }
}
