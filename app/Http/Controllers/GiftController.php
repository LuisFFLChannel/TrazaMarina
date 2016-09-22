<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Gift\StoreGiftRequest;
use App\Http\Requests\Gift\UpdateGiftRequest;
use App\Http\Requests\Gift\exchangeGift;
use App\Models\Gift;
use App\Services\FileService;
use App\User;
use App\Http\Requests\Booking\StoreBookingRequest;
use Session;
use App\Models\Business;
use App\Models\Module;
class GiftController extends Controller
{   

    public function __construct(){
        $this->file_service = new FileService();
    }
    /**
     * Display a listing of the resource (internal).
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gifts = Gift::paginate(10);
        $gifts->setPath('gifts');
        return view('internal.admin.gifts', compact('gifts'));
    }

    /**
     * Display a listing of the resource (external).
     *
     * @return \Illuminate\Http\Response
     */
    public function indexExternal()
    {
        $gifts = Gift::all();
        return view('external.gifts', compact('gifts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('internal.admin.newGift');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createExchangeAdmin()
    {
       $giftsArr = Gift::all();
       $giftsList = Gift::orderBy('id')->get()->lists('name','id') ;
       $min = Gift::orderBy('id')->get()->lists('id')->first();
      

       return view('internal.admin.exchangeGift', ['giftsList' => $giftsList , 'giftArray' => $giftsArr , 'min'=>   $min  ]  );
   }

   public function createExchangeAdminPost(exchangeGift $request)
   {
       $input = $request->all();
       $idGift =  $input['gifts'];
       $idClient  =  $input['nombre_de_usuario'];
       $quantGift = $input['cantidad_de_regalos'];
       $gift = Gift::find($idGift);
       $user = User::find($idClient);

       if( ( $gift->points*$quantGift ) >  $user->points )

        return back()->withErrors(['El usuario no posee puntos suficientes.']);
    elseif(    $gift->stock   ==  0  )

        return back()->withErrors(['El juguete seleccionado se encuentra agotado.']);
    elseif(    $gift->stock   < $quantGift  )

        return back()->withErrors(['No se cuenta con suficiente stock']);
    

    $gift->stock        =    $gift->stock - $quantGift ; 
    $gift->save();

    $user->points =   $user->points  -($gift->points *$quantGift  )     ;  
    $user->save();

    $giftsArr = Gift::all();
    $giftsList = Gift::orderBy('id')->get()->lists('name','id') ;
    $min = Gift::orderBy('id')->get()->lists('id')->first();
    Session::flash('messageSucc', ' Canjeo exitoso ');
    return view('internal.admin.exchangeGift', ['giftsList' => $giftsList , 'giftArray' => $giftsArr , 'min'=>   $min ]  );

}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createExchange()
    {
        $business = Business::all()->first();
        $active = $business->exchange_active;
        $moduleId = $business->gift_module_id;

         $moduloFind = Module::where('id',  $moduleId ) ; 
         
    
     if( $moduleId !=NULL )
{
             $moduloFind = Module::find($moduleId);
             $modulo = $moduloFind->name ; 

}
else {

 $modulo = 'No se ha asignado el modulo principal de canjeo de regalos';
}
        $giftsArr = Gift::all();
        $giftsList = Gift::orderBy('id')->get()->lists('name','id') ;
        $min = Gift::orderBy('id')->get()->lists('id')->first();

        return view('internal.salesman.exchangeGift', ['giftsList' => $giftsList , 'giftArray' => $giftsArr , 'min'=>   $min ,'active' =>  $active, 'modulo'=>   $modulo]  );
    }

    public function createExchangePost(exchangeGift $request)
    {
        $business = Business::all()->first();
        $active = $business->exchange_active;
 $modulo = 'La marina y el marino';

        if( $active== 0   ) {

            $giftsArr = Gift::all();
            $giftsList = Gift::orderBy('id')->get()->lists('name','id') ;
            $min = Gift::orderBy('id')->get()->lists('id')->first();

            return view('internal.salesman.exchangeGift', ['giftsList' => $giftsList , 'giftArray' => $giftsArr , 'min'=>   $min ,'active' =>  $active]  );

        } 
        
        $input = $request->all();
        $idGift =  $input['gifts'];
        $idClient  =  $input['nombre_de_usuario'];
        $quantGift = $input['cantidad_de_regalos'];

        $gift = Gift::find($idGift);
        $user = User::find($idClient);

        if(  ( $gift->points*$quantGift ) >  $user->points )

            return back()->withErrors(['El usuario no posee puntos suficientes.']);
        elseif(    $gift->stock   ==  0  )

            return back()->withErrors(['El juguete seleccionado se encuentra agotado.']);
        elseif(    $gift->stock   < $quantGift  )

            return back()->withErrors(['No se cuenta con suficiente stock']);

        $gift->stock        =    $gift->stock -$quantGift; 
        $gift->save();

        $user->points =    $user->points    -  ($gift->points *$quantGift  )   ;  
        $user->save();

        $giftsArr = Gift::all();
        $giftsList = Gift::orderBy('id')->get()->lists('name','id') ;
        $min = Gift::orderBy('id')->get()->lists('id')->first();
        Session::flash('messageSucc', ' Canjeo exitoso ');
        return view('internal.salesman.exchangeGift', ['giftsList' => $giftsList , 'giftArray' => $giftsArr , 'min'=>   $min,'active' =>  $active , 'modulo'=>   $modulo]  );

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGiftRequest $request)
    {
        $input = $request->all();

        $gift               =   new Gift;
        $gift->name         =   $input['name'];
        $gift->description  =   $input['description'];
        $gift->points       =   $input['points'];
        $gift->stock        =   $input['stock'];
        if($gift->stock > 0)    
            $gift->status   =   config('constants.gift_available');
        elseif($gift->stock == 0)
            $gift->status   =   config('constants.gift_soldOut');   
        //Control de subida de imagen por hacer
        $gift->image        =   $this->file_service->upload($request->file('image'),'gift');

        $gift->save();
        
        return redirect()->route('admin.gifts');
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
        $gift = Gift::find($id);

        return view('internal.admin.editGift', compact('gift'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGiftRequest $request, $id)
    {
        $input = $request->all();

        $gift = Gift::find($id);

        $gift->name         =   $input['name'];
        $gift->description  =   $input['description'];
        $gift->points       =   $input['points'];
        $gift->stock        =   $input['stock'];
        if($gift->stock > 0)    
            $gift->status   =   config('constants.gift_available');
        elseif($gift->stock == 0)
            $gift->status   =   config('constants.gift_soldOut');
        //Control de subida de imagen
        if($request->file('image')!=null)
            $gift->image        =   $this->file_service->upload($request->file('image'),'gift');

        $gift->save();        

        return redirect()->route('admin.gifts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gift = Gift::find($id);
        $gift->delete();
        return redirect()->route('admin.gifts');
    }
}
