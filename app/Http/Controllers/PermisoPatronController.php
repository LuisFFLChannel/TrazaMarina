<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermisoPatron\StorePermisoPatronRequest;
use App\Http\Requests\PermisoPatron\UpdatePermisoPatronRequest;
use App\Models\PermisoPatron;
use App\User;
use Carbon\Carbon;
use Auth;
use App\Services\FileService;
//use App\Usuario;
use Session;

class PermisoPatronController extends Controller
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
        $permisoPatrones = PermisoPatron::paginate(10);
        $permisoPatrones->setPath('permisoPatron');
        if (Auth::user()->role_id == 4){
            return view('internal.admin.permisoPatrones', compact('permisoPatrones'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.permisoPatrones', compact('permisoPatrones'));
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.permisoPatrones', compact('permisoPatrones'));
        }
        elseif  (Auth::user()->role_id == 7){
            return view('internal.usuarioValidacion.permisoPatrones', compact('permisoPatrones'));
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
            return view('internal.admin.nuevoPermisoPatron');
        }
        elseif (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.nuevoPermisoPatron');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermisoPatronRequest $request)
    {
        //
        $input = $request->all();

        $permisoPatron                        =   new PermisoPatron;
        $permisoPatron->codigo                =   $input['codigo'];
        $permisoPatron->nombres               =   $input['nombres'];
        $permisoPatron->apellidos             =   $input['apellidos'];
        $permisoPatron->dni                   =   $input['dni'];
        $permisoPatron->numeroPatron          =   $input['numeroPatron'];
        $permisoPatron->fechaVigencia         =   new Carbon($input['fechaVigencia']);
        $permisoPatron->asignado              =   false;
        $permisoPatron->activo                =   true;
        //Control de subida de imagen por hacer
        if($request->file('pdf')!=null)
            $permisoPatron->pdf        =   $this->file_service->uploadpdf($request->file('pdf'),'permisoPatron');

        $permisoPatron->save();
        
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.permisoPatrones');
        }
        elseif (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.permisoPatrones');
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
        $permisoPatron = PermisoPatron::find($id);
        if ($permisoPatron ==null){
            return response()->view('errors.503', [], 404);
        }
        if (Auth::user()->role_id == 4){
            return view('internal.admin.editarPermisoPatron', compact('permisoPatron'));
        }
        elseif (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.editarPermisoPatron', compact('permisoPatron'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermisoPatronRequest $request, $id)
    {
        //
        $input = $request->all();

        $permisoPatron = PermisoPatron::find($id);
        $permisoPatron->codigo                =   $input['codigo'];
        $permisoPatron->nombres               =   $input['nombres'];
        $permisoPatron->apellidos             =   $input['apellidos'];
        $permisoPatron->dni                   =   $input['dni'];
        $permisoPatron->numeroPatron          =   $input['numeroPatron'];
        $permisoPatron->fechaVigencia         =   new Carbon($input['fechaVigencia']);
        //Control de subida de imagen por hacer
        if($request->file('pdf')!=null)
            $permisoPatron->pdf        =   $this->file_service->uploadpdf($request->file('pdf'),'permisoPatron');

        $permisoPatron->save();
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.permisoPatrones');
        }
        elseif (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.permisoPatrones');     
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
            $permisoPatron = PermisoPatron::find($id);
            $permisoPatron->delete();
            if (Auth::user()->role_id == 4){
                return redirect()->route('admin.permisoPatrones');
            }
            elseif (Auth::user()->role_id == 5){
                return redirect()->route('usuarioPesca.permisoPatrones');
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
            $certificado = PermisoPatron::find($id);
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
