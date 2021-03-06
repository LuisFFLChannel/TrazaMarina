<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CertificadoArribo\StoreCertificadoArriboRequest;
use App\Http\Requests\CertificadoArribo\UpdateCertificadoArriboRequest;
use App\Models\CertificadoArribo;
use App\User;
use Carbon\Carbon;
use Auth;
//use App\Usuario;
use Session;


class CertificadoArriboController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $certificadoArribos = CertificadoArribo::paginate(10);
        $certificadoArribos->setPath('certificadoArribos');
        if (Auth::user()->role_id == 4){
            return view('internal.admin.certificadoArribos', compact('certificadoArribos'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.certificadoArribos', compact('certificadoArribos'));
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.certificadoArribos', compact('certificadoArribos'));
        }
        elseif  (Auth::user()->role_id == 7){
            return view('internal.usuarioValidacion.certificadoArribos', compact('certificadoArribos'));
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
            return view('internal.admin.nuevoCertificadoArribo');
        }
        elseif (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.nuevoCertificadoArribo');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCertificadoArriboRequest $request)
    {
        //
        $input = $request->all();

        $certificadoArribo                        =   new CertificadoArribo;
        $certificadoArribo->codigo                =   $input['codigo'];
        $certificadoArribo->nMatricula            =   $input['nMatricula'];
        $certificadoArribo->fechaArribo           =   new Carbon($input['fechaArribo']);
        $certificadoArribo->asignado              =   false;
        $certificadoArribo->activo                =   true;

        //Control de subida de imagen por hacer

        $certificadoArribo->save();
        
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.certificadoArribos');
        }
        elseif (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.certificadoArribos');
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
        $certificadoArribo = CertificadoArribo::find($id);
        if ($certificadoArribo==null){
            return response()->view('errors.503', [], 404);
        }
        if (Auth::user()->role_id == 4){
            return view('internal.admin.editarCertificadoArribo', compact('certificadoArribo'));
        }
        elseif (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.editarCertificadoArribo', compact('certificadoArribo'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCertificadoArriboRequest $request, $id)
    {
        //
        $input = $request->all();

        $certificadoArribo = CertificadoArribo::find($id);

        $certificadoArribo->codigo                =   $input['codigo'];
        $certificadoArribo->nMatricula            =   $input['nMatricula'];
        $certificadoArribo->fechaArribo           =   new Carbon($input['fechaArribo']);
        //Control de subida de imagen por hacer

        $certificadoArribo->save();
         if (Auth::user()->role_id == 4){
            return redirect()->route('admin.certificadoArribos');
        }
        elseif (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.certificadoArribos');
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
            $certificadoArribo = CertificadoArribo::find($id);
            $certificadoArribo->delete();
            if (Auth::user()->role_id == 4){
                return redirect()->route('admin.certificadoArribos');
            }
            elseif (Auth::user()->role_id == 5){
                return redirect()->route('usuarioPesca.certificadoArribos');
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
            $certificadoArribo = CertificadoArribo::find($id);

            if ($certificadoArribo->pdf == null){
                 return redirect()->back()->withInput()->withErrors(['errors' => 'No tiene asociado ningun pdf']);
            }


            try{

                $myfile = fopen($certificadoArribo->pdf, "r");

                $fileSize = filesize($certificadoArribo->pdf);
                header("HTTP/1.1 200 OK");
                header("Pragma: public");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

                header("Cache-Control: private", false);

                header("Content-type: application/pdf");
                header("Content-Disposition: attachment; filename=\"".$certificadoArribo->pdf."\""); 

                header("Content-Transfer-Encoding: binary");
                header("Content-Length: " . $fileSize);

                echo fread($myfile, $fileSize);

            } 
            catch(\Exception $e){
               // catch code
                 return redirect()->back()->withInput()->withErrors(['errors' => 'El archivo está mal direccionado']);
            }    
    }
    public function Clientepdf($id)
    {
        //
             $certificadoArribo = CertificadoArribo::find($id);

            if ($certificadoArribo->pdf == null){
                
                 return redirect()->back()->withInput()->withErrors(['errors' => 'No tiene asociado ningun pdf']);

            }else{
                try{

                    $myfile = fopen($certificadoArribo->pdf, "r");

                    $fileSize = filesize($certificadoArribo->pdf);
                    header("HTTP/1.1 200 OK");
                    header("Pragma: public");
                    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

                    header("Cache-Control: private", false);

                    header("Content-type: application/pdf");
                    header("Content-Disposition: attachment; filename=\"".$certificadoArribo->pdf."\""); 

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
}
