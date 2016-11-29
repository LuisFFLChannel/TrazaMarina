<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\NotaIngreso\StoreNotaIngresoRequest;
use App\Http\Requests\NotaIngreso\UpdateNotaIngresoRequest;
use App\Models\Desembarque;
use App\Models\EspecieMarina;
use App\Models\NotaIngreso;
use App\User;
use Carbon\Carbon;
use Auth;
use DB;
use Illuminate\Support\Str;
use Form;
//use App\Usuario;
use Session;

class NotaIngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $notaIngresos = NotaIngreso::paginate(10);
       
        $notaIngresos->setPath('notaIngreso');
        if (Auth::user()->role_id == 4){
            return view('internal.admin.notasIngresos', compact('notaIngresos'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.notasIngresos', compact('notaIngresos'));
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.notasIngresos', compact('notaIngresos'));
        }
        elseif  (Auth::user()->role_id == 7){
            return view('internal.usuarioValidacion.notasIngresos', compact('notaIngresos'));
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $nota = NotaIngreso::find($id);
        $especie_lista = EspecieMarina::all()->lists('nombre','id');
        $arreglo = [
        'nota'     =>$nota,
        'especie_lista'    => $especie_lista];

        if (Auth::user()->role_id == 4){
            return view('internal.admin.editarNotaIngreso', $arreglo);
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.editarNotaIngreso', $arreglo);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNotaIngresoRequest $request, $id)
    {
        //
        $input = $request->all();

        $var = NotaIngreso::find($id);

        $existeEspecie = NotaIngreso::where("especie_id","=",$input['especie_id'])->where("desembarque_id","=",$var->desembarque->id)->where("id","<>",$id)->get();
        if ($existeEspecie!=null){
            return redirect()->back()->withInput()->withErrors(['errors' => 'Exste ya una Nota de Ingreso con esa Especie Marina para este desembarque']);
        }


        $var->especie_id            = $input['especie_id'];
        $var->toneladasSobrante     = $var->toneladasSobrante - $var->toneladas + $input['toneladas'];
        $var->toneladas             = $input['toneladas'];
        $var->tallaPromedio         = $input['tallaPromedio'];
        $var->toneladasSobrante     = $var->tallaPromedio;
        //$var->toneladasExportacion  = $input['toneladasEXportacion'];;
        //$var->toneladasMercado      = $input['toneladasMercado'];
        $var->save();

        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.notasIngresos');
        }
        elseif  (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.notasIngresos');
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
    public function sobrantes($id) {
        $var = NotaIngreso::find($id);
        return $var->toneladas - $var->toneladasMercado - $var->toneldasExportacion;
    }
    public function agregarTraza($id) {
        $notaIngreso = NotaIngreso::find($id);
        
        $codNota =str_pad($notaIngreso->id, 6, "0", STR_PAD_LEFT);
        $codPescado = str_pad($notaIngreso->especieMarina->id, 3, "0", STR_PAD_LEFT).substr($notaIngreso->especieMarina->nombre, 0,3);
        $codPuerto = str_pad($notaIngreso->desembarque->puerto->id, 3, "0", STR_PAD_LEFT).substr($notaIngreso->desembarque->puerto->nombre, 0,3);
        $codEmb = str_pad($notaIngreso->desembarque->embarcacion->id, 3, "0", STR_PAD_LEFT).substr($notaIngreso->desembarque->embarcacion->nombre, 0,3);
        $valor = $codPescado.$codEmb.$codPuerto.$codNota;

        $arreglo = [
            'notaIngreso'   => $notaIngreso,
            'codNota'       => $codNota,
            'codPescado'    => $codPescado,
            'codPuerto'     => $codPuerto,
            'codEmb'        => $codEmb,
            'valor'         => $valor
        ];

        //dd($valor);
         if (Auth::user()->role_id == 4){
            return view('internal.admin.agregarTraza', $arreglo);
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.agregarTraza', $arreglo);
        }
    }
    public function updateTraza(Request $request, $id) {
        
        $input = $request->all();

        $var = NotaIngreso::find($id);

        $var->codigoTraza            = $input['codigoTrazabilidad'];
        $var->save();

        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.notasIngresos');
        }
        elseif  (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.notasIngresos');
        }
    }
    public function verTraza($id) {
        $notaIngreso = NotaIngreso::find($id);
        if ($notaIngreso->codigoTraza==null){
            return redirect()->back()->withInput()->withErrors(['errors' => 'Aun no se ha asignado un codigo de trazabilidad']);
        }
        $arreglo = [
            'notaIngreso'   => $notaIngreso
        ];

        if (Auth::user()->role_id == 4){
            return view('internal.admin.mostrarTraza', $arreglo);
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.mostrarTraza', $arreglo);
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.mostrarTraza', $arreglo);
        }
        elseif  (Auth::user()->role_id == 7){
            return view('internal.usuarioValidacion.mostrarTraza', $arreglo);
        }
    }
    public function verLotesporNota($id){
        $nota = NotaIngreso::find($id);
        $lista_Terminal = $nota->notasPorTerminal;
        $lista_Fabrica  = $nota->notasPorFabrica;
        //dd($lista_Terminal);
        $arreglo = [
            'nota'   => $nota,
            'lista_Terminal'        => $lista_Terminal,
            'lista_Fabrica'         => $lista_Fabrica
        ];
        if (Auth::user()->role_id == 4){
            return view('internal.admin.verLotesporNota', $arreglo);
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.verLotesporNota', $arreglo);
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.verLotesporNota', $arreglo);
        }
        elseif  (Auth::user()->role_id == 7){
            return view('internal.usuarioValidacion.verLotesporNota', $arreglo);
        }
    }
    public function validarNota($id)
    {
        //
        $notaIngreso = NotaIngreso::find($id);
        
     
        
        $validarMarinero = false;

        $arreglo =[
            'notaIngreso' =>   $notaIngreso

        ];
        
        if  (Auth::user()->role_id == 7){
            return view('internal.usuarioValidacion.validarNota', $arreglo);
        }

    }
}
