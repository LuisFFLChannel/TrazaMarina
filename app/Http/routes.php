<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// Authentication routes...




// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');


Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'ClientController@store');

Route::get('/', 'PagesController@home');
Route::get('about', 'PagesController@about');
Route::get('modules', 'ModuleController@indexExternal');
Route::get('calendar', 'PagesController@calendar');
Route::post('calendar', 'PagesController@eventsForDate');
//Route::post('calendar', 'PagesController@findcalendar');
Route::get('gifts', 'GiftController@indexExternal');
Route::get('category', 'CategoryController@indexExternal');
Route::get('category/{id}/subcategory', 'CategoryController@indexSub');
Route::get('category/{id}/subcategory/{id2}', 'CategoryController@showSub');
Route::get('event', 'EventController@indexExternal');
Route::get('event/successBuy', 'TicketController@showSuccess');
Route::get('event/{id}', ['as' => 'event.external.show' , 'uses' =>'EventController@showExternal']);
Route::post('event/{id}', 'EventController@showExternalPost');
Route::get('event/delete/{id}/comment', 'EventController@destroyComment');



Route::group(['middleware' => ['auth', 'client']], function () {
    Route::get('client/', ['uses'=>'ClientController@profile','as'=>'client.home']);
    Route::get('client/edit', 'ClientController@edit');
    Route::post('client/update', 'ClientController@update');
    Route::get('client/password', 'ClientController@password');
    Route::post('client/password', 'ClientController@passwordUpdate');
    Route::get('client/photo', 'ClientController@photoEdit');
    Route::post('client/photo', 'ClientController@photoUpdate');
    Route::get('client/home', 'PagesController@clientHome');
    Route::get('client/event_record', 'EventController@showClientRecord');
    Route::get('client/event_record/feedback', 'EventController@feedback');
    //Estos 2 inician en el detalle del evento
    Route::get('client/event/{id}/buy', 'TicketController@createClient');
    Route::post('client/event/store', ['uses'=>'TicketController@store','as'=>'ticket.store.client']);
    Route::get('client/event/successBuy', ['uses'=>'TicketController@showSuccess','as'=>'ticket.success.client']);
    Route::post('client/event/successMail', ['uses'=>'TicketController@mailSuccess','as'=>'ticket.success.client.mail']);
    Route::get('client/{id}/reservanueva', ['as' => 'booking.create' , 'uses' => 'BookingController@create']);
    //Fin
    Route::get('client/reservaexitosa', 'BookingController@store');
    Route::get('client/mail/{code}', 'BookingController@sendConfirmationMail');
});

Route::group(['middleware' => ['auth', 'salesman']], function () {
    Route::get('salesman', ['uses'=>'PagesController@salesmanHome','as'=>'salesman.home']);
    Route::get('salesman/cash_count', 'BusinessController@cashCount');
    Route::post('salesman/cash_count', 'BusinessController@updateCash');
    //Route::post('salesman/cash_count', 'BusinessController@updateCashCount');


    Route::get('salesman/password', 'BusinessController@passwordSalesman');
    Route::post('salesman/password', 'BusinessController@passwordUpdateSalesman');



    Route::get('salesman/exchange_gift', 'GiftController@createExchange');
    Route::post('salesman/exchange_gift', 'GiftController@createExchangePost');


    Route::get('salesman/event/pay_booking', ['as' => 'booking.search', 'uses' =>'BookingController@searchBooking']);
    Route::post('salesman/event/pay_booking', ['as' => 'booking.show', 'uses' =>'BookingController@showPayBooking']);
    Route::post('salesman/event/pay_booking/store', ['as' => 'booking.store', 'uses' =>'BookingController@storePayBooking']);

    Route::get('salesman/giveaway', ['uses'=>'TicketController@giveaway','as'=>'ticket.giveaway']);
    Route::post('salesman/giveaway', ['uses'=>'TicketController@giveawayShow','as'=>'ticket.giveaway.show']);
    Route::post('salesman/giveaway/confirm', ['uses'=>'TicketController@giveawayConfirm','as'=>'ticket.giveaway.confirm']);

    //Este inicia en el detalle del evento
    Route::get('salesman/event/{id}/buy', 'TicketController@createSalesman');
    Route::post('salesman/event/store', ['uses'=>'TicketController@store','as'=>'ticket.store']);
    Route::get('salesman/event/successBuy', ['uses'=>'TicketController@showSuccessSalesman','as'=>'ticket.success.salesman']);
    Route::post('salesman/event/successMail', ['uses'=>'TicketController@mailSuccess','as'=>'ticket.success.salesman.mail']);

    Route::get('salesman/devolutions/', 'DevolutionController@index');
    Route::get('salesman/devolutions/new/{ticket_id}', 'DevolutionController@create');
    Route::post('salesman/devolutions/new/{ticket_id}', 'DevolutionController@store');
    Route::get('salesman/devolutions/{devolution_id}', 'DevolutionController@show');
    Route::post('salesman/ticket/repay', 'TicketController@repay');

});

