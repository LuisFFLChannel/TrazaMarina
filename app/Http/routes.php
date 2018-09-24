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

    
    

Route::post('codigoTrazabilidad', 'PagesController@buscarCodigo');

Route::get('especiesMarinas', 'EspeciesMarinasController@indexExternal');
Route::get('puertos', 'PuertosController@indexExternal');

Route::group(['middleware' => ['auth', 'client']], function () {
    Route::get('client/', ['uses'=>'ClientController@profile','as'=>'client.home']);
    Route::get('client/edit', 'ClientController@edit');
    Route::post('client/update', 'ClientController@update');
    Route::get('client/password', 'ClientController@password');
    Route::post('client/password', 'ClientController@passwordUpdate');
    Route::get('client/photo', 'ClientController@photoEdit');
    Route::post('client/photo', 'ClientController@photoUpdate');
    Route::get('client/home', 'PagesController@clientHome');

    Route::get('client/mail/{code}', 'BookingController@sendConfirmationMail');
});

Route::group(['middleware' => ['auth', 'clientMaster']], function () {
    Route::get('clientMaster/',['uses'=>'ClientController@profileMaster','as'=>'clientMaster.home']);
    Route::get('clientMaster/edit', 'ClientController@editClientMaster');
    Route::post('clientMaster/update', 'ClientController@updateClientMaster');
    Route::get('clientMaster/password', 'ClientController@passwordClientMaster');
    Route::post('clientMaster/password', 'ClientController@passwordUpdateClientMaster');
    Route::get('clientMaster/photo', 'ClientController@photoEditClientMaster');
    Route::post('clientMaster/photo', 'ClientController@photoUpdateClientMaster');
    Route::get('clientMaster/home', 'PagesController@clientMasterHome');

    Route::get('clientMaster/mail/{code}', 'BookingController@sendConfirmationMail');

     Route::get('clientMaster/codigoTrazabilidad/documentos/{codigo}/{idProducto}', 'PagesController@buscarDocumentos');

    Route::get('clientMaster/codigoTrazabilidad/documentos/certificadoMatriculas/{id}/showPDF', 'CertificadoMatriculasController@Clientepdf');
    Route::get('clientMaster/codigoTrazabilidad/documentos/permisoPescas/{id}/showPDF', 'PermisoPescaController@Clientepdf');
    Route::get('clientMaster/codigoTrazabilidad/documentos/permisoMarineros/{id}/showPDF', 'PermisoMarineroController@Clientepdf');
    Route::get('clientMaster/codigoTrazabilidad/documentos/permisoPatrones/{id}/showPDF', 'PermisoPatronController@Clientepdf');
    Route::get('clientMaster/codigoTrazabilidad/documentos/permisoZarpes/{id}/showPDF', 'PermisoZarpeController@Clientepdf');
});






