<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Requests\Ticket\StoreTicketRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexReturn()
    {
        return view('internal.admin.ticketReturn');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createReturn()
    {
        return view('internal.admin.newTicketReturn');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createClient($id)
    {
        return view('internal.client.buy');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createSalesman($id)
    {
        //Buscar y enviar info de evento con $id
        $event = array(
            'id' => $id
        );
        return view('internal.salesman.buy',compact('event'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketRequest $request)
    {
        //dd($request->all());
        //$event = Event::find($request['event_id']);
        //Deberia jalar los ids de los asientos del evento pero estoy usando un json por mientras
        $seats = json_decode($request['seats']);
        return back()->withInput($request->except('seats'))->withErrors(['El asiento 1 no esta libre']);
        /*
        foreach($seats as $seat_id){
            if($seat->status != config('constants.seat_free')){
                return back()->withInput()->withErrors(['El asiento '. $seat_id.' no esta libre']);
            }
        }
        */
       
        //DB::beginTransaction();

        try{
            foreach($seats as $seat_id){

                //$seat = Seat::find($seat_id);
                //
                //Cambiar estado de asiento
                //DB::table('seats')->where('id', $seat_id)->update(['status' => config('constants.seat_occupied')]);
                //  
                //Crear ticket
                //DB::table('tickets')->insertGetId(
                //['paymentDate'  => new Carbon(),
                // 'reserve'      => 0,
                // 'cancelled'    => 0,
                // 'owner_id'     => $request['user_id'],
                // 'event_id'     => $request['event_id'],
                // 'seat_id'      => $seat_id
                // ]
                //);
                //
                //Aumentar puntos de cliente
            }
            //Disminuir disponibles
            //DB::table('events')->where('id', $request['event_id'])->update(['available' => $event->available - sizeof($seats)]);
            //
            //DB::commit();
        }catch (\Exception $e){
            DB::rollback();
        }
        die();
        
        return redirect()->route('ticket.success.salesman');
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
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showSuccess()
    {
        return view('internal.client.successBuy');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showSuccessSalesman()
    {
        return view('internal.salesman.successBuy');
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    }

    public function giveaway()
    {
        return view('internal.salesman.giveaway');
    }

    public function getClient(request $request)
    {
        $user = User::where('di', $request['id'])->first();
        return $user;
    }
}
