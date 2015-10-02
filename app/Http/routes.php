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
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::get('login_worker', 'Auth\AuthController@worker');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');


Route::get('/', 'PagesController@home');
Route::get('about', 'PagesController@about');
Route::get('modules', 'ModuleController@indexExternal');
Route::get('calendar', 'PagesController@calendar');
Route::get('gifts', 'GiftController@indexExternal');
Route::get('category', 'CategoryController@indexExternal');
Route::get('category/{id}', 'CategoryController@showExternal');
Route::get('category/{id}/subcategory', 'CategoryController@indexSub');
Route::get('category/{id}/subcategory/{id2}', 'CategoryController@showSub');
Route::get('event', 'EventController@indexExternal');
Route::get('event/successBuy', 'TicketController@showSuccess');
Route::get('event/{id}', 'EventController@showExternal');

Route::group(['middleware' => ['auth', 'client']], function () {
    Route::get('client/home', 'PagesController@clientHome');
    Route::get('client/event_record', 'EventController@showClientRecord');
    //Estos 2 inician en el detalle del evento
    Route::get('client/event/{id}/buy', 'TicketController@createClient');
    Route::get('client/{id}/reservanueva', ['as' => 'booking.create' , 'uses' => 'BookingController@create']);
    //Fin
    Route::get('client/reservaexitosa', 'BookingController@store');
});

Route::group(['middleware' => ['auth', 'salesman']], function () {
    Route::get('salesman', 'PagesController@salesmanHome');
    Route::get('salesman/cash_count', 'BusinessController@cashCount');
    Route::get('salesman/exchange_gift', 'GiftController@createExchange');
    Route::get('salesman/event/{id}/pay_booking', 'BookingController@pay');
    Route::get('salesman/giveaway', 'TicketController@giveaway');
    //Este inicia en el detalle del evento
    Route::get('salesman/event/{id}/buy', 'TicketController@createSalesman');
});
//Fin
Route::group(['middleware' => ['auth', 'promoter']], function () {
    Route::get('promoter/', 'PagesController@promoterHome');
    Route::get('promoter/politics', 'PoliticController@index');
    Route::get('promoter/event/recordPayment', 'PaymentController@index');
    Route::get('promoter/transfer_payments', 'PaymentController@create');    
    Route::get('promoter/event/record', 'EventController@showPromoterRecord');
    Route::get('promoter/event/create', 'EventController@create');
    Route::get('promoter/event/editEvent', 'EventController@edit');
    Route::get('promoter/event/addFunction', 'EventController@addFunction');
    Route::get('promoter/promotion', 'PromoController@index');
    Route::get('promoter/organizers', 'OrganizerController@index');
    Route::get('promoter/organizer/create', 'OrganizerController@create');
    
    
});

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('admin/', 'PagesController@adminHome');
    
    Route::get('admin/politics', 'PoliticController@indexAdmin');
    Route::get('admin/politics/new', 'PoliticController@create');
    Route::get('admin/politics/{id}/edit', 'PoliticController@edit');

    Route::get('admin/local', 'LocalController@index');
    Route::get('admin/local/new', 'LocalController@create');
    Route::get('admin/local/{id}/edit', 'LocalController@edit');
    
    Route::get('admin/exchange_gift', 'GiftController@createExchangeAdmin');

    Route::get('admin/gifts', 'GiftController@index');
    Route::get('admin/gifts/new', 'GiftController@create');
    Route::post('admin/gifts/new', 'GiftController@store');
    Route::get('admin/gifts/{id}/edit', 'GiftController@edit');
    Route::post('admin/gifts/{id}/edit', 'GiftController@update');
    Route::get('admin/gifts/{id}/delete', 'GiftController@destroy');
    
    Route::get('admin/category', 'CategoryController@index');
    Route::get('admin/category/new', 'CategoryController@create');
    Route::get('admin/category/{id}/edit', 'CategoryController@edit');
    Route::get('admin/category/{id}/subcategory', 'CategoryController@indexSubAdmin');
    
    Route::get('admin/ticket_return', 'TicketController@indexReturn');
    Route::get('admin/ticket_return/new', 'TicketController@createReturn');
    
    Route::get('admin/attendance', 'BusinessController@attendance');

    Route::get('admin/config/exchange_rate', 'BusinessController@exchangeRate');
    Route::get('admin/config/about', 'BusinessController@about');
    Route::get('admin/config/system', 'BusinessController@system');

    Route::get('admin/report/assistance', 'ReportController@showAssistance');
    Route::get('admin/report/sales', 'ReportController@showSales');
    Route::get('admin/report/assignment', 'ReportController@showAssigment');
    
    Route::get('admin/modules', 'ModuleController@index');
    Route::get('admin/modules/new', 'ModuleController@create');
    Route::get('admin/modules/{id}/edit', 'ModuleController@edit');
    
    Route::get('admin/salesman', 'AdminController@salesman');
    Route::get('admin/salesman/{id}/edit', 'AdminController@editSalesman');
    
    Route::get('admin/promoter', 'AdminController@promoter');
    Route::get('admin/promoter/{id}/edit', 'AdminController@editPromoter');
    
    Route::get('admin/admin', 'AdminController@admin');
    Route::get('admin/admin/{id}/edit', 'AdminController@editAdmin');
    
    Route::get('admin/user/new', 'AdminController@newUser');
});