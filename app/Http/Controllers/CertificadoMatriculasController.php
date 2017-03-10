<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CertificadoMatricula\StoreCertificadoMatriculaRequest;
use App\Http\Requests\CertificadoMatricula\UpdateCertificadoMatriculaRequest;
use App\Models\CertificadoMatricula;
use App\User;
use Carbon\Carbon;
use Auth;
use App\Services\FileService;
//use App\Usuario;
use Session;


class CertificadoMatriculasController extends Controller
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
        $certificadoMatriculas = CertificadoMatricula::paginate(10);
        $certificadoMatriculas->setPath('certificadoMatricula');
        if (Auth::user()->role_id == 4){
            return view('internal.admin.certificadoMatriculas', compact('certificadoMatriculas'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.certificadoMatriculas', compact('certificadoMatriculas'));
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.certificadoMatriculas', compact('certificadoMatriculas'));
        }
        elseif  (Auth::user()->role_id == 7){
            return view('internal.usuarioValidacion.certificadoMatriculas', compact('certificadoMatriculas'));
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
            return view('internal.admin.nuevoCertificadoMatricula');
        }
        elseif (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.nuevoCertificadoMatricula');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCertificadoMatriculaRequest $request)
    {
        //
        $input = $request->all();

        $certificadoMatricula                        =   new CertificadoMatricula;
        $certificadoMatricula->codigo               =   $input['codigo'];
        $certificadoMatricula->libro                =   $input['libro'];
        $certificadoMatricula->folio                 =   $input['folio'];
        $certificadoMatricula->nombredueno           =   $input['nombreDueno'];
        $certificadoMatricula->apellidosDueno        =   $input['apellidosDueno'];
        $certificadoMatricula->dniDueno              =   $input['dniDueno'];
        $certificadoMatricula->nombreEmbarcacion     =   $input['nombreEmbarcacion'];
        $certificadoMatricula->nMatricula            =   $input['nMatricula'];
        $certificadoMatricula->asignado              =   false;
        $certificadoMatricula->activo                =   true;
        //Control de subida de imagen por hacer
        if($request->file('pdf')!=null)
            $certificadoMatricula->pdf        =   $this->file_service->uploadpdf($request->file('pdf'),'certificadoMatricula');

        $certificadoMatricula->save();
        
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.certificadoMatriculas');
        }
        elseif (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.certificadoMatriculas');
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
        $certificadoMatricula = CertificadoMatricula::find($id);
        if ($certificadoMatricula==null){
            return response()->view('errors.503', [], 404);
        }
        if (Auth::user()->role_id == 4){
            return view('internal.admin.editarCertificadoMatricula', compact('certificadoMatricula'));
        }
        elseif (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.editarCertificadoMatricula', compact('certificadoMatricula'));
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCertificadoMatriculaRequest $request, $id)
    {
        //
        $input = $request->all();

        $certificadoMatricula = CertificadoMatricula::find($id);
        $certificadoMatricula->codigo               =   $input['codigo'];
        $certificadoMatricula->libro                =   $input['libro'];
        $certificadoMatricula->folio                 =   $input['folio'];
        $certificadoMatricula->nombredueno           =   $input['nombreDueno'];
        $certificadoMatricula->apellidosDueno        =   $input['apellidosDueno'];
        $certificadoMatricula->dniDueno              =   $input['dniDueno'];
        $certificadoMatricula->nombreEmbarcacion     =   $input['nombreEmbarcacion'];
        $certificadoMatricula->nMatricula            =   $input['nMatricula'];
        //Control de subida de imagen por hacer
        if($request->file('pdf')!=null)
            $certificadoMatricula->pdf        =   $this->file_service->uploadpdf($request->file('pdf'),'certificadoMatricula');

        $certificadoMatricula->save();
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.certificadoMatriculas');
        }
        elseif (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.certificadoMatriculas');     
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
            $certificadoMatricula = CertificadoMatricula::find($id);
            $certificadoMatricula->delete();
            if (Auth::user()->role_id == 4){
                return redirect()->route('admin.certificadoMatriculas');
            }
            elseif (Auth::user()->role_id == 5){
                return redirect()->route('usuarioPesca.certificadoMatriculas');
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
            $certificadoMatricula = CertificadoMatricula::find($id);
            if ($certificadoMatricula->pdf == null){
                 return redirect()->back()->withInput()->withErrors(['errors' => 'No tiene asociado ningun pdf']);
            }


            try{

                $myfile = fopen($certificadoMatricula->pdf, "r");

                $fileSize = filesize($certificadoMatricula->pdf);
                header("HTTP/1.1 200 OK");
                header("Pragma: public");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

                header("Cache-Control: private", false);

                header("Content-type: application/pdf");
                header("Content-Disposition: attachment; filename=\"".$certificadoMatricula->pdf."\""); 

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
