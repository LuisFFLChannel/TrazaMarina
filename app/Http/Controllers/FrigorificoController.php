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
use Auth;

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

        if (Auth::user()->role_id == 4){
            return view('internal.admin.frigorificos', compact('frigorificos'));
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.frigorificos', compact('frigorificos'));
        }
        elseif  (Auth::user()->role_id == 7){
            return view('internal.usuarioValidacion.frigorificos', compact('frigorificos'));
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
            return view('internal.admin.nuevoFrigorifico');
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.nuevoFrigorifico');
        }
 
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
        $frigorifico->nombre            =   $input['nombre'];
        $frigorifico->placa             =   $input['placa'];
        $frigorifico->capacidad         =   $input['capacidad'];
        $frigorifico->activo            =   true;

        $frigorifico->save();
        
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.frigorificos');
        }
        elseif  (Auth::user()->role_id == 6){
            return redirect()->route('usuarioIntermediario.frigorificos');
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
        $frigorifico = Frigorifico::find($id);
        if ($frigorifico ==null){
            return response()->view('errors.503', [], 404);
        }

        if (Auth::user()->role_id == 4){
            return view('internal.admin.editarFrigorifico', compact('frigorifico'));
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.editarFrigorifico', compact('frigorifico'));
        }
        
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

        $frigorifico->nombre           =   $input['nombre'];
        $frigorifico->placa             =   $input['placa'];
        $frigorifico->capacidad         =   $input['capacidad'];

        $frigorifico->save();
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.frigorificos');
        }
        elseif  (Auth::user()->role_id == 6){
            return redirect()->route('usuarioIntermediario.frigorificos');
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
            $frigorifico = Frigorifico::find($id);
            $frigorifico->delete();
            if (Auth::user()->role_id == 4){
                return redirect()->route('admin.frigorificos');
            }
            elseif  (Auth::user()->role_id == 6){
                return redirect()->route('usuarioIntermediario.frigorificos');
            }
        } 
        catch(\Exception $e){
           // catch code
             return redirect()->back()->withInput()->withErrors(['errors' => 'NO SE PUEDE ELIMINAR  DEBIDO A QUE ESTA SIENDO USADA EN TRANSACCIONES']);
        }
    }
}
