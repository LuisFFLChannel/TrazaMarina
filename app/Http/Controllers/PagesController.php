<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Highlight;
use App\Models\AttendanceDetail;
use Auth;
use App\User;
use App\Models\Preference;
use App\Models\Event;
use App\Models\About;
use App\Models\NotaIngresoCertificadoProcedencia;
use App\Models\NotaIngresoTransporteTerminal;
use App\Models\NotaIngreso;
use Carbon\Carbon;
use App\Models\Presentation;
use DB;

class PagesController extends Controller
{
    public function home()
    {
        /*$destacados = Highlight::where('active','1')->get();
        $upcoming   = Event::where('selling_date','>',strtotime(Carbon::now()))->where('publication_date','>',strtotime(Carbon::now()))->get();*/
        return view('external.home'/*,array('destacados'=>$destacados,'upcoming'=>$upcoming)*/);
    }

    public function about()
    {
        
        $about = About::all()->first();
        return view('external.about', compact('about'));
    }

    public function modules()
    {
        return view('external.modules');
    }
    public function buscarCodigo(request $request)
    {
        $input = $request->all();
        $tipoProducto = 0;
        $codigoTrazabilidad = "";
        $embarcacion = null;
        $pesca = null;
        $desembarque = null;
        $especieMarina = null;
        $puertoZ = null;
        $puertoA = null;
        $auxData = NotaIngresoCertificadoProcedencia::where('codigoTraza', 'like', '%' . $input['buscar'] . '%')->get()->first();
        if ($auxData == null){
            $auxData = NotaIngresoTransporteTerminal::where('codigoTraza', 'like', '%' . $input['buscar'] . '%')->get()->first();
            if ($auxData == null){
                $auxData = NotaIngreso::where('codigoTraza', 'like', '%' . $input['buscar'] . '%')->get()->first();
                if ($auxData==null){
                    return redirect()->back()->withInput()->withErrors(['errors' => 'Este código de trazabilidad no pertenece a ningun producto']);
                }
                else{
                    $tipoProducto = 3;
                    $codigoTrazabilidad = $auxData->codigoTraza;
                    $especieMarina = $auxData->especieMarina;
                    $desembarque = $auxData->desembarque;
                    $pesca = $auxData->desembarque->pesca;
                    $embarcacion =  $auxData->desembarque->embarcacion;
                    $puertoZ = $auxData->desembarque->pesca->puerto;
                    $puertoA = $auxData->desembarque->puerto;//nota sin distribución aun a mercado o fábrica
                }
            }
            else{
                $tipoProducto = 2;
                $codigoTrazabilidad = $auxData->codigoTraza;
                $especieMarina = $auxData->nota->especieMarina;
                $desembarque = $auxData->nota->desembarque;
                $pesca = $auxData->nota->desembarque->pesca;
                $embarcacion =  $auxData->nota->desembarque->embarcacion;
                $puertoZ = $auxData->nota->desembarque->pesca->puerto;
                $puertoA = $auxData->nota->desembarque->puerto;//lote de mercado
            }
        }
        else{
            $tipoProducto = 1;
            $codigoTrazabilidad = $auxData->codigoTraza; //lote de fabrica
            $especieMarina = $auxData->nota->especieMarina;
            $desembarque = $auxData->nota->desembarque;
            $pesca = $auxData->nota->desembarque->pesca;
            $embarcacion =  $auxData->nota->desembarque->embarcacion;
            $puertoZ = $auxData->nota->desembarque->pesca->puerto;
            $puertoA = $auxData->nota->desembarque->puerto;
        }

        $arreglo=[
            'producto' => $auxData,
            'tipoProducto'  => $tipoProducto,
            'codigoTrazabilidad'  => $codigoTrazabilidad,
            'embarcacion'   =>  $embarcacion,
            'especieMarina'   =>$especieMarina,
            'desembarque'   =>$desembarque,
            'pesca'   =>  $pesca,
            'embarcacion'   =>  $embarcacion,
            'puertoZ'   =>  $puertoZ,
            'puertoA'   =>  $puertoA
        ];
         
        return view('external.producto', $arreglo);
    }

