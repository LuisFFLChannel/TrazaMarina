<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frigorifico\StoreFrigorificoRequest;
use App\Http\Requests\Frigorifico\UpdateFrigorificoRequest;
use App\Models\Frigorifico;
use App\Services\FileService;
use App\User;
use Carbon\Carbon;
//use App\Usuario;
use Session;

class FrigorificoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $frigorificos = Frigorifico::paginate(10);
        $frigorificos->setPath('frigorificos');
        return view('internal.admin.frigorificos', compact('frigorificos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('internal.admin.nuevoFrigorifico');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFrigorificoRequest $request)
    {
        //
        $input = $request->all();

        $frigorifico                    =   new Frigorifico;
        $frigorifico->nombres           =   $input['nombre'];
        $frigorifico->placa             =   $input['placa'];
        $frigorifico->capacidad         =   $input['capacidad'];
        $frigorifico->activo            =   true;

        $frigorifico->save();
        
        return redirect()->route('admin.frigorificos');
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
        $frigorifico = Frigorifico::find($id);
        return view('internal.admin.editarFrigorifico', compact('frigorifico'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFrigorificoRequest $request, $id)
    {
        //
        $input = $request->all();

        $frigorifico = Frigorifico::find($id);

        $frigorifico->nombres           =   $input['nombre'];
        $frigorifico->placa             =   $input['placa'];
        $frigorifico->capacidad         =   $input['capacidad'];

        $frigorifico->save();
        return redirect()->route('admin.frigorificos');
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
        $frigorifico = Frigorifico::find($id);
        $frigorifico->delete();
        return redirect()->route('admin.frigorificos');
    }
}
