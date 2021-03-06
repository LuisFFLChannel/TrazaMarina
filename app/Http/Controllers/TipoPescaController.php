<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\TipoPesca\StoreTipoPescaRequest;
use App\Http\Requests\TipoPesca\UpdateTipoPescaRequest;
use App\Models\TipoPesca;
use App\Services\FileService;
use App\User;
use Carbon\Carbon;
//use App\Usuario;
use Session;
use Auth;
class TipoPescaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tipoPescas = TipoPesca::paginate(10);
        $tipoPescas->setPath('tipoPescas');

        if (Auth::user()->role_id == 4){
            return view('internal.admin.tipoPescas', compact('tipoPescas'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.tipoPescas', compact('tipoPescas'));
        }
        elseif  (Auth::user()->role_id == 6){
            return view('internal.usuarioIntermediario.tipoPescas', compact('tipoPescas'));
        }
        elseif  (Auth::user()->role_id == 7){
            return view('internal.usuarioValidacion.tipoPescas', compact('tipoPescas'));
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
            return view('internal.admin.nuevoTipoPesca');
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.nuevoTipoPesca');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTipoPescaRequest $request)
    {
        //
        $input = $request->all();

        $tipoPesca                    =   new TipoPesca;
        $tipoPesca->nombre            =   $input['nombre'];
        $tipoPesca->descripcion       =   $input['descripcion'];
        $tipoPesca->activo            =   true;

        //Control de subida de imagen por hacer

        $tipoPesca->save();

        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.tipoPescas');
        }
        elseif  (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.tipoPescas');
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
        $tipoPesca = TipoPesca::find($id);
        if ($tipoPesca ==null){
            return response()->view('errors.503', [], 404);
        }
        if (Auth::user()->role_id == 4){
            return view('internal.admin.editarTipoPesca', compact('tipoPesca'));
        }
        elseif  (Auth::user()->role_id == 5){
            return view('internal.usuarioPesca.editarTipoPesca', compact('tipoPesca'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTipoPescaRequest $request, $id)
    {
        //
        $input = $request->all();

        $tipoPesca = TipoPesca::find($id);

        $tipoPesca->nombre            =   $input['nombre'];
        $tipoPesca->descripcion       =   $input['descripcion'];
        $tipoPesca->activo            =   true;


        $tipoPesca->save();
        
        if (Auth::user()->role_id == 4){
            return redirect()->route('admin.tipoPescas');
        }
        elseif  (Auth::user()->role_id == 5){
            return redirect()->route('usuarioPesca.tipoPescas');
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
            $tipoPesca = TipoPesca::find($id);
            $tipoPesca->delete();
            if (Auth::user()->role_id == 4){
                return redirect()->route('admin.tipoPescas');
            }
            elseif  (Auth::user()->role_id == 5){
                return redirect()->route('usuarioPesca.tipoPescas');
            }
            } 
        catch(\Exception $e){
           // catch code
             return redirect()->back()->withInput()->withErrors(['errors' => 'NO SE PUEDE ELIMINAR DEBIDO A QUE ESTA SIENDO USADA EN TRANSACCIONES']);
        }
    }
}
