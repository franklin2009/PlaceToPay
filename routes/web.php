<?php

/**
 * Gestor de rutas
 */

 /**
 * Ruta: php-info, muestra informacion de la configuracion del php en el servidor
 */
Route::get('php-info', function () {  phpinfo(); });
 /**
 * Ruta: form-pse, muestra la vista del formualario de pago pse
 */
Route::get('form-pse', 'PageController@formPse');
 /**
 * Ruta: form-pse, muestra la vista del formualario de pago pse
 */
Route::get('list-pago', 'PageController@listPago');
 /**
 * Ruta: about, muestra la vista con informacion del desarrollador
 */
Route::get('about', 'PageController@about');
 /**
 * Ruta: /, muestra la vista del home
 */
Route::get('/', 'PageController@home');
 /**
 * Ruta: createTransacion,  llama al proceso logico, control para crear una transaccion de pago
 */
Route::post('createTransacion', 'PageController@createTransacion');
 /**
 * Ruta: transaccion, muestra la vista de la respursta de la ultima transaccion de pago
 */
Route::get('transaccion', 'PageController@transaccion');



 /**
 * Ruta: test-show, muestra la vista del test
 */
Route::get('test-show', 'TestController@show');

 /**
 * Ruta: test, logica/control para los casos de pruebas, se encarga de validar integridad de peticiones. Valores validos [1 al 10]
 */
Route::get('test/{caso}', 'TestController@test');