//Rutas generales para peticiones ajax, pueden ser usadas por varios usuarios, por eso lo saque
Route::get('getClient', ['uses'=>'TicketController@getClient','as'=>'ajax.getClient']);
Route::get('getPrice', ['uses'=>'TicketController@getPrice','as'=>'ajax.getPrice']);
Route::get('getAvailable', ['uses'=>'TicketController@getAvailable','as'=>'ajax.getAvailable']);
Route::get('getSlots', ['uses'=>'TicketController@getSlots','as'=>'ajax.getSlots']);
Route::get('getZone', ['uses'=>'TicketController@getZone','as'=>'ajax.getZone']);
Route::get('getTakenSlots', ['uses'=>'TicketController@getTakenSlots','as'=>'ajax.getTakenSlots']);
Route::get('getPromo', ['uses'=>'TicketController@getPromo','as'=>'ajax.getPromo']);
Route::get('getReserves', ['uses'=>'BookingController@getReservesByDni','as'=>'ajax.getReserves']);
Route::get('localSeats', ['uses'=>'LocalController@getLocalSeatArray','as'=>'ajax.getSeatsArray']);
Route::get('zoneSeatArray', ['uses'=>'LocalController@getZoneSeatArray','as'=>'ajax.getZoneSeatArray']);
Route::get('zoneSeatIds', ['uses'=>'LocalController@getZoneSeatsIds','as'=>'ajax.getZoneSeatsIds']);