    public function calendar(request $request)
    {
        $date_at = strtotime(date("Y-m-d"));
        $events = Event::where(["publication_date"=>$date_at,"cancelled"=>"0"])->get();

        $auxEvent = [];
        foreach ($events as $event) {
             if (count($event->presentations)>0)
                array_push($auxEvent,$event);
         } 
         $events = $auxEvent;

        $presentations = Presentation::where("cancelled","0")
                                    ->whereBetween("starts_at",[$date_at,$date_at+86400])
                                    ->get();

        $eventsDate = Event::where("cancelled","0")->where("selling_date",'<=', $date_at)->get();
        $eventInformation = [];
        foreach($eventsDate as $eventDate){
                    $presentationsDate = Presentation::where("cancelled","0")
                                    ->whereBetween("starts_at",[$date_at,$date_at+86400])
                                    ->where("event_id",$eventDate->id)
                                    ->get();
                    $presentationInformation = [];
                    if (count($presentationsDate)!=0){
                        foreach ($presentationsDate as $pre){
                            array_push($presentationInformation, array($pre->starts_at));
                        }
                        array_push($eventInformation, array($eventDate->image, $eventDate->id, $eventDate->name, $eventDate->place->name, $eventDate->place->address, $eventDate->category->name, $presentationInformation));

                    }


        }

        return view('external.calendar',["events"=>$events,"date_at"=>$date_at,"presentations"=>$presentations],compact('eventInformation'));
    }

    public function eventsForDate(Request $request)
    {

        $input = $request->all();
        $date_at = strtotime($input['date_at']);

        $presentations = Presentation::where("cancelled","0")
                                    ->whereBetween("starts_at",[$date_at,$date_at+86400])
                                    ->get();

        $eventsDate = Event::where("cancelled","0")->where("selling_date",'<=', $date_at)->get();
        $eventInformation = [];
        foreach($eventsDate as $eventDate){
                    $presentationsDate = Presentation::where("cancelled","0")
                                    ->whereBetween("starts_at",[$date_at,$date_at+86400])
                                    ->where("event_id",$eventDate->id)
                                    ->get();
                    $presentationInformation = [];
                    if (count($presentationsDate)!=0){
                        foreach ($presentationsDate as $pre){
                            array_push($presentationInformation, array($pre->starts_at));
                        }
                        array_push($eventInformation, array($eventDate->image, $eventDate->id, $eventDate->name, $eventDate->place->name, $eventDate->place->address, $eventDate->category->name, $presentationInformation));

                    }


        }

        $events = Event::where(["publication_date"=>$date_at,"cancelled"=>"0"])->get();
        return view('external.calendar',["events"=>$events,"date_at"=>$date_at,"presentations"=>$presentations],compact('eventInformation'));
    }


    public function clientHome()
    {

        $client = User::find(Auth::user()->id);
        
        return view('internal.client.home',compact('client'));
    }
    public function clientMasterHome()
    {

        $client = User::find(Auth::user()->id);
        
        return view('internal.clientMaster.home',compact('client'));
    }

    public function salesmanHome()
    {
        return view('internal.salesman.home');
    }

    public function promoterHome()
    {
        $userId = Auth::user()->id;
        $events = Event::where("promoter_id",$userId)
        ->whereHas('presentations', function($query){
            $query->where('starts_at','>=', time());
        })->paginate(10);
        return view('internal.promoter.home',["events"=>$events]);
    }

    public function adminHome()
    {
        return view('internal.admin.home');
    }
    public function usuarioPescaHome()
    {
        return view('internal.usuarioPesca.home');
    }
     public function usuarioIntermediarioHome()
    {
        return view('internal.usuarioIntermediario.home');
    }
    public function usuarioValidacionHome()
    {
        return view('internal.usuarioValidacion.home');
    }

}
