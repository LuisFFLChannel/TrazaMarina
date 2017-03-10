<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermisoPesca\StorePermisoPescaRequest;
use App\Http\Requests\PermisoPesca\UpdatePermisoPescaRequest;
use App\Models\PermisoPesca;
use App\User;
use Carbon\Carbon;
use Auth;
use App\Services\FileService;
//use App\Usuario;
use Session;

class PermisoPescaController extends Controller
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
        $permisoPescas = PermisoPesca::paginate(10);
        $permisoPescas->setPath('permisoPescas');
        if (Auth::user()->role_id == 4){
            return view('internal.admin.permisoPescas', compact('permisoPescas'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.permisoPescas', compact('permisoPescas'));
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.permisoPescas', compact('permisoPescas'));
        }
        elseif  (Auth::user()->role_id == 7){
            return view('internal.usuarioValidacion.permisoPescas', compact('permisoPescas'));
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
            return view('internal.admin.nuevoPermisoPesca');
        }
        elseif (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.nuevoPermisoPesca');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermisoPescaRequest $request)
    {
        //
        $input = $request->all();

        $permisoPesca                        =   new PermisoPesca;
        $permisoPesca->codigo                =   $input['codigo'];
        $permisoPesca->nombreEmbarcacion     =   $input['nombreEmbarcacion'];
        $permisoPesca->nMatricula            =   $input['nMatricula'];
        $permisoPesca->fechaVigencia         =   new Carbon($input['fechaVigencia']);
        $permisoPesca->asignado              =   false;
        $permisoPesca->activo                =   true;
        //Control de subida de imagen por hacer
        if($request->file('pdf')!=null)
            $permisoPesca->pdf        =   $this->file_service->uploadpdf($request->file('pdf'),'permisoPesca');


        $permisoPesca->save();
        
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.permisoPescas');
        }
        elseif (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.permisoPescas');
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
        $permisoPesca = PermisoPesca::find($id);
        if ($permisoPesca ==null){
            return response()->view('errors.503', [], 404);
        }
        if (Auth::user()->role_id == 4){
            return view('internal.admin.editarPermisoPesca', compact('permisoPesca'));
        }
        elseif (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.editarPermisoPesca', compact('permisoPesca'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermisoPescaRequest $request, $id)
    {
        //
        $input = $request->all();

        $permisoPesca = PermisoPesca::find($id);

        $permisoPesca->codigo                =   $input['codigo'];
        $permisoPesca->nombreEmbarcacion     =   $input['nombreEmbarcacion'];
        $permisoPesca->nMatricula            =   $input['nMatricula'];
        $permisoPesca->fechaVigencia         =   new Carbon($input['fechaVigencia']);
        //Control de subida de imagen por hacer
        if($request->file('pdf')!=null)
            $permisoPesca->pdf        =   $this->file_service->uploadpdf($request->file('pdf'),'permisoPesca');


        $permisoPesca->save();
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.permisoPescas');
        }
        elseif (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.permisoPescas');     
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
            $permisoPesca = PermisoPesca::find($id);
            $permisoPesca->delete();
            if (Auth::user()->role_id == 4){
                return redirect()->route('admin.permisoPescas');
            }
            elseif (Auth::user()->role_id == 5){
                return redirect()->route('usuarioPesca.permisoPescas');
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
            $certificado = PermisoPesca::find($id);
            if ($certificado->pdf == null){
                 return redirect()->back()->withInput()->withErrors(['errors' => 'No tiene asociado ningun pdf']);
            }


            try{

                $myfile = fopen($certificado->pdf, "r");

                $fileSize = filesize($certificado->pdf);
                header("HTTP/1.1 200 OK");
                header("Pragma: public");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

                header("Cache-Control: private", false);

                header("Content-type: application/pdf");
                header("Content-Disposition: attachment; filename=\"".$certificado->pdf."\""); 

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
