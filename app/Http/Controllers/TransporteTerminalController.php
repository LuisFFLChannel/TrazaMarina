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
use App\Models\Fabrica;
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
        //$empresarios_lista = EmpresarioComercializador::select('id', DB::raw('CONCAT(nombres, " ",apellidos) AS nombreCompleto'))->lists('nombreCompleto','id');
        $notas = NotaIngreso::whereNotNull("id")->get();
        $arreglo = [
        'fabricas_lista'   =>$fabricas_lista,
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
        $nota->toneladasExportacion = $nota->toneladasExportacion + $data['toneladas'];
        $nota->toneladasSobrantes   = $nota->toneladasSobrantes - $data['toneladas'];
        $nota->save();
        return $nota;
    }
     public function storeRelacionNotaIngreso($data, $certificado){
        $var = new NotaIngresotransporteTerminal();
        $var->certificado_id = $certificado->id;
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
        $certificado->fabrica_id                    =   $input['fabrica_id'];
        $certificado->frigorifico_id                =   $input['frigorifico_id'];
        $certificado->transportista_id              =   $input['transportista_id'];
        //$certificado->empresarioComercializador_id  =   $input['empresario_id'];
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
        $fabricas_lista = Fabrica::all()->lists('nombre','id');
        //$empresarios_lista = EmpresarioComercializador::select('id', DB::raw('CONCAT(nombres, " ",apellidos) AS nombreCompleto'))->lists('nombreCompleto','id');
        $notas = NotaIngreso::whereNotNull("id")->get();
        $transporteTerminal = TransporteTerminal::find($id);
        $arreglo = [
        'transporteTerminal'    =>$transporteTerminal,
        'fabricas_lista'   =>$fabricas_lista,
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

        $certificado->fabrica_id                    =   $input['fabrica_id'];
        $certificado->frigorifico_id                =   $input['frigorifico_id'];
        $certificado->transportista_id              =   $input['transportista_id'];
        //$certificado->empresarioComercializador_id  =   $input['empresario_id'];
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
        $this->BorrarRelacionesPasadasNotaIngreso($nos_data , $certificado);
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
}
