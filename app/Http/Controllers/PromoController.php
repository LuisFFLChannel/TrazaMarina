<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Promotions;
use App\Models\Event;
use App\Models\accessPromotion;
use App\Models\Zone;
use App\User;
use Carbon\Carbon;
use App\Models\Category;
use Config;
use App\Http\Requests\Promotions\StorePromotionRequest;
use App\Http\Requests\Promotions\UpdatePromotionRequest;
use App\Http\Requests\Client\PasswordClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use Auth;
use Session;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('internal.promoter.promotions');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */





    public function store(StorePromotionRequest $request)
    {

        $input = $request->all();
        $promotions               =   new Promotions ;

        $promotions->name         =   $input['promotionName'];
        $promotions->description  =   $input['description'];
        $promotions->startday  =   $input['fechaInicio'];

        $aux = $input['fechaInicio']. ' '. $input['timeIni'];
        $promotions->startday  =    $aux;

        $aux =   $input['fechaFin']     .' '. $input['timeEnd'];
        $promotions->endday =   $aux  ; 
        
        $promotions->event_id  = $input['evento'] ;

        $id = Auth::user()->id;
        $promotions->user_id  =   $id;

        if(  ( $input['carry'] == ''  )  and  ( $input['pay'] == ''   ) )    {

            $promotions->typePromotion    =      Config::get('constants.discount')    ;
            $promotions->desc  =   $input['discount'];
            $promotions->access_id =  $input['access_id'];


        } else {
            $promotions->typePromotion    =   Config::get('constants.ofert')     ;
            $promotions->carry =    $input['carry'];
            $promotions->pay =    $input['pay'];
            $promotions->zone_id =  $input['zone'];

        }


        $promotions->save();

        return redirect('promoter/promotion');

      // return $promotions ;


    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function create()
    {

        $events = Event::where('promoter_id',Auth::user()->id)->get();
        $accessPromotion = accessPromotion::orderBy('id')->get()->lists('description','id') ;

        return view('internal.promoter.newPromotion',  ['events' => $events , 'accessPromotion'=> $accessPromotion   ]    );  
 
   }



    public function promotion()
    {

      $promotions = Promotions::where('user_id',Auth::user()->id)->get();
      
      return view('internal.promoter.promotions',   ['promotions' => $promotions ]    );
  }


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

      $promotion = Promotions::find($id);

      $event  = Event::find($promotion->event_id);

      $user = User::find($promotion->user_id ); 

      $accessPromotion = accessPromotion::orderBy('id')->get()->lists('description','id') ;


      $zones = Zone::where('event_id', $promotion->event_id  )->get()->lists('name','id') ;

        //trabajamos las fechas para mostrarlas.

      $startDay =   substr($promotion->startday, 0, 10);
      $startHour =  substr($promotion->startday, 11); 


      $endDay =   substr($promotion->endday, 0, 10);
      $finishHour =  substr($promotion->endday, 11); 

      return view('internal.promoter.editPromotion' , compact( 'startDay' , 'startHour' , 'endDay' ,'finishHour' ,'promotion' , 'user' ,  'accessPromotion',  'zones', 'event' )    );
  }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePromotionRequest $request, $id)
    {


       $input = $request->all();

       $promotions = Promotions::find($id);

       $promotions->name  =   $input['promotionName'];


       $promotions->description  =   $input['description'];
       $promotions->startday  =   $input['dateIni'];

       $aux = $input['dateIni']. ' '. $input['timeIni'];
       $promotions->startday  =    $aux;

       $aux =   $input['dateEnd']     .' '. $input['timeEnd'];
       $promotions->endday =   $aux  ; 

    
       if(  $promotions->typePromotion   ==   Config::get('constants.discount')  )    {


        $promotions->desc  =   $input['discount'];
        $promotions->access_id =  $input['access_id'];


    } else {

        $promotions->carry =    $input['carry'];
        $promotions->pay =    $input['pay'];
        $promotions->zone_id =  $input['zone'];

    }
    $promotions->save();

    return redirect('promoter/promotion');

}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $promotion = Promotions::find($id);
     if( $promotion !=NULL )
        {    $promotion->delete();  } 

    return redirect('promoter/promotion');
}

public function ajax($event_id)
{
    
    $zones = Zone::where('event_id' ,$event_id )->lists('name','id') ;;



    return  json_encode(  $zones);  
}


public function passwordPromoter()
{
  return view('internal.admin.passwordPromoter');
}


public function passwordUpdatePromoter(PasswordClientRequest $request)
{

        $id = Auth::user()->id;
        $obj = User::findOrFail($id);
        $auth = Auth::attempt( array(
            'email' => $obj->email,
            'password' => $request->input('password')
            ));
        if ($auth)
        {
            $newPassword = bcrypt($request->input('new_password'));
            $obj->password = $newPassword;
            $obj->save();
            //ERROR DE MENSAJES EN INGLES, DEBEN SER EN ESPAÑOL CUANDO SON CUSTOM
            Session::flash('message', 'Su contraseña fue actualizada!');
            Session::flash('alert-class','alert-success');
        } else {
            Session::flash('message', 'Contraseña Incorrecta!');
            Session::flash('alert-class','alert-danger');
        }
        return redirect('promoter');
    }

}
