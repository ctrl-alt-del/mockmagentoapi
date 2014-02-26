<?php

class OrdersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$orders = Order::all();
		return Response::json($orders);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$order = Order::where('quote_id','=',Input::get('quote_id'))
		->where('product_id','=',Input::get('product_id'))
		->first();

		if ($order != null) {
			return Response::json(array(
				'error' 	=> false,
				'type' 		=> '200',
				'message' 	=> 'product has been added, no action is taken...',
				));
		}

		$order = new Order;
		$order->quote_id 	= Input::get('quote_id');
		$order->product_id 	= Input::get('product_id');
		$order->quantity 	= Input::get('quantity');
		$order->save();

		return Response::json(array(
			'error' 	=> false,
			'type' 		=> '201',
			'message' 	=> 'new product has created',
			));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
		$order = Order::find($id);
		if ($order != null) {
			return Response::json($order);
		}

		return Response::json(array(
			'error' => true,
			'type' => '404',
			));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		$order = Order::where('quote_id','=', Input::get('quote_id'))
		->where('product_id','=', Input::get('product_id'))
		->first();

		if ($order != null) {
			$order->quantity = Input::get('quantity');
			$order->save();
			return Response::json($order);
		} else {
			return Response::json('NO Order');
		}
		
		
		// return Response::json($order);
		// return Response::json(Input::get('name'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$order = Order::find($id);

		if ($order == null) {
			return Response::json(array(
				'error' 	=> false,
				'type' 		=> '200',
				'message' 	=> 'no product',
				));
		}
		
		$order->delete();

		return Response::json(array(
			'error' 	=> false,
			'type' 		=> '201',
			'message' 	=> 'product has deleted',
			));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroyWithQuoteAndProductIds()
	{
		$order = Order::where('quote_id','=',Input::get('quote_id'))
		->where('product_id','=',Input::get('product_id'))
		->first();

		$this->destroy($order->id);
	}

}