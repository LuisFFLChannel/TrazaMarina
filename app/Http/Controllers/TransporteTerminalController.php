<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransporteTerminal\StoreTransporteTerminalRequest;
use App\Http\Requests\TransporteTerminal\UpdateTransporteTerminalRequest;
use App\Models\TransporteTerminal;
use App\Models\NotaIngresoTransporteTerminal;
use App\Models\NotaIngreso;
use App\Models\EmpresarioComercializador;
use App\Models\Terminal;
use App\Models\Transportista;
use App\Models\Frigorifico;
use App\User;
use Carbon\Carbon;
use Auth;
//use App\Usuario;
use Session;
use DB;

class TransporteTerminalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $transporteTerminales = TransporteTerminal::paginate(10);
       
        $transporteTerminales->setPath('transporteTerminal');
        if (Auth::user()->role_id == 4){
            return view('internal.admin.transporteTerminales', compact('transporteTerminales'));
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.transporteTerminales', compact('transporteTerminales'));
        }
        elseif  (Auth::user()->role_id == 7){
            return view('internal.usuarioValidacion.transporteTerminales', compact('transporteTerminales'));
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
        $terminales_lista = Terminal::all()->lists('nombre','id');
        //$empresarios_lista = EmpresarioComercializador::select('id', DB::raw('CONCAT(nombres, " ",apellidos) AS nombreCompleto'))->lists('nombreCompleto','id');
        $notas = NotaIngreso::whereNotNull("id")->get();
        $arreglo = [
        'terminales_lista'   =>$terminales_lista,
        'transportistas_lista'      =>$transportistas_lista,
        'frigorificos_lista'      =>$frigorificos_lista,
        //'empresarios_lista'      =>$empresarios_lista,
        'notas'           =>$notas];
        if (Auth::user()->role_id == 4){
            return view('internal.admin.nuevoTransporteTerminal',$arreglo);
        }
        elseif (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.nuevoTransporteTerminal',$arreglo);
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
        $nota->toneladasMercado = $nota->toneladasMercado + $data['toneladas'];
        $nota->toneladasSobrantes   = $nota->toneladasSobrantes - $data['toneladas'];
        $nota->save();
        return $nota;
    }
     public function storeRelacionNotaIngreso($data, $certificado){
        $var = new NotaIngresoTransporteTerminal();
        $var->transporte_id = $certificado->id;
        $var->notaIngreso_id = $data['notas_id'];
        $var->toneladas      = $data['toneladas'];
        $var->save();
        return $var;
    }

    public function store(StoreTransporteTerminalRequest $request)
    {
        //
        $input = $request->all();

        $certificado                                =   new TransporteTerminal;
        $certificado->terminal_id                    =   $input['terminal_id'];
        $certificado->frigorifico_id                =   $input['frigorifico_id'];
        $certificado->transportista_id              =   $input['transportista_id'];
        //$certificado->empresarioComercializador_id  =   $input['empresario_id'];
        $certificado->fechaSalida                  =   new Carbon($input['fechaDictada']);
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
            return redirect()->route('admin.transporteTerminales');
        }
        elseif  (Auth::user()->role_id == 6){
            return redirect()->route('usuarioIntermediario.transporteTerminales');
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
        $terminales_lista = Terminal::all()->lists('nombre','id');
        //$empresarios_lista = EmpresarioComercializador::select('id', DB::raw('CONCAT(nombres, " ",apellidos) AS nombreCompleto'))->lists('nombreCompleto','id');
        $notas = NotaIngreso::whereNotNull("id")->get();
        $transporteTerminal = TransporteTerminal::find($id);
        $arreglo = [
        'transporteTerminal'    =>$transporteTerminal,
        'terminales_lista'   =>$terminales_lista,
        'transportistas_lista'      =>$transportistas_lista,
        'frigorificos_lista'      =>$frigorificos_lista,
        //'empresarios_lista'      =>$empresarios_lista,
        'notas'           =>$notas];
        if (Auth::user()->role_id == 4){
            return view('internal.admin.editarTransporteTerminal',$arreglo);
        }
        elseif (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.editarTransporteTerminal',$arreglo);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransporteTerminalRequest $request, $id)
    {
        //
        $input = $request->all();

        $certificado = TransporteTerminal::find($id);

        $certificado->terminal_id                    =   $input['terminal_id'];
        $certificado->frigorifico_id                =   $input['frigorifico_id'];
        $certificado->transportista_id              =   $input['transportista_id'];
        //$certificado->empresarioComercializador_id  =   $input['empresario_id'];
        $certificado->fechaSalida                  =   new Carbon($input['fechaDictada']);
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
        $antiguosRelaNotas = NotaIngresoTransporteTerminal::where("transporte_id",'=',$certificado->id)->get();

        foreach ($antiguosRelaNotas as $auxPes) {
            //dd($auxPes);
            //$auxPes->toneladas = 
            $notaIngresoAuxiliar = NotaIngreso::find($auxPes->notaIngreso_id);
           // dd($notaIngresoAuxiliar);
            $notaIngresoAuxiliar->toneladasSobrantes =  $notaIngresoAuxiliar->toneladasSobrantes + $auxPes->toneladas;
            $notaIngresoAuxiliar->toneladasMercado =  $notaIngresoAuxiliar->toneladasMercado - $auxPes->toneladas;
            $notaIngresoAuxiliar->save();
            //$auxPes->delete();
        }
        DB::table('notaingreso_transporteterminal')->where("transporte_id",'=',$certificado->id)->delete();
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
            return redirect()->route('admin.transporteTerminales');
        }
        elseif  (Auth::user()->role_id == 6){
            return redirect()->route('usuarioIntermediario.transporteTerminales');
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
    public function lotesTerminales()
    {
        //
        $lista_Terminales = NotaIngresoTransporteTerminal::paginate(10);
       
        $lista_Terminales->setPath('$lista_Terminal');
        if (Auth::user()->role_id == 4){
            return view('internal.admin.lotesTerminales', compact('lista_Terminales'));
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.lotesTerminales', compact('lista_Terminales'));
        }
        elseif  (Auth::user()->role_id == 7){
            return view('internal.usuarioValidacion.lotesTerminales', compact('lista_Terminales'));
        }
    
    }
    public function agregarTraza($idNota, $idCertificado) {
        $notaIngreso = NotaIngreso::find($idNota);
        if ($notaIngreso->codigoTraza == null){
             return redirect()->back()->withInput()->withErrors(['errors' => 'El usuario Pesca aun no han asignado la primera parte del código de trazabilidad']);
        }
        $certificado = TransporteTerminal::find($idCertificado);
        //dd($certificado->id);
        $codFrigorifico =str_pad($certificado->frigorifico->placa,6,"X",STR_PAD_LEFT);
        $codTerminal = "F".str_pad($certificado->terminal->id,3,"0",STR_PAD_LEFT).substr($certificado->terminal->nombre, 0,3);
        $codCert = str_pad($idCertificado,6,"0",STR_PAD_LEFT);
        $valor = $codCert.$codFrigorifico.$codTerminal;
        $valorCompleto = $notaIngreso->codigoTraza.$valor;
        //dd($valorCompleto);
        $lote = NotaIngresoTransporteTerminal::where("notaIngreso_id","=",$idNota)->where("transporte_id","=",$idCertificado)->get()->first();
        $arreglo = [
            'notaIngreso'   => $notaIngreso,
            'certificado'   => $certificado,
            'lote'          => $lote,
            'codTerminal'    => $codTerminal,
            'codFrigorifico'=> $codFrigorifico,
            'codCert'       => $codCert,
            'valorCompleto' => $valorCompleto,
            'valor'         => $valor
        ];

        //dd($valor);
         if (Auth::user()->role_id == 4){
            return view('internal.admin.agregarTraza2Te', $arreglo);
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.agregarTraza2Te', $arreglo);
        }
    }
    public function updateTraza(Request $request, $idNota, $idCertificado) {
        
        $input = $request->all();
      
        $var = NotaIngresoTransporteTerminal::where("notaIngreso_id","=",$idNota)->where("transporte_id","=",$idCertificado)->get()->first();
        //dd($var);
           
            //$var->save();
        
        DB::table('notaingreso_transporteterminal')->where('notaIngreso_id', $idNota)->where('transporte_id',$idCertificado)->update(['codigoTraza' => $input['codigoTrazabilidad']]);

        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.lotesTerminales');
        }
        elseif  (Auth::user()->role_id == 6){
            return redirect()->route('usuarioIntermediario.lotesTerminales');
        }
    }
    public function mostrarTrazabilidad($idNota, $idCertificado) {

        $notaIngreso = NotaIngreso::find($idNota);
        if ($notaIngreso->codigoTraza == null){
             return redirect()->back()->withInput()->withErrors(['errors' => 'El usuario Pesca aun no han asignado la primera parte del código de trazabilidad']);
        }
        $lote = NotaIngresoTransporteTerminal::where("notaIngreso_id","=",$idNota)->where("transporte_id","=",$idCertificado)->get()->first();
        //dd($lote->codigoTraz);
        if ($lote->codigoTraza==null){
            return redirect()->back()->withInput()->withErrors(['errors' => 'Aun no se ha asignado un codigo de trazabilidad']);
        }
        $arreglo = [
            'lote'   => $lote,
            'notaIngreso' => $notaIngreso
        ];

        if (Auth::user()->role_id == 4){
            return view('internal.admin.mostrarTraza2Te', $arreglo);
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.mostrarTraza2Te', $arreglo);
        }
        elseif  (Auth::user()->role_id == 7){
            return view('internal.usuarioValidacion.mostrarTraza2Te', $arreglo);
        }
    }
}
