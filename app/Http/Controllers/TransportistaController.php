<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Transportista\StoreTransportistaRequest;
use App\Http\Requests\Transportista\UpdateTransportistaRequest;
use App\Models\Transportista;
use App\Services\FileService;
use App\User;
use Carbon\Carbon;
//use App\Usuario;
use Session;

class TransportistaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $transportistas = Transportista::paginate(10);
        $transportistas->setPath('transportistas');
        return view('internal.admin.transportistas', compact('transportistas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         return view('internal.admin.nuevoTransportista');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransportistaRequest $request)
    {
        //
        $input = $request->all();

        $transportista                    =   new Transportista;
        $transportista->nombres           =   $input['nombres'];
        $transportista->apellidos         =   $input['apellidos'];
        $transportista->dni               =   $input['dni'];
        $transportista->telefono          =   $input['telefono'];
        $transportista->correo            =   $input['correo'];
        $transportista->brevete        =   $input['brevete'];
        $transportista->activo            =   true;

        $transportista->save();
        
        return redirect()->route('admin.transportistas');
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
        $transportista = Transportista::find($id);
        return view('internal.admin.editarTransportista', compact('transportista'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransportistaRequest $request, $id)
    {
        //
        $input = $request->all();

        $transportista = Transportista::find($id);

        $transportista->nombres           =   $input['nombres'];
        $transportista->apellidos         =   $input['apellidos'];
        $transportista->dni               =   $input['dni'];
        $transportista->telefono          =   $input['telefono'];
        $transportista->correo            =   $input['correo'];
        $transportista->brevete           =   $input['brevete'];



        $transportista->save();
        return redirect()->route('admin.transportistas');
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
        $transportista = Transportista::find($id);
        $transportista->delete();
        return redirect()->route('admin.transportistas');
    }
}
