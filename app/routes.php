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

/**
* Put all the routes into a group 'api/v1'
*
* @since 2014-03-05
* @version 1.0
**/
Route::group(
	array(
		'prefix' 	=> 'api/v1',
		'before' 	=> '', // filter used before calling routes
		'after' 	=> '', // filter used after calling routes
		),

	function() {

		Route::get('/', function()
		{
			return 'Welcome to API Version 01';
		});

		/**
		* Route to return a mock session data
		**/
		Route::get('session', function() {
			
			$date = new DateTime();

			return array(
				'type'			=> $_SERVER['REQUEST_METHOD'],
				'session_id' 	=> '71ll7anq2uj6nabseqd83uga33',
				'quote_id'		=> '',
				'date' 			=> $date->format('Y-m-d H:i:s'),
				);
		});

		/**
		* Route to return a mock basic authentication data
		**/
		Route::get('login', function() {
			
			$email = Input::get('email');
			$password = Input::get('password');
			
			$creds = array(
				'email' 	=> $email,
				'password'  => $password,
				);

			$date = new DateTime();
			
			if (Auth::attempt($creds)) {

				return Response::json(array(
					'email' 	=> $email,
					'date' 		=> $date->format('Y-m-d H:i:s'),
					'message' 	=> 'pass',
					'type'		=> $_SERVER['REQUEST_METHOD'],
					));
				
			} else {
				
				return Response::json(array(
					'email' 	=> $email,
					'date' 		=> $date->format('Y-m-d H:i:s'),
					'message' 	=> 'fails',
					'type'		=> $_SERVER['REQUEST_METHOD'],
					));
			}
			
		});

		/**
		* Route to return a mock basic authentication data
		**/
		Route::post('login', function() {

			$email = Input::get('email');
			$password = Input::get('password');		

			$creds = array(
				'email' 	=> $email,
				'password'  => $password,
				);

			// return Input::all();

			$date = new DateTime();
			
			if (Auth::attempt($creds)) {

				return Response::json(array(
					'email' 	=> $email,
					'date' 		=> $date->format('Y-m-d H:i:s'),
					'message' 	=> 'pass',
					'type'		=> $_SERVER['REQUEST_METHOD'],
					));
				
			} else {
				
				return Response::json(array(
					'email' 	=> $email,
					'date' 		=> $date->format('Y-m-d H:i:s'),
					'message' 	=> 'fails',
					'type'		=> $_SERVER['REQUEST_METHOD'],
					));
			}
			
		});

		/**
		* Routes to access the quote
		**/
		Route::resource('quotes', 'QuotesController');
		// Route::get('quotes', array('uses' => 'QuotesController@index'));
		// Route::get('quotes/{id}', array('uses' => 'QuotesController@show'));
		Route::get('quotes/{id}/orders', array('uses' => 'QuotesController@showOrders'));
		// Route::put('quotes/{id}', array('uses' => 'QuotesController@update'));

		/**
		* Routes to access the qproducts
		**/
		Route::resource('products', 'ProductsController');
		// Route::get('products', array('uses' => 'ProductsController@index'));
		// Route::get('products/{id}', array('uses' => 'ProductsController@show'));
		Route::get('products/sku/{sku}', array('uses' => 'ProductsController@showIdWithSku'));
		// Route::put('products/{id}', array('uses' => 'ProductsController@update'));

		/**
		* Routes to access the orders
		**/
		Route::resource('orders', 'OrdersController');
		// Route::get('orders', array('uses' => 'OrdersController@index'));
		// Route::post('orders', array('uses' => 'OrdersController@store'));
		Route::delete('orders', array('uses' => 'OrdersController@destroyWithQuoteAndProductIds'));
		// Route::get('orders/{id}', array('uses' => 'OrdersController@show'));
		// Route::put('orders/update', array('uses' => 'OrdersController@update'));
	});

/**
* Redirect all the routes to 'api/v1'
*
* @since 2014-03-05
* @version 1.0
**/
Route::any('{all}', function($path) {
	if (!preg_match("/\bapi\/v1\b/i", $path)) {
		return Redirect::to('api/v1/'.$path);
	}
})->where('all', '.*');
