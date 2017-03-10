<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermisoMarinero\StorePermisoMarineroRequest;
use App\Http\Requests\PermisoMarinero\UpdatePermisoMarineroRequest;
use App\Models\PermisoMarinero;
use App\User;
use Carbon\Carbon;
use Auth;
use App\Services\FileService;
//use App\Usuario;
use Session;

class PermisoMarineroController extends Controller
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
        $permisoMarineros = PermisoMarinero::paginate(10);
        $permisoMarineros->setPath('permisoMarinero');
        if (Auth::user()->role_id == 4){
            return view('internal.admin.permisoMarineros', compact('permisoMarineros'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.permisoMarineros', compact('permisoMarineros'));
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.permisoMarineros', compact('permisoMarineros'));
        }
        elseif  (Auth::user()->role_id == 7){
            return view('internal.usuarioValidacion.permisoMarineros', compact('permisoMarineros'));
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
            return view('internal.admin.nuevoPermisoMarinero');
        }
        elseif (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.nuevoPermisoMarinero');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermisoMarineroRequest $request)
    {
        //
        $input = $request->all();

        $permisoMarinero                        =   new PermisoMarinero;
        $permisoMarinero->codigo                =   $input['codigo'];
        $permisoMarinero->nombres               =   $input['nombres'];
        $permisoMarinero->apellidos             =   $input['apellidos'];
        $permisoMarinero->dni                   =   $input['dni'];
        $permisoMarinero->numeroMarinero        =   $input['numeroMarinero'];
        $permisoMarinero->fechaVigencia         =   new Carbon($input['fechaVigencia']);
        $permisoMarinero->asignado                =   false;
        $permisoMarinero->activo                =   true;
        if($request->file('pdf')!=null)
            $permisoMarinero->pdf        =   $this->file_service->uploadpdf($request->file('pdf'),'permisoMarinero');

        //Control de subida de imagen por hacer

        $permisoMarinero->save();
        
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.permisoMarineros');
        }
        elseif (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.permisoMarineros');
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
        $permisoMarinero = PermisoMarinero::find($id);
        if ($permisoMarinero ==null){
            return response()->view('errors.503', [], 404);
        }
        if (Auth::user()->role_id == 4){
            return view('internal.admin.editarPermisoMarinero', compact('permisoMarinero'));
        }
        elseif (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.editarPermisoMarinero', compact('permisoMarinero'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermisoMarineroRequest $request, $id)
    {
        //
        $input = $request->all();

        $permisoMarinero = PermisoMarinero::find($id);
        $permisoMarinero->codigo                =   $input['codigo'];
        $permisoMarinero->nombres               =   $input['nombres'];
        $permisoMarinero->apellidos             =   $input['apellidos'];
        $permisoMarinero->dni                   =   $input['dni'];
        $permisoMarinero->numeroMarinero        =   $input['numeroMarinero'];
        $permisoMarinero->fechaVigencia         =   new Carbon($input['fechaVigencia']);
        //Control de subida de imagen por hacer
        if($request->file('pdf')!=null)
            $permisoMarinero->pdf        =   $this->file_service->uploadpdf($request->file('pdf'),'permisoMarinero');


        $permisoMarinero->save();
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.permisoMarineros');
        }
        elseif (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.permisoMarineros');     
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
            $permisoMarinero = PermisoMarinero::find($id);
            $permisoMarinero->delete();
            if (Auth::user()->role_id == 4){
                return redirect()->route('admin.permisoMarineros');
            }
            elseif (Auth::user()->role_id == 5){
                return redirect()->route('usuarioPesca.permisoMarineros');
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
            $certificado = PermisoMarinero::find($id);
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
