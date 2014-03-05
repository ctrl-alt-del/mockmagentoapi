<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	// return View::make('hello');

	return 'Welcome to Mock API';
});

Route::group(
	array(
		'prefix' 	=> 'api/v1',
		'before' 	=> '',
		'after' 	=> '',
		),

	function() {

		Route::get('quotes', array('uses' => 'QuotesController@index'));
		Route::get('quotes/{id}', array('uses' => 'QuotesController@show'));
		Route::get('quotes/{id}/orders', array('uses' => 'QuotesController@showOrders'));


		Route::put('quotes/{id}', array('uses' => 'QuotesController@update'));

		Route::get('products', array('uses' => 'ProductsController@index'));
		Route::get('products/{id}', array('uses' => 'ProductsController@show'));
		Route::get('products/sku/{sku}', array('uses' => 'ProductsController@showIdWithSku'));
		Route::put('products/{id}', array('uses' => 'ProductsController@update'));


		Route::get('orders', array('uses' => 'OrdersController@index'));
		Route::post('orders', array('uses' => 'OrdersController@store'));
		Route::delete('orders', array('uses' => 'OrdersController@destroyWithQuoteAndProductIds'));

		Route::get('orders/{id}', array('uses' => 'OrdersController@show'));
		Route::put('orders/update', array('uses' => 'OrdersController@update'));


	});

