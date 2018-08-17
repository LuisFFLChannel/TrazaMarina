<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Embarcacion;
use App\Models\EspecieMarina;
use App\Models\Puerto;
use App\Models\Pesca;
use App\Models\Desembarque;
use App\Models\HistorialHielo;
use App\User;
use Carbon\Carbon;
use Auth;
use DB;
//use App\Usuario;
use Session;

class HieloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    public function ajaxHistorialHielo($idEspecie,$idPuerto,$idEmbarcacion)
    {

        $especie = EspecieMarina::find($idEspecie);
        $factor_hielo = $especie->factorHielo;
        $last_historial = HistorialHielo::select('id','anho','mes')->where("especie_id","=", $idEspecie)->where("puerto_id","=",$idPuerto)->where("embarcacion_id","=",$idEmbarcacion)->orderBy('anho', 'desc')->orderBy('mes', 'desc')->limit(1)->get()->toArray();
        $var = Carbon::now('America/Lima');
        if (sizeof($last_historial) == 0 ||  ($last_historial[0]['anho'] != $var->year) || ($last_historial[0]['mes'] != $var->month)){
            $pescad = Desembarque::where("puerto_id","=",$idPuerto)->where("embarcacion_id","=",$idEmbarcacion)->whereMonth('fechaLlegada', '=',  $var->month)->whereYear('fechaLlegada', '=',  $var->year)->get()->toArray();
            $hielo_total = 0;
            $toneladas_total = 0;
            $cantidad_notas = 0;
            for ($i=0; $i < sizeof($pescad) ; $i++) { 
                $desembarque = Desembarque::find($pescad[$i]['id']);
                foreach ($desembarque->notaIngreso->toArray() as $key => $val_desembarque) {
                    if($idEspecie == $val_desembarque['especie_id'] ){
                        $toneladas_total = $toneladas_total + $val_desembarque['toneladas'];
                        $hielo_total = $hielo_total + $factor_hielo*$val_desembarque['toneladas'];
                        $cantidad_notas = $cantidad_notas + 1;
                    }
                }
                
            }
            if ($cantidad_notas != 0){
                $newHistorialHielo = new HistorialHielo();
                $newHistorialHielo->especie_id = $idEspecie;
                $newHistorialHielo->puerto_id = $idPuerto;
                $newHistorialHielo->embarcacion_id = $idEmbarcacion;
                $newHistorialHielo->toneladasPromedio = $toneladas_total/$cantidad_notas;
                $newHistorialHielo->hieloPromedio = $hielo_total/$cantidad_notas;
                $newHistorialHielo->mes = $var->month;
                $newHistorialHielo->anho = $var->year;
                $newHistorialHielo->fechaMes = $var;
                $newHistorialHielo->activo  =   1;
                $newHistorialHielo->save();
            }

        };
        if ((sizeof($last_historial) != 0) && ($last_historial[0]['anho'] == $var->year) && ($last_historial[0]['mes'] == $var->month) ){
            $pescad = Desembarque::where("puerto_id","=",$idPuerto)->where("embarcacion_id","=",$idEmbarcacion)->whereMonth('fechaLlegada', '=',  $var->month)->whereYear('fechaLlegada', '=',  $var->year)->get()->toArray();
            $hielo_total = 0;
            $toneladas_total =0;
            $cantidad_notas = 0;
            for ($i=0; $i < sizeof($pescad) ; $i++) { 
                $desembarque = Desembarque::find($pescad[$i]['id']);
                foreach ($desembarque->notaIngreso->toArray() as $key => $val_desembarque) {
                    if($idEspecie == $val_desembarque['especie_id'] ){
                        $toneladas_total = $toneladas_total + $val_desembarque['toneladas'];
                        $hielo_total = $hielo_total + $factor_hielo*$val_desembarque['toneladas'];
                        $cantidad_notas = $cantidad_notas + 1;
                    }
                }   
            }
            $newHistorialHielo = HistorialHielo::find($last_historial[0]['id']);
            $newHistorialHielo->toneladasPromedio = $toneladas_total/$cantidad_notas;
            $newHistorialHielo->hieloPromedio = $hielo_total/$cantidad_notas;
            $newHistorialHielo->save();
        }
        $historial = HistorialHielo::where("puerto_id","=",$idPuerto)->where("especie_id","=", $idEspecie)->where("embarcacion_id","=",$idEmbarcacion)->orderBy('anho', 'asc')->orderBy('mes', 'asc')->limit(12)->get()->toArray();
        $pescad = Desembarque::where("puerto_id","=",$idPuerto)->where("embarcacion_id","=",$idEmbarcacion)->orderBy('fechaLlegada', 'desc')->get()->toArray();
        
        // dd($historial);

        $dta = ['arreglo_historial' => $historial];
    return  json_encode( $dta);  
    }

    public function calcularHielo(){
        $embarcaciones_lista = Embarcacion::all()->lists('nombre','id');
        $puertos_lista = Puerto::all()->lists('nombre','id');
       // $dpas_lista = Dpa::all()->lists('nombre','id');
        $especies_lista = EspecieMarina::all()->lists('nombre','id');

        $arreglo = [
            // 'dpas_lista'   =>$dpas_lista,
             'embarcaciones_lista'   =>$embarcaciones_lista,
             'puertos_lista'      =>$puertos_lista,
             'especies_lista'        =>$especies_lista];

        if (Auth::user()->role_id == 4){
            return view('internal.admin.cantidadHielo',$arreglo);
        }
        elseif (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.cantidadHielo',$arreglo);
        }
    }
}