Route::group(['middleware' => ['auth', 'promoter']], function () {
    Route::get('promoter/', ['as'=>'promoter.home','uses'=>'PagesController@promoterHome']);
    Route::get('promoter/politics', 'PoliticController@index');
    Route::get('promoter/politics', 'PoliticController@politicsPromotor');

    Route::get('promoter/transfer_payments/', 'PaymentController@index');
    //Route::get('promoter/transfer_payments/{payment_id}', 'PaymentController@show');
    Route::get('promoter/transfer_payments/{event_id}/create', 'PaymentController@create');
    Route::post('promoter/transfer_payments/{event_id}/create', 'PaymentController@store');

    Route::get('promoter/event/record', ['as'=>'promoter.record','uses'=>'EventController@showPromoterRecord']);
    Route::get('promoter/event/recordPayment', 'PaymentController@index');
    Route::get('promoter/event/create', 'EventController@create');
    Route::post('promoter/event/create', ['as' => 'events.store', 'uses' =>'EventController@store']);
    Route::get('promoter/event/{event_id}', ['as' => 'events.show', 'uses' =>'EventController@show']);
    Route::post('promoter/event/{event_id}/edit', ['as' => 'events.update', 'uses' =>'EventController@update']);
    Route::get('promoter/event/{event_id}/edit', ['as' => 'events.edit', 'uses' =>'EventController@edit']);
    Route::post('promoter/event/{event_id}/delete', ['as' => 'events.delete', 'uses' =>'EventController@destroy']);
    Route::get('promoter/event/{event_id}/cancel', 'EventController@cancel');
    Route::post('promoter/event/{event_id}/cancel', 'EventController@cancelStorage');

    Route::get('promoter/presentation/cancelled', 'PresentationController@index');
    Route::get('promoter/presentation/cancelled/{cancelled_id}/modules', 'PresentationController@modules');
    Route::post('promoter/presentation/cancelled/{cancelled_id}/modules', 'PresentationController@modulesStorage');
    Route::get('promoter/presentation/{presentation_id}/cancel', 'PresentationController@cancel');
    Route::post('promoter/presentation/{presentation_id}/cancel', 'PresentationController@cancelStorage');
    Route::get('promoter/presentation/cancelled/{id}/edit', 'PresentationController@editCancelled');
    Route::post('promoter/presentation/cancelled/{id}/edit', 'PresentationController@cancelUpdate');

    Route::get('promoter/{category_id}/subcategories', 'EventController@subcategoriesToAjax');
    Route::get('getLocal/{id}',['as'=>'ajax.getLocal','uses'=>'EventController@getLocal']);

    //Route::get('promoter/promotion', 'PromoController@index');
    Route::get('promoter/promotion', 'PromoController@promotion');
    Route::get('promoter/promotion/new', ['as'=>'promo.create','uses'=>'PromoController@create']);
    Route::post('promoter/promotion/new', ['as'=>'promo.store','uses'=>'PromoController@store']);
    Route::get('promoter/promotion/new/{event_id}', 'PromoController@ajax');
    Route::get('promoter/promotion/{id}/edit', ['as'=>'promo.edit','uses'=>'PromoController@edit']);
    Route::post('promoter/promotion/{id}/edit',  'PromoController@update');
    Route::get('promoter/promotion/{id}/delete',  'PromoController@destroy');

    Route::get('promoter/password', 'PromoController@passwordPromoter');
    Route::post('promoter/password', 'PromoController@passwordUpdatePromoter');


    Route::get('promoter/organizers', 'OrganizerController@index');
    Route::get('promoter/organizer/create', 'OrganizerController@create');
    Route::post('promoter/organizer/create', 'OrganizerController@store');
    Route::get('promoter/organizer/{id}/edit', 'OrganizerController@edit');
    Route::post('promoter/organizer/{id}/edit', 'OrganizerController@update'); // faltan
    Route::get('promoter/organizer/{id}/delete', 'OrganizerController@destroy');

    Route::get('promoter/highlights', ['as'=>'promoter.highlights.index','uses'=>'EventController@getHighlights']);
    Route::get('promoter/highlights/create', 'EventController@createHighlight');
    Route::post('promoter/highlights/create', 'EventController@storeHighlight');
    Route::post('promoter/highlights/{id}/editDate', 'EventController@editDate');
});

