<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CertificadoProcedencia\StoreCertificadoProcedenciaRequest;
use App\Http\Requests\CertificadoProcedencia\UpdateCertificadoProcedenciaRequest;
use App\Models\CertificadoProcedencia;
use App\Models\NotaIngresoCertificadoProcedencia;
use App\Models\NotaIngreso;
use App\Models\EmpresarioComercializador;
use App\Models\Fabrica;
use App\Models\Transportista;
use App\Models\Frigorifico;
use App\User;
use Carbon\Carbon;
use Auth;
//use App\Usuario;
use Session;
use DB;
class CertificadoProcedenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $certificadoProcedencias = CertificadoProcedencia::paginate(10);
       
        $certificadoProcedencias->setPath('certificadoProcedencia');
        if (Auth::user()->role_id == 4){
            return view('internal.admin.CertificadoProcedencias', compact('certificadoProcedencias'));
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.CertificadoProcedencias', compact('certificadoProcedencias'));
        }
        elseif  (Auth::user()->role_id == 7){
            return view('internal.usuarioValidacion.CertificadoProcedencias', compact('certificadoProcedencias'));
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
        $frigorificos_lista = Frigorifico::all()->lists('nombre','id');
        $transportistas_lista = Transportista::select('id', DB::raw('CONCAT(nombres, " ",apellidos) AS nombreCompleto'))->lists('nombreCompleto','id');
        $fabricas_lista = Fabrica::all()->lists('nombre','id');
        $empresarios_lista = EmpresarioComercializador::select('id', DB::raw('CONCAT(nombres, " ",apellidos) AS nombreCompleto'))->lists('nombreCompleto','id');
        $notas = NotaIngreso::whereNotNull("id")->get();
        $arreglo = [
        'fabricas_lista'   =>$fabricas_lista,
        'transportistas_lista'      =>$transportistas_lista,
        'frigorificos_lista'      =>$frigorificos_lista,
        'empresarios_lista'      =>$empresarios_lista,
        'notas'           =>$notas];
        if (Auth::user()->role_id == 4){
            return view('internal.admin.nuevoCertificadoProcedencia',$arreglo);
        }
        elseif (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.nuevoCertificadoProcedencia',$arreglo);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeActualizarNotaIngreso($data, $certificado){

        //$var = new NotaIngreso();

        $nota       =   NotaIngreso::find($data['notas_id']);    
        $nota->toneladasExportacion = $nota->toneladasExportacion + $data['toneladas'];
        $nota->toneladasSobrantes   = $nota->toneladasSobrantes - $data['toneladas'];
        $nota->save();
        return $nota;
    }
     public function storeRelacionNotaIngreso($data, $certificado){
        $var = new NotaIngresoCertificadoProcedencia();
        $var->certificado_id = $certificado->id;
        $var->notaIngreso_id = $data['notas_id'];
        $var->toneladas      = $data['toneladas'];
        $var->save();
        return $var;
    }

    public function store(StoreCertificadoProcedenciaRequest $request)
    {
        //
        $input = $request->all();

        $certificado                                =   new CertificadoProcedencia;
        $certificado->fabrica_id                    =   $input['fabrica_id'];
        $certificado->frigorifico_id                =   $input['frigorifico_id'];
        $certificado->transportista_id              =   $input['transportista_id'];
        $certificado->empresarioComercializador_id  =   $input['empresario_id'];
        $certificado->fechaDictada                  =   new Carbon($input['fechaDictada']);
        $certificado->activo                        =   true;

        $notas_data = [
            'notas_id'     => $request->input('notas_id'),
            'toneladas'     => $request->input('toneladas')
        ];
        //dd($notas_data);
        foreach($notas_data ['notas_id'] as $key1=>$value1){
            $pes_data = [
                'notas_id' => $value1
            ];
            foreach($notas_data ['notas_id'] as $key2=>$value2){
                $pes2_data = [
                    'notas_id' => $value2
                ];
                if ($key1!= $key2 and $pes_data['notas_id']==$pes2_data['notas_id']){
                     return redirect()->back()->withInput()->withErrors(['errors' => 'Se esta Repitiendo Notas de Ingresos de una misma Especie Marina en la creación de Notas de Ingreso']);
                }
            }
        }
        //dd($certificado);
        $certificado->save();

        foreach($notas_data ['notas_id'] as $key=>$value){
            $nos_data = [
                'notas_id' => $value,
                'toneladas'   => $notas_data['toneladas'][$key]
            ];
            $var = $this->storeRelacionNotaIngreso($nos_data , $certificado);
            $var2 = $this->storeActualizarNotaIngreso($nos_data , $certificado);
        }

        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.certificadoProcedencias');
        }
        elseif  (Auth::user()->role_id == 6){
            return redirect()->route('usuarioIntermediario.certificadoProcedencias');
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
        $frigorificos_lista = Frigorifico::all()->lists('nombre','id');
        $transportistas_lista = Transportista::select('id', DB::raw('CONCAT(nombres, " ",apellidos) AS nombreCompleto'))->lists('nombreCompleto','id');
        $fabricas_lista = Fabrica::all()->lists('nombre','id');
        $empresarios_lista = EmpresarioComercializador::select('id', DB::raw('CONCAT(nombres, " ",apellidos) AS nombreCompleto'))->lists('nombreCompleto','id');
        $notas = NotaIngreso::whereNotNull("id")->get();
        $certificadoProcedencia = CertificadoProcedencia::find($id);
        $arreglo = [
        'certificadoProcedencia'    =>$certificadoProcedencia,
        'fabricas_lista'   =>$fabricas_lista,
        'transportistas_lista'      =>$transportistas_lista,
        'frigorificos_lista'      =>$frigorificos_lista,
        'empresarios_lista'      =>$empresarios_lista,
        'notas'           =>$notas];
        if (Auth::user()->role_id == 4){
            return view('internal.admin.editarCertificadoProcedencia',$arreglo);
        }
        elseif (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.editarCertificadoProcedencia',$arreglo);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCertificadoProcedenciaRequest $request, $id)
    {
        //
        $input = $request->all();

        $certificado = CertificadoProcedencia::find($id);

        $certificado->fabrica_id                    =   $input['fabrica_id'];
        $certificado->frigorifico_id                =   $input['frigorifico_id'];
        $certificado->transportista_id              =   $input['transportista_id'];
        $certificado->empresarioComercializador_id  =   $input['empresario_id'];
        $certificado->fechaDictada                  =   new Carbon($input['fechaDictada']);
        //$certificado->activo                        =   true;

        $notas_data = [
            'notas_id'     => $request->input('notas_id'),
            'toneladas'     => $request->input('toneladas')
        ];
        //dd($notas_data);
        foreach($notas_data ['notas_id'] as $key1=>$value1){
            $pes_data = [
                'notas_id' => $value1
            ];
            foreach($notas_data ['notas_id'] as $key2=>$value2){
                $pes2_data = [
                    'notas_id' => $value2
                ];
                if ($key1!= $key2 and $pes_data['notas_id']==$pes2_data['notas_id']){
                     return redirect()->back()->withInput()->withErrors(['errors' => 'Se esta Repitiendo Notas de Ingresos de una misma Especie Marina en la creación de Notas de Ingreso']);
                }
            }
        }
        //dd($certificado);
        //$this->BorrarRelacionesPasadasNotaIngreso($notas_data , $certificado);

        $antiguosRelaNotas = NotaIngresoCertificadoProcedencia::where("certificado_id",'=',$certificado->id)->get();

        foreach ($antiguosRelaNotas as $auxPes) {
            //dd($auxPes);
            //$auxPes->toneladas = 
            $notaIngresoAuxiliar = NotaIngreso::find($auxPes->notaIngreso_id);
           // dd($notaIngresoAuxiliar);
            $notaIngresoAuxiliar->toneladasSobrantes =  $notaIngresoAuxiliar->toneladasSobrantes + $auxPes->toneladas;
            $notaIngresoAuxiliar->toneladasExportacion =  $notaIngresoAuxiliar->toneladasExportacion - $auxPes->toneladas;
            $notaIngresoAuxiliar->save();
            //$auxPes->delete();
        }
        DB::table('notaingreso_certificadoprocedencia')->where("certificado_id",'=',$certificado->id)->delete();


        $certificado->save();

        foreach($notas_data ['notas_id'] as $key=>$value){
            $nos_data = [
                'notas_id' => $value,
                'toneladas'   => $notas_data['toneladas'][$key]
            ];
            $var = $this->storeRelacionNotaIngreso($nos_data , $certificado);
            $var2 = $this->storeActualizarNotaIngreso($nos_data , $certificado);
        }

        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.certificadoProcedencias');
        }
        elseif  (Auth::user()->role_id == 6){
            return redirect()->route('usuarioIntermediario.certificadoProcedencias');
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
    
    public function ajaxNotaIngreso($id_variable)
    {

        $not = NotaIngreso::find($id_variable);
        $arreglo = [
        'id'   =>$not->id,
        'especie'      =>$not->especieMarina->nombre,
        'desembarque'      =>$not->desembarque->id,
        'pesca'      =>$not->desembarque->pesca->id,
        'embarcacion'      =>$not->desembarque->embarcacion->nombre,
        'puerto'      =>$not->desembarque->puerto->nombre];
        //dd($arreglo);

    return  json_encode($arreglo);  
    }

    public function lotesFabricas()
    {
        //
        $lista_Fabricas = NotaIngresoCertificadoProcedencia::paginate(10);
       
        $lista_Fabricas->setPath('$lista_Fabrica');
        if (Auth::user()->role_id == 4){
            return view('internal.admin.lotesFabricas', compact('lista_Fabricas'));
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.lotesFabricas', compact('lista_Fabricas'));
        }
        elseif  (Auth::user()->role_id == 7){
            return view('internal.usuarioValidacion.lotesFabricas', compact('lista_Fabricas'));
        }
    
    }
    public function agregarTraza($idNota, $idCertificado) {
        $notaIngreso = NotaIngreso::find($idNota);
        if ($notaIngreso->codigoTraza == null){
             return redirect()->back()->withInput()->withErrors(['errors' => 'El usuario Pesca aun no han asignado la primera parte del código de trazabilidad']);
        }
        $certificado = CertificadoProcedencia::find($idCertificado);
        //dd($certificado->id);
        $codFrigorifico =str_pad($certificado->frigorifico->placa,6,"X",STR_PAD_LEFT);
        $codFabrica = "F".str_pad($certificado->fabrica->id,3,"0",STR_PAD_LEFT).substr($certificado->fabrica->nombre, 0,3);
        $codCert = str_pad($idCertificado,6,"0",STR_PAD_LEFT);
        $valor = $codCert.$codFrigorifico.$codFabrica;
        $valorCompleto = $notaIngreso->codigoTraza.$valor;
        //dd($valorCompleto);
        $lote = NotaIngresoCertificadoProcedencia::where("notaIngreso_id","=",$idNota)->where("certificado_id","=",$idCertificado)->get()->first();
        $arreglo = [
            'notaIngreso'   => $notaIngreso,
            'certificado'   => $certificado,
            'lote'          => $lote,
            'codFabrica'    => $codFabrica,
            'codFrigorifico'=> $codFrigorifico,
            'codCert'       => $codCert,
            'valorCompleto' => $valorCompleto,
            'valor'         => $valor
        ];

        //dd($valor);
         if (Auth::user()->role_id == 4){
            return view('internal.admin.agregarTraza2Fa', $arreglo);
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.agregarTraza2Fa', $arreglo);
        }
    }
    public function updateTraza(Request $request, $idNota, $idCertificado) {
        
        $input = $request->all();

        $var = NotaIngresoCertificadoProcedencia::where("notaIngreso_id","=",$idNota)->where("certificado_id","=",$idCertificado)->get()->first();
        //dd($var);
            $var->codigoTraza            = $input['codigoTrazabilidad'];
            //$var->save();
        
        DB::table('notaingreso_certificadoprocedencia')->where('notaIngreso_id', $idNota)->where('certificado_id',$idCertificado)->update(['codigoTraza' => $input['codigoTrazabilidad']]);

        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.lotesFabricas');
        }
        elseif  (Auth::user()->role_id == 6){
            return redirect()->route('usuarioIntermediario.lotesFabricas');
        }
    }
    public function mostrarTrazabilidad($idNota, $idCertificado) {

        $notaIngreso = NotaIngreso::find($idNota);
        if ($notaIngreso->codigoTraza == null){
             return redirect()->back()->withInput()->withErrors(['errors' => 'El usuario Pesca aun no han asignado la primera parte del código de trazabilidad']);
        }
        $lote = NotaIngresoCertificadoProcedencia::where("notaIngreso_id","=",$idNota)->where("certificado_id","=",$idCertificado)->get()->first();
        //dd($lote->codigoTraz);
        if ($lote->codigoTraza==null){
            return redirect()->back()->withInput()->withErrors(['errors' => 'Aun no se ha asignado un codigo de trazabilidad']);
        }
        $arreglo = [
            'lote'   => $lote,
            'notaIngreso' => $notaIngreso
        ];

        if (Auth::user()->role_id == 4){
            return view('internal.admin.mostrarTraza2Fa', $arreglo);
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.mostrarTraza2Fa', $arreglo);
        }
        elseif  (Auth::user()->role_id == 7){
            return view('internal.usuarioValidacion.mostrarTraza2Fa', $arreglo);
        }
    }
}
