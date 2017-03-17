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
        
        return view('external.home');
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
        $usuario = null;

        if (Auth::user()!= null){
            $usuario = User::find(Auth::user()->id);

        }

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
            'puertoA'   =>  $puertoA,
            'usuario'   =>  $usuario
        ];
         
        return view('external.producto', $arreglo);
    }
    
     public function buscarDocumentos($codigo,$idProducto)
    {
        
        
        $tipoProducto = $idProducto;
        $usuario = null;

        if (Auth::user()!= null){
            $usuario = User::find(Auth::user()->id);

        }
        $codigoTrazabilidad =$codigo;
        $certificadoProcedencia = null;
        $certificadoTerminal = null;
        $certificadoMatricula = null;
        $permisoPesca = null;
        $permisoZarpe = null;
        $certificadoArribo = null;
        //dd($auxData);
        

        if ($tipoProducto == 3){
            
            $auxData = NotaIngreso::where('codigoTraza', 'like', '%' . $codigoTrazabilidad . '%')->get()->first();
            $codigoTrazabilidad = $auxData->codigoTraza;
            $certificadoArribo = $auxData->desembarque->certificadoArribo;
            $permisoZarpe = $auxData->desembarque->pesca->permisoZarpe;
            $permisoPesca = $auxData->desembarque->embarcacion->permisoPesca;
            $certificadoMatricula = $auxData->desembarque->embarcacion->certificadoMatricula;

        }
        else if ($tipoProducto == 2){
            $auxData = NotaIngresoTransporteTerminal::where('codigoTraza', 'like', '%' . $codigoTrazabilidad . '%')->get()->first();


            $codigoTrazabilidad = $auxData->codigoTraza;
            $certificadoArribo = $auxData->nota->desembarque->certificadoArribo;
            $permisoZarpe = $auxData->nota->desembarque->pesca->permisoZarpe;
            $permisoPesca = $auxData->nota->desembarque->embarcacion->permisoPesca;
            $certificadoMatricula = $auxData->nota->desembarque->embarcacion->certificadoMatricula;
            $certificadoTerminal = $auxData->certificadoTerminal;
        }
        else{
            $auxData = NotaIngresoCertificadoProcedencia::where('codigoTraza', 'like', '%' . $codigoTrazabilidad . '%')->get()->first();
            
            $codigoTrazabilidad = $auxData->codigoTraza;
            $certificadoArribo = $auxData->nota->desembarque->certificadoArribo;
            $permisoZarpe = $auxData->nota->desembarque->pesca->permisoZarpe;
            $permisoPesca = $auxData->nota->desembarque->embarcacion->permisoPesca;
            $certificadoMatricula = $auxData->nota->desembarque->embarcacion->certificadoMatricula;
            $certificadoProcedencia = $auxData->certificado;

        }
    
        $arreglo = [
            'producto' => $auxData,
            'codigoTrazabilidad'  => $codigoTrazabilidad,
            'certificadoMatricula'  => $certificadoMatricula,
            'certificadoArribo' =>$certificadoArribo,
            'certificadoProcedencia' =>$certificadoProcedencia,
            'certificadoTerminal'   => $certificadoTerminal,
            'permisoPesca'  =>  $permisoPesca,
            'permisoZarpe'  =>  $permisoZarpe,
            'tipoProducto'  => $tipoProducto,
            'usuario'   =>  $usuario
        ];


        return view('external.productoDocumento', $arreglo);

    }
    public function calendar(request $request)
    {
        
    }

    public function eventsForDate(Request $request)
    {

        
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
