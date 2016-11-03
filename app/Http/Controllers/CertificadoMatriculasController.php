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
//use App\Usuario;
use Session;

class CertificadoMatriculasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $certificadoMatriculas = CertificadoMatricula::paginate(10);
        $certificadoMatriculas->setPath('certificadoMatricula');
        return view('internal.admin.certificadoMatriculas', compact('certificadoMatriculas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('internal.admin.nuevoCertificadoMatricula');
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

        $embarcacion                        =   new CertificadoMatricula;
        $embarcacion->nombredueno           =   $input['nombreDueno'];
        $embarcacion->apellidosDueno        =   $input['apellidosDueno'];
        $embarcacion->dniDueno              =   $input['dnisDueno'];
        $embarcacion->nMatricula            =   $input['nMatricula'];
        $embarcacion->activo                =   true;
        //Control de subida de imagen por hacer

        $embarcacion->save();
        
        return redirect()->route('admin.certificadoMatriculas');
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
        $embarcacion = CertificadoMatricula::find($id);
        return view('internal.admin.editarCertificadoMatricula', compact('embarcacion'));
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

        $embarcacion = CertificadoMatricula::find($id);

        $embarcacion->nombredueno           =   $input['nombreDueno'];
        $embarcacion->apellidosDueno        =   $input['apellidosDueno'];
        $embarcacion->dniDueno              =   $input['dnisDueno'];
        $embarcacion->nMatricula            =   $input['nMatricula'];
        //Control de subida de imagen por hacer

        $embarcacion->save();
        return redirect()->route('admin.certificadoMatriculas');
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
        $embarcacion = CertificadoMatricula::find($id);
        $embarcacion->delete();
        return redirect()->route('admin.certificadoMatriculas');
    }
}