Route::group(['middleware' => ['auth', 'admin']], function () {

    Route::get('admin/', ['uses'=>'PagesController@adminHome','as'=>'admin.home']);

    Route::get('admin/politics', 'PoliticController@politics');
    Route::get('admin/politics/new', 'PoliticController@create');
    Route::post('admin/politics/new', 'PoliticController@store');
    Route::get('admin/politics/{id}/edit', 'PoliticController@edit');
    Route::post('admin/politics/{id}/edit', 'PoliticController@update');

    Route::get('admin/local', 'LocalController@index');
    Route::get('admin/local/new', 'LocalController@create');
    Route::post('admin/local/new', 'LocalController@store');
    Route::get('admin/local/{id}/edit', 'LocalController@edit');
    Route::post('admin/local/{id}/edit', 'LocalController@update');
    Route::get('admin/local/{id}/delete', 'LocalController@destroy');

    Route::get('admin/exchange_gift', 'GiftController@createExchangeAdmin');
    Route::post('admin/exchange_gift', 'GiftController@createExchangeAdminPost');


    Route::get('admin/gifts', ['uses'=>'GiftController@index','as'=>'admin.gifts']);
    Route::get('admin/gifts/new', 'GiftController@create');
    Route::post('admin/gifts/new', 'GiftController@store');
    Route::get('admin/gifts/{id}/edit', 'GiftController@edit');
    Route::post('admin/gifts/{id}/edit', 'GiftController@update');
    Route::get('admin/gifts/{id}/delete', 'GiftController@destroy');

    Route::get('admin/category', ['as' => 'admin.categories.index', 'uses' =>'CategoryController@index']);
    Route::get('admin/category/new', 'CategoryController@create');
    Route::post('admin/category/new', ['as' => 'categories.store', 'uses' =>'CategoryController@store']);
    Route::get('admin/category/{id}/edit', ['as' => 'categories.edit', 'uses' =>'CategoryController@edit']);
    Route::post('admin/category/{id}/edit', ['as' => 'categories.update', 'uses' =>'CategoryController@update']);
    Route::post('admin/category/{id}/delete', ['as' => 'categories.delete', 'uses' =>'CategoryController@destroy']);
    Route::get('admin/category/{id}/subcategories', ['as' => 'subcategories.index', 'uses' =>'CategoryController@indexSubAdmin']);


    Route::get('admin/ticket_return', 'TicketController@indexReturn');
    Route::get('admin/ticket_return/new', 'TicketController@createReturn');
    Route::get('admin/{id}/attendance', 'BusinessController@attendance');
    Route::post('admin/{id}/attendanceSubmit', 'BusinessController@attendanceSubmit');


    Route::get('admin/attendance/{id}/detail', 'BusinessController@attendanceDetail');
  Route::post('admin/{id}/Update/attendanceSubmit', 'BusinessController@attendanceUpdate');



    Route::get('admin/devolutions/', 'DevolutionController@index');
    Route::get('admin/devolutions/new', 'DevolutionController@create');
    Route::post('admin/devolutions/new', 'DevolutionController@store');
    Route::get('admin/devolutions/{devolution_id}', 'DevolutionController@show');

    Route::get('admin/ticket/{devolution_id}/tojson', 'TicketController@getTicketToJson');

    Route::get('admin/attendance', 'BusinessController@attendance');

    Route::get('admin/config/exchange_rate', 'BusinessController@exchangeRate');
    Route::post('admin/config/exchange_rate', 'BusinessController@storeExchangeRate');
    Route::get('admin/config/about', 'BusinessController@about');
    Route::post('admin/config/about', ['uses'=>'BusinessController@aboutUpdate','as'=>'config.about.update']);
    Route::get('admin/config/system', 'BusinessController@system');
    Route::post('admin/config/system', ['uses'=>'BusinessController@systemUpdate','as'=>'config.system.update']);

    Route::get('admin/report/assistance', 'ReportController@showAssistance');
    Route::post('admin/report/assistance', 'ReportController@assistanceExcel');
    Route::get('admin/report/sales', 'ReportController@showSales');
    Route::post('admin/report/sales','ReportController@actionExcel');
    //Route::get('admin/report/sales/download','ReportController@actionExcel');
    Route::get('admin/report/assignment', 'ReportController@showAssigment');
    Route::post('admin/report/assignment', 'ReportController@assigmentExcel');

    Route::get('admin/modules', 'ModuleController@index');
    Route::get('admin/modules/new', 'ModuleController@create');
    Route::post('admin/modules/new', 'ModuleController@store');
    Route::get('admin/modules/{id}/edit', 'ModuleController@edit');
    Route::post('admin/modules/{id}/edit', 'ModuleController@update');
    Route::get('admin/modules/{id}/delete', 'ModuleController@destroy');
    Route::get('admin/modules/assigment', 'ModuleController@showAssigment');
    Route::post('admin/modules/assigment', 'ModuleController@newAssigment');
    Route::get('admin/modules/assigment/{id}/delete', 'ModuleController@destroyAssigment');

    Route::get('admin/password', 'AdminController@passwordAdmin');
    Route::post('admin/password', 'AdminController@passwordUpdateAdmin');


    Route::get('admin/client', 'ClientController@index');
    Route::post('admin/client/desactive', 'ClientController@desactive');

    Route::get('admin/salesman', ['as'=>'admin.salesman','uses'=>'AdminController@salesman']);
    Route::get('admin/salesman/{id}/edit', 'AdminController@editSalesman');
    Route::post('admin/salesman/{id}/edit', 'AdminController@updateSalesman');
    Route::get('admin/salesman/{id}/delete', 'AdminController@destroySalesman');

    Route::get('admin/user/new', 'AdminController@newUser');
    Route::post('admin/user/new', 'AdminController@store');

    Route::get('admin/admin', 'AdminController@admin');
    Route::get('admin/admin/{id}/edit', 'AdminController@editAdmin');
    Route::post('admin/admin/{id}/edit', 'AdminController@updateAdmin');
    //
    Route::get('admin/admin/{id}/delete', 'AdminController@destroy');

    Route::get('admin/promoter', 'AdminController@promoter');
    Route::get('admin/promoter/{id}/edit', 'AdminController@editPromoter');
    Route::post('admin/promoter/{id}/edit', 'AdminController@updatePromoter');
    Route::get('admin/promoter/{id}/delete', 'AdminController@destroyPromoter');

    Route::get('admin/especieMarinas', ['uses'=>'EspeciesMarinasController@index','as'=>'admin.especieMarinas']);
    Route::get('admin/especieMarinas/new', 'EspeciesMarinasController@create');
    Route::post('admin/especieMarinas/new', 'EspeciesMarinasController@store');
    Route::get('admin/especieMarinas/{id}/edit', 'EspeciesMarinasController@edit');
    Route::post('admin/especieMarinas/{id}/edit', 'EspeciesMarinasController@update');
    Route::get('admin/especieMarinas/{id}/delete', 'EspeciesMarinasController@destroy');

    Route::get('admin/puertos', ['uses'=>'PuertosController@index','as'=>'admin.puertos']);
    Route::get('admin/puertos/new', 'PuertosController@create');
    Route::post('admin/puertos/new', 'PuertosController@store');
    Route::get('admin/puertos/{id}/edit', 'PuertosController@edit');
    Route::post('admin/puertos/{id}/edit', 'PuertosController@update');
    Route::get('admin/puertos/{id}/delete', 'PuertosController@destroy');

    Route::get('admin/capitanias', ['uses'=>'CapitaniaController@index','as'=>'admin.capitanias']);
    Route::get('admin/capitanias/new', 'CapitaniaController@create');
    Route::post('admin/capitanias/new', 'CapitaniaController@store');
    Route::get('admin/capitanias/{id}/edit', 'CapitaniaController@edit');
    Route::post('admin/capitanias/{id}/edit', 'CapitaniaController@update');
    Route::get('admin/capitanias/{id}/delete', 'CapitaniaController@destroy');

    Route::get('admin/dpas', ['uses'=>'DpaController@index','as'=>'admin.dpas']);
    Route::get('admin/dpas/new', 'DpaController@create');
    Route::post('admin/dpas/new', 'DpaController@store');
    Route::get('admin/dpas/{id}/edit', 'DpaController@edit');
    Route::post('admin/dpas/{id}/edit', 'DpaController@update');
    Route::get('admin/dpas/{id}/delete', 'DpaController@destroy');

    Route::get('admin/terminales', ['uses'=>'TerminalController@index','as'=>'admin.terminales']);
    Route::get('admin/terminales/new', 'TerminalController@create');
    Route::post('admin/terminales/new', 'TerminalController@store');
    Route::get('admin/terminales/{id}/edit', 'TerminalController@edit');
    Route::post('admin/terminales/{id}/edit', 'TerminalController@update');
    Route::get('admin/terminales/{id}/delete', 'TerminalController@destroy');

    Route::get('admin/fabricas', ['uses'=>'FabricaController@index','as'=>'admin.fabricas']);
    Route::get('admin/fabricas/new', 'FabricaController@create');
    Route::post('admin/fabricas/new', 'FabricaController@store');
    Route::get('admin/fabricas/{id}/edit', 'FabricaController@edit');
    Route::post('admin/fabricas/{id}/edit', 'FabricaController@update');
    Route::get('admin/fabricas/{id}/delete', 'FabricaController@destroy');

    Route::get('admin/pescadores', ['uses'=>'PescadoresController@index','as'=>'admin.pescadores']);
    Route::get('admin/pescadores/new', 'PescadoresController@create');
    Route::post('admin/pescadores/new', 'PescadoresController@store');
    Route::get('admin/pescadores/{id}/edit', 'PescadoresController@edit');
    Route::post('admin/pescadores/{id}/edit', 'PescadoresController@update');
    Route::get('admin/pescadores/{id}/delete', 'PescadoresController@destroy');
    Route::get('admin/pescadores/{id}/editPermisoMarinero', 'PescadoresController@editPermisoMarinero');
    Route::get('admin/pescadores/{id}/showPermisoMarinero', 'PescadoresController@showPermisoMarinero');
    Route::get('admin/pescadores/{id}/editPermisoPatron', 'PescadoresController@editPermisoPatron');
    Route::get('admin/pescadores/{id}/showPermisoPatron', 'PescadoresController@showPermisoPatron');

    Route::get('admin/embarcaciones', ['uses'=>'EmbarcacionController@index','as'=>'admin.embarcaciones']);
    Route::get('admin/embarcaciones/new', 'EmbarcacionController@create');
    Route::post('admin/embarcaciones/new', 'EmbarcacionController@store');
    Route::get('admin/embarcaciones/{id}/edit', 'EmbarcacionController@edit');
    Route::post('admin/embarcaciones/{id}/edit', 'EmbarcacionController@update');
    Route::get('admin/embarcaciones/{id}/delete', 'EmbarcacionController@destroy');
    Route::get('admin/embarcaciones/{id}/editCertificado', 'EmbarcacionController@editCertificado');
    Route::get('admin/embarcaciones/{id}/showCertificado', 'EmbarcacionController@showCertificado');
    Route::get('admin/embarcaciones/{id}/editPermiso', 'EmbarcacionController@editPermiso');
    Route::get('admin/embarcaciones/{id}/showPermiso', 'EmbarcacionController@showPermiso');

    Route::get('admin/transportistas', ['uses'=>'TransportistaController@index','as'=>'admin.transporistas']);
    Route::get('admin/transportistas/new', 'TransportistaController@create');
    Route::post('admin/transportistas/new', 'TransportistaController@store');
    Route::get('admin/transportistas/{id}/edit', 'TransportistaController@edit');
    Route::post('admin/transportistas/{id}/edit', 'TransportistaController@update');
    Route::get('admin/transportistas/{id}/delete', 'TransportistaController@destroy');

    Route::get('admin/frigorificos', ['uses'=>'FrigorificoController@index','as'=>'admin.frigorificos']);
    Route::get('admin/frigorificos/new', 'FrigorificoController@create');
    Route::post('admin/frigorificos/new', 'FrigorificoController@store');
    Route::get('admin/frigorificos/{id}/edit', 'FrigorificoController@edit');
    Route::post('admin/frigorificos/{id}/edit', 'FrigorificoController@update');
    Route::get('admin/frigorificos/{id}/delete', 'FrigorificoController@destroy');

    Route::get('admin/certificadoMatriculas', ['uses'=>'CertificadoMatriculasController@index','as'=>'admin.certificadoMatriculas']);
    Route::get('admin/certificadoMatriculas/new', 'CertificadoMatriculasController@create');
    Route::post('admin/certificadoMatriculas/new', 'CertificadoMatriculasController@store');
    Route::get('admin/certificadoMatriculas/{id}/edit', 'CertificadoMatriculasController@edit');
    Route::post('admin/certificadoMatriculas/{id}/edit', 'CertificadoMatriculasController@update');
    Route::get('admin/certificadoMatriculas/{id}/delete', 'CertificadoMatriculasController@destroy');

})  ;

Route::get('token',function(){
    return csrf_token();
});