Route::group(['middleware' => ['auth', 'admin']], function () {

    Route::get('admin/', ['uses'=>'PagesController@adminHome','as'=>'admin.home']);

    
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
    Route::get('admin/report/especies', 'ReportController@showReportGetEspecies');
    Route::post('admin/report/especies', 'ReportController@showReportPostEspecies');
    Route::get('admin/report/puertos', 'ReportController@showReportGetPuertos');
    Route::post('admin/report/puertos', 'ReportController@showReportPostPuertos');

    /*Route::get('admin/modules', 'ModuleController@index');
    Route::get('admin/modules/new', 'ModuleController@create');
    Route::post('admin/modules/new', 'ModuleController@store');
    Route::get('admin/modules/{id}/edit', 'ModuleController@edit');
    Route::post('admin/modules/{id}/edit', 'ModuleController@update');
    Route::get('admin/modules/{id}/delete', 'ModuleController@destroy');
    Route::get('admin/modules/assigment', 'ModuleController@showAssigment');
    Route::post('admin/modules/assigment', 'ModuleController@newAssigment');
    Route::get('admin/modules/assigment/{id}/delete', 'ModuleController@destroyAssigment');*/

    Route::get('admin/password', 'AdminController@passwordAdmin');
    Route::post('admin/password', 'AdminController@passwordUpdateAdmin');


    Route::get('admin/client', 'ClientController@index');
    Route::post('admin/client/desactive', 'ClientController@desactive');

    Route::get('admin/clientMaster', 'ClientController@indexMaster');
    Route::post('admin/clientMaster/desactive', 'ClientController@desactiveMaster');
    Route::get('admin/clientMaster/new', 'ClientController@createClientMaster');
    Route::post('admin/clientMaster/new', 'ClientController@storeClientMaster');



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

    Route::get('admin/usuarioPesca', 'AdminController@usuarioPesca');
    Route::get('admin/usuarioPesca/{id}/edit', 'AdminController@editUsuarioPesca');
    Route::post('admin/usuarioPesca/{id}/edit', 'AdminController@updateUsuarioPesca');
    Route::get('admin/usuarioPesca/{id}/delete', 'AdminController@destroyUsuarioPesca');

    Route::get('admin/usuarioIntermediario', 'AdminController@usuarioIntermediario');
    Route::get('admin/usuarioIntermediario/{id}/edit', 'AdminController@editUsuarioIntermediario');
    Route::post('admin/usuarioIntermediario/{id}/edit', 'AdminController@updateUsuarioIntermediario');
    Route::get('admin/usuarioIntermediario/{id}/delete', 'AdminController@destroyUsuarioIntermediario');

    Route::get('admin/validador', 'AdminController@validador');
    Route::get('admin/validador/{id}/edit', 'AdminController@editValidador');
    Route::post('admin/validador/{id}/edit', 'AdminController@updateValidador');
    Route::get('admin/validador/{id}/delete', 'AdminController@destroyValidador4');

    Route::get('admin/promoter', 'AdminController@promoter');
    Route::get('admin/promoter/{id}/edit', 'AdminController@editPromoter');
    Route::post('admin/promoter/{id}/edit', 'AdminController@updatePromoter');
    Route::get('admin/promoter/{id}/delete', 'AdminController@destroyPromoter');

    Route::get('admin/tipoPescas', ['uses'=>'TipoPescaController@index','as'=>'admin.tipoPescas']);
    Route::get('admin/tipoPescas/new', 'TipoPescaController@create');
    Route::post('admin/tipoPescas/new', 'TipoPescaController@store');
    Route::get('admin/tipoPescas/{id}/edit', 'TipoPescaController@edit');
    Route::post('admin/tipoPescas/{id}/edit', 'TipoPescaController@update');
    Route::get('admin/tipoPescas/{id}/delete', 'TipoPescaController@destroy');

    Route::get('admin/categoriaPuertos', ['uses'=>'CategoriaPuertoController@index','as'=>'admin.categoriaPuertos']);
    Route::get('admin/categoriaPuertos/new', 'CategoriaPuertoController@create');
    Route::post('admin/categoriaPuertos/new', 'CategoriaPuertoController@store');
    Route::get('admin/categoriaPuertos/{id}/edit', 'CategoriaPuertoController@edit');
    Route::post('admin/categoriaPuertos/{id}/edit', 'CategoriaPuertoController@update');
    Route::get('admin/categoriaPuertos/{id}/delete', 'CategoriaPuertoController@destroy');


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

    /*Route::get('admin/dpas', ['uses'=>'DpaController@index','as'=>'admin.dpas']);
    Route::get('admin/dpas/new', 'DpaController@create');
    Route::post('admin/dpas/new', 'DpaController@store');
    Route::get('admin/dpas/{id}/edit', 'DpaController@edit');
    Route::post('admin/dpas/{id}/edit', 'DpaController@update');
    Route::get('admin/dpas/{id}/delete', 'DpaController@destroy');*/

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

    Route::get('admin/transportistas', ['uses'=>'TransportistaController@index','as'=>'admin.transportistas']);
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

    Route::get('admin/mapas/{id}/mostarMapaCapitania', 'CapitaniaController@mostrarMapa');
    Route::get('admin/mapas/{id}/mostarMapaDpa', 'DpaController@mostrarMapa');
    Route::get('admin/mapas/{id}/mostarMapaPuerto', 'PuertosController@mostrarMapa');
    Route::get('admin/mapas/{id}/mostarMapaTerminal', 'TerminalController@mostrarMapa');
    Route::get('admin/mapas/{id}/mostarMapaFabrica', 'FabricaController@mostrarMapa');


    Route::get('admin/codigoTrazabilidad/documentos/{codigo}/{idProducto}', 'PagesController@buscarDocumentos');

    Route::get('admin/codigoTrazabilidad/documentos/certificadoMatriculas/{id}/showPDF', 'CertificadoMatriculasController@Clientepdf');
    Route::get('admin/codigoTrazabilidad/documentos/permisoPescas/{id}/showPDF', 'PermisoPescaController@Clientepdf');
    Route::get('admin/codigoTrazabilidad/documentos/permisoMarineros/{id}/showPDF', 'PermisoMarineroController@Clientepdf');
    Route::get('admin/codigoTrazabilidad/documentos/permisoPatrones/{id}/showPDF', 'PermisoPatronController@Clientepdf');
    Route::get('admin/codigoTrazabilidad/documentos/permisoZarpes/{id}/showPDF', 'PermisoZarpeController@Clientepdf');


})  ;
Route::group(['middleware' => ['auth', 'usuarioPesca']], function () {

   
    Route::get('usuarioPesca/', ['uses'=>'PagesController@usuarioPescaHome','as'=>'usuarioPesca.home']);
    Route::get('usuarioPesca/password', 'AdminController@passwordUsuarioPesca');
    Route::post('usuarioPesca/password', 'AdminController@passwordUpdateUsuarioPesca');

    Route::get('usuarioPesca/tipoPescas', ['uses'=>'TipoPescaController@index','as'=>'usuarioPesca.tipoPescas']);
    Route::get('usuarioPesca/tipoPescas/new', 'TipoPescaController@create');
    Route::post('usuarioPesca/tipoPescas/new', 'TipoPescaController@store');
    Route::get('usuarioPesca/tipoPescas/{id}/edit', 'TipoPescaController@edit');
    Route::post('usuarioPesca/tipoPescas/{id}/edit', 'TipoPescaController@update');
    Route::get('usuarioPesca/tipoPescas/{id}/delete', 'TipoPescaController@destroy');

    Route::get('usuarioPesca/categoriaPuertos', ['uses'=>'CategoriaPuertoController@index','as'=>'usuarioPesca.categoriaPuertos']);
    Route::get('usuarioPesca/categoriaPuertos/new', 'CategoriaPuertoController@create');
    Route::post('usuarioPesca/categoriaPuertos/new', 'CategoriaPuertoController@store');
    Route::get('usuarioPesca/categoriaPuertos/{id}/edit', 'CategoriaPuertoController@edit');
    Route::post('usuarioPesca/categoriaPuertos/{id}/edit', 'CategoriaPuertoController@update');
    Route::get('usuarioPesca/categoriaPuertos/{id}/delete', 'CategoriaPuertoController@destroy');

    Route::get('usuarioPesca/especieMarinas', ['uses'=>'EspeciesMarinasController@index','as'=>'usuarioPesca.especieMarinas']);
    Route::get('usuarioPesca/especieMarinas/new', 'EspeciesMarinasController@create');
    Route::post('usuarioPesca/especieMarinas/new', 'EspeciesMarinasController@store');
    Route::get('usuarioPesca/especieMarinas/{id}/edit', 'EspeciesMarinasController@edit');
    Route::post('usuarioPesca/especieMarinas/{id}/edit', 'EspeciesMarinasController@update');
    Route::get('usuarioPesca/especieMarinas/{id}/delete', 'EspeciesMarinasController@destroy');

    Route::get('usuarioPesca/puertos', ['uses'=>'PuertosController@index','as'=>'usuarioPesca.puertos']);
    Route::get('usuarioPesca/puertos/new', 'PuertosController@create');
    Route::post('usuarioPesca/puertos/new', 'PuertosController@store');
    Route::get('usuarioPesca/puertos/{id}/edit', 'PuertosController@edit');
    Route::post('usuarioPesca/puertos/{id}/edit', 'PuertosController@update');
    Route::get('admin/puertos/{id}/delete', 'PuertosController@destroy');

    Route::get('usuarioPesca/capitanias', ['uses'=>'CapitaniaController@index','as'=>'usuarioPesca.capitanias']);
    Route::get('usuarioPesca/capitanias/new', 'CapitaniaController@create');
    Route::post('usuarioPesca/capitanias/new', 'CapitaniaController@store');
    Route::get('usuarioPesca/capitanias/{id}/edit', 'CapitaniaController@edit');
    Route::post('usuarioPesca/capitanias/{id}/edit', 'CapitaniaController@update');
    Route::get('usuarioPesca/capitanias/{id}/delete', 'CapitaniaController@destroy');

    /*Route::get('usuarioPesca/dpas', ['uses'=>'DpaController@index','as'=>'usuarioPesca.dpas']);
    Route::get('usuarioPesca/dpas/new', 'DpaController@create');
    Route::post('usuarioPesca/dpas/new', 'DpaController@store');
    Route::get('usuarioPesca/dpas/{id}/edit', 'DpaController@edit');
    Route::post('usuarioPesca/dpas/{id}/edit', 'DpaController@update');
    Route::get('usuarioPesca/dpas/{id}/delete', 'DpaController@destroy');*/


    Route::get('usuarioPesca/pescadores', ['uses'=>'PescadoresController@index','as'=>'usuarioPesca.pescadores']);
    Route::get('usuarioPesca/pescadores/new', 'PescadoresController@create');
    Route::post('usuarioPesca/pescadores/new', 'PescadoresController@store');
    Route::get('usuarioPesca/pescadores/{id}/edit', 'PescadoresController@edit');
    Route::post('usuarioPesca/pescadores/{id}/edit', 'PescadoresController@update');
    Route::get('usuarioPesca/pescadores/{id}/delete', 'PescadoresController@destroy');
    Route::get('usuarioPesca/pescadores/{id}/editPermisoMarinero', 'PescadoresController@editPermisoMarinero');
    Route::post('usuarioPesca/pescadores/{id}/editPermisoMarinero', 'PescadoresController@updatePermisoMarinero');
    Route::get('usuarioPesca/pescadores/{id}/showPermisoMarinero', 'PescadoresController@showPermisoMarinero');
    Route::get('usuarioPesca/pescadores/{id}/editPermisoPatron', 'PescadoresController@editPermisoPatron');
    Route::post('usuarioPesca/pescadores/{id}/editPermisoPatron', 'PescadoresController@updatePermisoPatron');
    Route::get('usuarioPesca/pescadores/{id}/showPermisoPatron', 'PescadoresController@showPermisoPatron');

    Route::get('usuarioPesca/embarcaciones', ['uses'=>'EmbarcacionController@index','as'=>'usuarioPesca.embarcaciones']);
    Route::get('usuarioPesca/embarcaciones/new', 'EmbarcacionController@create');
    Route::post('usuarioPesca/embarcaciones/new', 'EmbarcacionController@store');
    Route::get('usuarioPesca/embarcaciones/{id}/edit', 'EmbarcacionController@edit');
    Route::post('usuarioPesca/embarcaciones/{id}/edit', 'EmbarcacionController@update');
    Route::get('usuarioPesca/embarcaciones/{id}/delete', 'EmbarcacionController@destroy');
    Route::get('usuarioPesca/embarcaciones/{id}/editCertificado', 'EmbarcacionController@editCertificado');
    Route::post('usuarioPesca/embarcaciones/{id}/editCertificado', 'EmbarcacionController@updateCertificado');
    Route::get('usuarioPesca/embarcaciones/{id}/showCertificado', 'EmbarcacionController@showCertificado');
    Route::get('usuarioPesca/embarcaciones/{id}/editPermiso', 'EmbarcacionController@editPermiso');
    Route::post('usuarioPesca/embarcaciones/{id}/editPermiso', 'EmbarcacionController@updatePermiso');
    Route::get('usuarioPesca/embarcaciones/{id}/showPermiso', 'EmbarcacionController@showPermiso');


    Route::get('usuarioPesca/permisoPescas', ['uses'=>'PermisoPescaController@index','as'=>'usuarioPesca.permisoPescas']);
    Route::get('usuarioPesca/permisoPescas/new', 'PermisoPescaController@create');
    Route::post('usuarioPesca/permisoPescas/new', 'PermisoPescaController@store');
    Route::get('usuarioPesca/permisoPescas/{id}/edit', 'PermisoPescaController@edit');
    Route::post('usuarioPesca/permisoPescas/{id}/edit', 'PermisoPescaController@update');
    Route::get('usuarioPesca/permisoPescas/{id}/delete', 'PermisoPescaController@destroy');

    Route::get('usuarioPesca/certificadoMatriculas', ['uses'=>'CertificadoMatriculasController@index','as'=>'usuarioPesca.certificadoMatriculas']);
    Route::get('usuarioPesca/certificadoMatriculas/new', 'CertificadoMatriculasController@create');
    Route::post('usuarioPesca/certificadoMatriculas/new', 'CertificadoMatriculasController@store');
    Route::get('usuarioPesca/certificadoMatriculas/{id}/edit', 'CertificadoMatriculasController@edit');
    Route::post('usuarioPesca/certificadoMatriculas/{id}/edit', 'CertificadoMatriculasController@update');
    Route::get('usuarioPesca/certificadoMatriculas/{id}/delete', 'CertificadoMatriculasController@destroy');


    Route::get('usuarioPesca/permisoZarpes', ['uses'=>'PermisoZarpeController@index','as'=>'usuarioPesca.permisoZarpes']);
    Route::get('usuarioPesca/permisoZarpes/new', 'PermisoZarpeController@create');
    Route::post('usuarioPesca/permisoZarpes/new', 'PermisoZarpeController@store');
    Route::get('usuarioPesca/permisoZarpes/{id}/edit', 'PermisoZarpeController@edit');
    Route::post('usuarioPesca/permisoZarpes/{id}/edit', 'PermisoZarpeController@update');
    Route::get('usuarioPesca/permisoZarpes/{id}/delete', 'PermisoZarpeController@destroy');
    Route::get('usuarioPesca/nuevoPermisoZarpes/new/{id_variable}', 'PescadoresController@ajaxPermisoZarpe');

    Route::get('usuarioPesca/permisoMarineros', ['uses'=>'PermisoMarineroController@index','as'=>'usuarioPesca.permisoMarineros']);
    Route::get('usuarioPesca/permisoMarineros/new', 'PermisoMarineroController@create');
    Route::post('usuarioPesca/permisoMarineros/new', 'PermisoMarineroController@store');
    Route::get('usuarioPesca/permisoMarineros/{id}/edit', 'PermisoMarineroController@edit');
    Route::post('usuarioPesca/permisoMarineros/{id}/edit', 'PermisoMarineroController@update');
    Route::get('usuarioPesca/permisoMarineros/{id}/delete', 'PermisoMarineroController@destroy');

    Route::get('usuarioPesca/permisoPatrones', ['uses'=>'PermisoPatronController@index','as'=>'usuarioPesca.permisoPatrones']);
    Route::get('usuarioPesca/permisoPatrones/new', 'PermisoPatronController@create');
    Route::post('usuarioPesca/permisoPatrones/new', 'PermisoPatronController@store');
    Route::get('usuarioPesca/permisoPatrones/{id}/edit', 'PermisoPatronController@edit');
    Route::post('usuarioPesca/permisoPatrones/{id}/edit', 'PermisoPatronController@update');
    Route::get('usuarioPesca/permisoPatrones/{id}/delete', 'PermisoPatronController@destroy');

    /*Route::get('usuarioPesca/pescas', ['uses'=>'PescaController@index','as'=>'usuarioPesca.pescas']);
    Route::get('usuarioPesca/pescas/new', 'PescaController@create');
    Route::post('usuarioPesca/pescas/new', 'PescaController@store');
    Route::get('usuarioPesca/pescas/{id}/edit', 'PescaController@edit');
    Route::post('usuarioPesca/pescas/{id}/edit', 'PescaController@update');*/
    Route::get('usuarioPesca/pescas/{id}/showDesembarque', 'PescaController@showDesembarque');
    //Route::get('usuarioPesca/pescasNoArribadas', 'PescaController@indexNoArribadas');
    //Route::get('usuarioPesca/pescasArribadas', 'PescaController@indexArribadas');

    Route::get('usuarioPesca/desembarques', ['uses'=>'DesembarqueController@index','as'=>'usuarioPesca.desembarques']);
    Route::get('usuarioPesca/pescas/{id}/addDesembarque', 'DesembarqueController@create');
    Route::post('usuarioPesca/pescas/{id}/addDesembarque', 'DesembarqueController@store');
    Route::get('getEspecie/{especie_id}', 'DesembarqueController@getEspecieToAjax');
    Route::get('usuarioPesca/desembarques/{id}/edit', 'DesembarqueController@edit');
    Route::post('usuarioPesca/desembarques/{id}/edit', 'DesembarqueController@update');
    Route::get('usuarioPesca/desembarques/{id}/editCertificado', 'DesembarqueController@editCertificado');
    Route::post('usuarioPesca/desembarques/{id}/editCertificado', 'DesembarqueController@updateCertificado');
    Route::get('usuarioPesca/desembarques/{id}/showCertificado', 'DesembarqueController@showCertificado');
    Route::get('usuarioPesca/desembarques/{id}/showNota', 'DesembarqueController@showNota');

    Route::get('usuarioPesca/notasIngresos', ['uses'=>'NotaIngresoController@index','as'=>'usuarioPesca.notasIngresos']);
    Route::get('usuarioPesca/notasIngresos/{id}/edit', 'NotaIngresoController@edit');
    Route::post('usuarioPesca/notasIngresos/{id}/edit', 'NotaIngresoController@update');
    Route::get('usuarioPesca/notasIngresos/{id}/agregarTrazabilidad', 'NotaIngresoController@agregarTraza');
    Route::post('usuarioPesca/notasIngresos/{id}/agregarTrazabilidad', 'NotaIngresoController@updateTraza');
    Route::get('usuarioPesca/notasIngresos/{id}/mostrarTrazabiliadad', 'NotaIngresoController@verTraza');

    Route::get('usuarioPesca/certificadoArribos', ['uses'=>'CertificadoArriboController@index','as'=>'usuarioPesca.certificadoArribos']);
    Route::get('usuarioPesca/certificadoArribos/new', 'CertificadoArriboController@create');
    Route::post('usuarioPesca/certificadoArribos/new', 'CertificadoArriboController@store');
    Route::get('usuarioPesca/certificadoArribos/{id}/edit', 'CertificadoArriboController@edit');
    Route::post('usuarioPesca/certificadoArribos/{id}/edit', 'CertificadoArriboController@update');
    Route::get('usuarioPesca/certificadoArribos/{id}/delete', 'CertificadoArriboController@destroy');

    Route::get('usuarioPesca/cantidadHielo', 'HieloController@calcularHielo');
    Route::post('usuarioPesca/cantidadHielo', 'HieloController@actualizarHielo');
    Route::get('getHistorialHielo/{idEspecie}/{idPuerto}/{idEmbarcacion}', 'HieloController@ajaxHistorialHielo');
    Route::post('usuarioPesca/verificarHielo', 'HieloController@actualizarHielo');
    Route::post('usuarioPesca/verificarHielo', 'HieloController@actualizarHielo');

    Route::get('usuarioPesca/mapas/{id}/mostarMapaCapitania', 'CapitaniaController@mostrarMapa');
    //Route::get('usuarioPesca/mapas/{id}/mostarMapaDpa', 'DpaController@mostrarMapa');
    Route::get('usuarioPesca/mapas/{id}/mostarMapaPuerto', 'PuertosController@mostrarMapa');
    Route::get('usuarioPesca/mapas/{id}/mostarMapaTerminal', 'TerminalController@mostrarMapa');
    Route::get('usuarioPesca/mapas/{id}/mostarMapaFabrica', 'FabricaController@mostrarMapa');
    Route::get('usuarioPesca/mapas/{id}/mostarMapaPesca', 'PescaController@mostrarMapa');


    //pdfs
    Route::get('usuarioPesca/certificadoMatriculas/{id}/showPDF', 'CertificadoMatriculasController@pdf');
    Route::get('usuarioPesca/permisoPescas/{id}/showPDF', 'PermisoPescaController@pdf');
    Route::get('usuarioPesca/permisoMarineros/{id}/showPDF', 'PermisoMarineroController@pdf');
    Route::get('usuarioPesca/permisoPatrones/{id}/showPDF', 'PermisoPatronController@pdf');
    Route::get('usuarioPesca/permisoZarpes/{id}/showPDF', 'PermisoZarpeController@pdf');

     Route::get('usuarioPesca/codigoTrazabilidad/documentos/{codigo}/{idProducto}', 'PagesController@buscarDocumentos');

    Route::get('usuarioPesca/codigoTrazabilidad/documentos/certificadoMatriculas/{id}/showPDF', 'CertificadoMatriculasController@Clientepdf');
    Route::get('usuarioPesca/codigoTrazabilidad/documentos/permisoPescas/{id}/showPDF', 'PermisoPescaController@Clientepdf');
    Route::get('usuarioPesca/codigoTrazabilidad/documentos/permisoMarineros/{id}/showPDF', 'PermisoMarineroController@Clientepdf');
    Route::get('usuarioPesca/codigoTrazabilidad/documentos/permisoPatrones/{id}/showPDF', 'PermisoPatronController@Clientepdf');
    Route::get('usuarioPesca/codigoTrazabilidad/documentos/permisoZarpes/{id}/showPDF', 'PermisoZarpeController@Clientepdf');


})  ;
Route::group(['middleware' => ['auth', 'usuarioIntermediario']], function () {

   
    Route::get('usuarioIntermediario/', ['uses'=>'PagesController@usuarioIntermediarioHome','as'=>'usuarioIntermediario.home']);
    Route::get('usuarioIntermediario/password', 'AdminController@passwordUsuarioIntermediario');
    Route::post('usuarioIntermediario/password', 'AdminController@passwordUpdateUsuarioIntermediario');

    Route::get('usuarioIntermediario/especieMarinas', ['uses'=>'EspeciesMarinasController@index','as'=>'usuarioIntermediario.especieMarinas']);
    Route::get('usuarioIntermediario/puertos', ['uses'=>'PuertosController@index','as'=>'usuarioIntermediario.puertos']);
    Route::get('usuarioIntermediario/capitanias', ['uses'=>'CapitaniaController@index','as'=>'usuarioIntermediario.capitanias']);
    Route::get('usuarioIntermediario/tipoPescas', ['uses'=>'TipoPescaController@index','as'=>'usuarioIntermediario.tipoPescas']);
    Route::get('usuarioIntermediario/categoriaPuertos', ['uses'=>'CategoriaPuertoController@index','as'=>'usuarioIntermediario.categoriaPuertos']);
    //Route::get('usuarioIntermediario/dpas', ['uses'=>'DpaController@index','as'=>'usuarioIntermediario.dpas']);

    Route::get('usuarioIntermediario/mapas/{id}/mostarMapaCapitania', 'CapitaniaController@mostrarMapa');
    //Route::get('usuarioIntermediario/mapas/{id}/mostarMapaDpa', 'DpaController@mostrarMapa');
    Route::get('usuarioIntermediario/mapas/{id}/mostarMapaPuerto', 'PuertosController@mostrarMapa');
    Route::get('usuarioIntermediario/mapas/{id}/mostarMapaTerminal', 'TerminalController@mostrarMapa');
    Route::get('usuarioIntermediario/mapas/{id}/mostarMapaFabrica', 'FabricaController@mostrarMapa');
    Route::get('usuarioIntermediario/mapas/{id}/mostarMapaPesca', 'PescaController@mostrarMapa');

    Route::get('usuarioIntermediario/transportistas', ['uses'=>'TransportistaController@index','as'=>'usuarioIntermediario.transportistas']);
    Route::get('usuarioIntermediario/transportistas/new', 'TransportistaController@create');
    Route::post('usuarioIntermediario/transportistas/new', 'TransportistaController@store');
    Route::get('usuarioIntermediario/transportistas/{id}/edit', 'TransportistaController@edit');
    Route::post('usuarioIntermediario/transportistas/{id}/edit', 'TransportistaController@update');
    Route::get('usuarioIntermediario/transportistas/{id}/delete', 'TransportistaController@destroy');

    Route::get('usuarioIntermediario/frigorificos', ['uses'=>'FrigorificoController@index','as'=>'usuarioIntermediario.frigorificos']);
    Route::get('usuarioIntermediario/frigorificos/new', 'FrigorificoController@create');
    Route::post('usuarioIntermediario/frigorificos/new', 'FrigorificoController@store');
    Route::get('usuarioIntermediario/frigorificos/{id}/edit', 'FrigorificoController@edit');
    Route::post('usuarioIntermediario/frigorificos/{id}/edit', 'FrigorificoController@update');
    Route::get('usuarioIntermediario/frigorificos/{id}/delete', 'FrigorificoController@destroy');

    Route::get('usuarioIntermediario/fabricas', ['uses'=>'FabricaController@index','as'=>'usuarioIntermediario.fabricas']);
    Route::get('usuarioIntermediario/fabricas/new', 'FabricaController@create');
    Route::post('usuarioIntermediario/fabricas/new', 'FabricaController@store');
    Route::get('usuarioIntermediario/fabricas/{id}/edit', 'FabricaController@edit');
    Route::post('usuarioIntermediario/fabricas/{id}/edit', 'FabricaController@update');
    Route::get('usuarioIntermediario/fabricas/{id}/delete', 'FabricaController@destroy');


    Route::get('usuarioIntermediario/terminales', ['uses'=>'TerminalController@index','as'=>'usuarioIntermediario.terminales']);
    Route::get('usuarioIntermediario/terminales/new', 'TerminalController@create');
    Route::post('usuarioIntermediario/terminales/new', 'TerminalController@store');
    Route::get('usuarioIntermediario/terminales/{id}/edit', 'TerminalController@edit');
    Route::post('usuarioIntermediario/terminales/{id}/edit', 'TerminalController@update');
    Route::get('usuarioIntermediario/terminales/{id}/delete', 'TerminalController@destroy');

    Route::get('usuarioIntermediario/pescadores', ['uses'=>'PescadoresController@index','as'=>'usuarioIntermediario.pescadores']);
    Route::get('usuarioIntermediario/pescadores/{id}/showPermisoMarinero', 'PescadoresController@showPermisoMarinero');
    Route::get('usuarioIntermediario/pescadores/{id}/showPermisoPatron', 'PescadoresController@showPermisoPatron');
    Route::get('usuarioIntermediario/embarcaciones', ['uses'=>'EmbarcacionController@index','as'=>'usuarioIntermediario.embarcaciones']); 
    Route::get('usuarioIntermediario/embarcaciones/{id}/showCertificado', 'EmbarcacionController@showCertificado');
    Route::get('usuarioIntermediario/embarcaciones/{id}/showPermiso', 'EmbarcacionController@showPermiso');


    Route::get('usuarioIntermediario/permisoPescas', ['uses'=>'PermisoPescaController@index','as'=>'usuarioIntermediario.permisoPescas']);
    Route::get('usuarioIntermediario/certificadoMatriculas', ['uses'=>'CertificadoMatriculasController@index','as'=>'usuarioIntermediario.certificadoMatriculas']);
    Route::get('usuarioIntermediario/permisoZarpes', ['uses'=>'PermisoZarpeController@index','as'=>'usuarioIntermediario.permisoZarpes']);
    Route::get('usuarioIntermediario/permisoMarineros', ['uses'=>'PermisoMarineroController@index','as'=>'usuarioIntermediario.permisoMarineros']);
    Route::get('usuarioIntermediario/permisoPatrones', ['uses'=>'PermisoPatronController@index','as'=>'usuarioIntermediario.permisoPatrones']);
    Route::get('usuarioIntermediario/certificadoArribos', ['uses'=>'CertificadoArriboController@index','as'=>'usuarioIntermediario.certificadoArribos']);

    //Route::get('usuarioIntermediario/pescas', ['uses'=>'PescaController@index','as'=>'usuarioIntermediario.pescas']);
    //Route::get('usuarioIntermediario/pescas/{id}/showDesembarque', 'PescaController@showDesembarque');
    //Route::get('usuarioPesca/pescasNoArribadas', 'PescaController@indexNoArribadas');
    //Route::get('usuarioPesca/pescasArribadas', 'PescaController@indexArribadas');

    Route::get('usuarioIntermediario/desembarques', ['uses'=>'DesembarqueController@index','as'=>'usuarioIntermediario.desembarques']);
    Route::get('usuarioIntermediario/desembarques/{id}/showCertificado', 'DesembarqueController@showCertificado');
    Route::get('usuarioIntermediario/desembarques/{id}/showNota', 'DesembarqueController@showNota');

    Route::get('usuarioIntermediario/notasIngresos', ['uses'=>'NotaIngresoController@index','as'=>'usuarioIntermediario.notasIngresos']);
    Route::get('usuarioIntermediario/notasIngresos/{id}/mostrarTrazabiliadad', 'NotaIngresoController@verTraza');
    Route::get('usuarioIntermediario/notasIngresos/{id}/verLotesporNota', 'NotaIngresoController@verLotesporNota');

    Route::get('usuarioIntermediario/certificadoProcedencias', ['uses'=>'CertificadoProcedenciaController@index','as'=>'usuarioIntermediario.certificadoProcedencias']);
    Route::get('usuarioIntermediario/certificadoProcedencias/new', 'CertificadoProcedenciaController@create');
    Route::post('usuarioIntermediario/certificadoProcedencias/new', 'CertificadoProcedenciaController@store');
    Route::get('usuarioIntermediario/certificadoProcedencias/{id}/edit', 'CertificadoProcedenciaController@edit');
    Route::post('usuarioIntermediario/certificadoProcedencias/{id}/edit', 'CertificadoProcedenciaController@update');
    Route::get('usuarioIntermediario/certificadoProcedencias/{id}/delete', 'CertificadoProcedenciaController@destroy');
    Route::get('usuarioIntermediario/nuevoCertificadoProcedencias/new/{id_variable}', 'CertificadoProcedenciaController@ajaxNotaIngreso');
    
    Route::get('usuarioIntermediario/transporteTerminales', ['uses'=>'TransporteTerminalController@index','as'=>'usuarioIntermediario.transporteTerminales']);
    Route::get('usuarioIntermediario/transporteTerminales/new', 'TransporteTerminalController@create');
    Route::post('usuarioIntermediario/transporteTerminales/new', 'TransporteTerminalController@store');
    Route::get('usuarioIntermediario/transporteTerminales/{id}/edit', 'TransporteTerminalController@edit');
    Route::post('usuarioIntermediario/transporteTerminales/{id}/edit', 'TransporteTerminalController@update');
    Route::get('usuarioIntermediario/transporteTerminales/{id}/delete', 'TransporteTerminalController@destroy');
    Route::get('usuarioIntermediario/nuevoTransporteTerminales/new/{id_variable}', 'TransporteTerminalController@ajaxNotaIngreso');

    Route::get('usuarioIntermediario/empresarioComercializadores', ['uses'=>'EmpresarioComercializadorController@index','as'=>'usuarioIntermediario.empresarioComercializadores']);
    Route::get('usuarioIntermediario/empresarioComercializadores/new', 'EmpresarioComercializadorController@create');
    Route::post('usuarioIntermediario/empresarioComercializadores/new', 'EmpresarioComercializadorController@store');
    Route::get('usuarioIntermediario/empresarioComercializadores/{id}/edit', 'EmpresarioComercializadorController@edit');
    Route::post('usuarioIntermediario/empresarioComercializadores/{id}/edit', 'EmpresarioComercializadorController@update');
    Route::get('usuarioIntermediario/empresarioComercializadores/{id}/delete', 'EmpresarioComercializadorController@destroy');

    Route::get('usuarioIntermediario/lotesFabricas', ['uses'=>'CertificadoProcedenciaController@lotesFabricas','as'=>'usuarioIntermediario.lotesFabricas']); 
    Route::get('usuarioIntermediario/lotesTerminales', ['uses'=>'TransporteTerminalController@lotesTerminales','as'=>'usuarioIntermediario.lotesTerminales']); 
    Route::get('usuarioIntermediario/lotesFabricas/{idNota}/{idCertificado}/agregarTrazabilidad', 'CertificadoProcedenciaController@agregarTraza');
    Route::post('usuarioIntermediario/lotesFabricas/{idNota}/{idCertificado}/agregarTrazabilidad', 'CertificadoProcedenciaController@updateTraza');
    Route::get('usuarioIntermediario/lotesTerminales/{idNota}/{idTransporte}/agregarTrazabilidad', 'TransporteTerminalController@agregarTraza');
    Route::post('usuarioIntermediario/lotesTerminales/{idNota}/{idTransporte}/agregarTrazabilidad', 'TransporteTerminalController@updateTraza');
    Route::get('usuarioIntermediario/lotesFabricas/{idNota}/{idCertificado}/mostrarTrazabilidad', 'CertificadoProcedenciaController@mostrarTrazabilidad');
    Route::get('usuarioIntermediario/lotesTerminales/{idNota}/{idTransporte}/mostrarTrazabilidad', 'TransporteTerminalController@mostrarTrazabilidad');

   
    //pdfs
    Route::get('usuarioIntermediario/certificadoMatriculas/{id}/showPDF', 'CertificadoMatriculasController@pdf');
    Route::get('usuarioIntermediario/permisoPescas/{id}/showPDF', 'PermisoPescaController@pdf');
    Route::get('usuarioIntermediario/permisoMarineros/{id}/showPDF', 'PermisoMarineroController@pdf');
    Route::get('usuarioIntermediario/permisoPatrones/{id}/showPDF', 'PermisoPatronController@pdf');
    Route::get('usuarioIntermediario/permisoZarpes/{id}/showPDF', 'PermisoZarpeController@pdf');

     Route::get('usuarioIntermediario/codigoTrazabilidad/documentos/{codigo}/{idProducto}', 'PagesController@buscarDocumentos');

    Route::get('usuarioIntermediario/codigoTrazabilidad/documentos/certificadoMatriculas/{id}/showPDF', 'CertificadoMatriculasController@Clientepdf');
    Route::get('usuarioIntermediario/codigoTrazabilidad/documentos/permisoPescas/{id}/showPDF', 'PermisoPescaController@Clientepdf');
    Route::get('usuarioIntermediario/codigoTrazabilidad/documentos/permisoMarineros/{id}/showPDF', 'PermisoMarineroController@Clientepdf');
    Route::get('usuarioIntermediario/codigoTrazabilidad/documentos/permisoPatrones/{id}/showPDF', 'PermisoPatronController@Clientepdf');
    Route::get('usuarioIntermediario/codigoTrazabilidad/documentos/permisoZarpes/{id}/showPDF', 'PermisoZarpeController@Clientepdf');


})  ;
Route::group(['middleware' => ['auth', 'usuarioValidacion']], function () {

   
    Route::get('usuarioValidacion/', ['uses'=>'PagesController@usuarioValidacionHome','as'=>'usuarioValidacion.home']);
    Route::get('usuarioValidacion/password', 'AdminController@passwordUsuarioValidacion');
    Route::post('usuarioValidacion/password', 'AdminController@passwordUpdateUsuarioValidacion');


    Route::get('usuarioValidacion/especieMarinas', ['uses'=>'EspeciesMarinasController@index','as'=>'usuarioValidacion.especieMarinas']);


    Route::get('usuarioValidacion/puertos', ['uses'=>'PuertosController@index','as'=>'usuarioValidacion.puertos']);
    Route::get('usuarioValidacion/capitanias', ['uses'=>'CapitaniaController@index','as'=>'usuarioValidacion.capitanias']);
     Route::get('usuarioValidacion/tipoPescas', ['uses'=>'TipoPescaController@index','as'=>'usuarioIntermediario.tipoPescas']);
    Route::get('usuarioValidacion/categoriaPuertos', ['uses'=>'CategoriaPuertoController@index','as'=>'usuarioIntermediario.categoriaPuertos']);
    //Route::get('usuarioValidacion/dpas', ['uses'=>'DpaController@index','as'=>'usuarioValidacion.dpas']);

    Route::get('usuarioValidacion/mapas/{id}/mostarMapaCapitania', 'CapitaniaController@mostrarMapa');
    //Route::get('usuarioValidacion/mapas/{id}/mostarMapaDpa', 'DpaController@mostrarMapa');
    Route::get('usuarioValidacion/mapas/{id}/mostarMapaPuerto', 'PuertosController@mostrarMapa');
    Route::get('usuarioValidacion/mapas/{id}/mostarMapaTerminal', 'TerminalController@mostrarMapa');
    Route::get('usuarioValidacion/mapas/{id}/mostarMapaFabrica', 'FabricaController@mostrarMapa');
    Route::get('usuarioValidacion/mapas/{id}/mostarMapaPesca', 'PescaController@mostrarMapa');

    Route::get('usuarioValidacion/transportistas', ['uses'=>'TransportistaController@index','as'=>'usuarioValidacion.transportistas']);
    Route::get('usuarioValidacion/frigorificos', ['uses'=>'FrigorificoController@index','as'=>'usuarioValidacion.frigorificos']);
    Route::get('usuarioValidacion/fabricas', ['uses'=>'FabricaController@index','as'=>'usuarioValidacion.fabricas']);
    Route::get('usuarioValidacion/terminales', ['uses'=>'TerminalController@index','as'=>'usuarioValidacion.terminales']);


    Route::get('usuarioValidacion/pescadores', ['uses'=>'PescadoresController@index','as'=>'usuarioValidacion.pescadores']);
    Route::get('usuarioValidacion/pescadores/{id}/showPermisoMarinero', 'PescadoresController@showPermisoMarinero');
    Route::get('usuarioValidacion/pescadores/{id}/showPermisoPatron', 'PescadoresController@showPermisoPatron');
    Route::get('usuarioValidacion/pescadores/{id}/validarPescador', 'PescadoresController@validarPescador');


    Route::get('usuarioValidacion/embarcaciones', ['uses'=>'EmbarcacionController@index','as'=>'usuarioValidacion.embarcaciones']); 
    Route::get('usuarioValidacion/embarcaciones/{id}/showCertificado', 'EmbarcacionController@showCertificado');
    Route::get('usuarioValidacion/embarcaciones/{id}/showPermiso', 'EmbarcacionController@showPermiso');
    Route::get('usuarioValidacion/embarcaciones/{id}/validarEmbarcacion', 'EmbarcacionController@validarEmbarcacion');

    Route::get('usuarioValidacion/permisoPescas', ['uses'=>'PermisoPescaController@index','as'=>'usuarioValidacion.permisoPescas']);
    Route::get('usuarioValidacion/certificadoMatriculas', ['uses'=>'CertificadoMatriculasController@index','as'=>'usuarioValidacion.certificadoMatriculas']);
    Route::get('usuarioValidacion/permisoZarpes', ['uses'=>'PermisoZarpeController@index','as'=>'usuarioValidacion.permisoZarpes']);
    Route::get('usuarioValidacion/permisoMarineros', ['uses'=>'PermisoMarineroController@index','as'=>'usuarioValidacion.permisoMarineros']);
    Route::get('usuarioValidacion/permisoPatrones', ['uses'=>'PermisoPatronController@index','as'=>'usuarioValidacion.permisoPatrones']);
    Route::get('usuarioValidacion/certificadoArribos', ['uses'=>'CertificadoArriboController@index','as'=>'usuarioValidacion.certificadoArribos']);

    //Route::get('usuarioValidacion/pescas', ['uses'=>'PescaController@index','as'=>'usuarioValidacion.pescas']);
    //Route::get('usuarioValidacion/pescas/{id}/showDesembarque', 'PescaController@showDesembarque');
    //Route::get('usuarioValidacion/pescas/{id}/validarPesca', 'PescaController@validarPesca');
    //Route::get('usuarioPesca/pescasNoArribadas', 'PescaController@indexNoArribadas');
    //Route::get('usuarioPesca/pescasArribadas', 'PescaController@indexArribadas');

    Route::get('usuarioValidacion/desembarques', ['uses'=>'DesembarqueController@index','as'=>'usuarioValidacion.desembarques']);
    Route::get('usuarioValidacion/desembarques/{id}/showCertificado', 'DesembarqueController@showCertificado');
    Route::get('usuarioValidacion/desembarques/{id}/showNota', 'DesembarqueController@showNota');
    Route::get('usuarioValidacion/desembarques/{id}/validarDesembarque', 'DesembarqueController@validarDesembarque');

    Route::get('usuarioValidacion/notasIngresos', ['uses'=>'NotaIngresoController@index','as'=>'usuarioValidacion.notasIngresos']);
    Route::get('usuarioValidacion/notasIngresos/{id}/mostrarTrazabiliadad', 'NotaIngresoController@verTraza');
    Route::get('usuarioValidacion/notasIngresos/{id}/verLotesporNota', 'NotaIngresoController@verLotesporNota');
    Route::get('usuarioValidacion/notasIngresos/{id}/validarNotaIngreso', 'NotaIngresoController@validarNota');

    Route::get('usuarioValidacion/certificadoProcedencias', ['uses'=>'CertificadoProcedenciaController@index','as'=>'usuarioValidacion.certificadoProcedencias']);

    
    Route::get('usuarioValidacion/transporteTerminales', ['uses'=>'TransporteTerminalController@index','as'=>'usuarioValidacion.transporteTerminales']);


    Route::get('usuarioValidacion/empresarioComercializadores', ['uses'=>'EmpresarioComercializadorController@index','as'=>'usuarioValidacion.empresarioComercializadores']);
  

    Route::get('usuarioValidacion/lotesFabricas', ['uses'=>'CertificadoProcedenciaController@lotesFabricas','as'=>'usuarioValidacion.lotesFabricas']); 
    Route::get('usuarioValidacion/lotesTerminales', ['uses'=>'TransporteTerminalController@lotesTerminales','as'=>'usuarioValidacion.lotesTerminales']); 
    Route::get('usuarioValidacion/lotesFabricas/{idNota}/{idCertificado}/mostrarTrazabilidad', 'CertificadoProcedenciaController@mostrarTrazabilidad');
    Route::get('usuarioValidacion/lotesTerminales/{idNota}/{idTransporte}/mostrarTrazabilidad', 'TransporteTerminalController@mostrarTrazabilidad');

    Route::get('usuarioValidacion/certificadoMatriculas/{id}/showPDF', 'CertificadoMatriculasController@pdf');
    Route::get('usuarioValidacion/permisoPescas/{id}/showPDF', 'PermisoPescaController@pdf');
    Route::get('usuarioValidacion/permisoMarineros/{id}/showPDF', 'PermisoMarineroController@pdf');
    Route::get('usuarioValidacion/permisoPatrones/{id}/showPDF', 'PermisoPatronController@pdf');
    Route::get('usuarioValidacion/permisoZarpes/{id}/showPDF', 'PermisoZarpeController@pdf');

     Route::get('usuarioValidacion/codigoTrazabilidad/documentos/{codigo}/{idProducto}', 'PagesController@buscarDocumentos');

    Route::get('usuarioValidacion/codigoTrazabilidad/documentos/certificadoMatriculas/{id}/showPDF', 'CertificadoMatriculasController@Clientepdf');
    Route::get('usuarioValidacion/codigoTrazabilidad/documentos/permisoPescas/{id}/showPDF', 'PermisoPescaController@Clientepdf');
    Route::get('usuarioValidacion/codigoTrazabilidad/documentos/permisoMarineros/{id}/showPDF', 'PermisoMarineroController@Clientepdf');
    Route::get('usuarioValidacion/codigoTrazabilidad/documentos/permisoPatrones/{id}/showPDF', 'PermisoPatronController@Clientepdf');
    Route::get('usuarioValidacion/codigoTrazabilidad/documentos/permisoZarpes/{id}/showPDF', 'PermisoZarpeController@Clientepdf');
})  ;



Route::get('token',function(){
    return csrf_token();
});


