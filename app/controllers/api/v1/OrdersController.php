
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
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {

		$order = Order::where('quote_id','=',Input::get('quote_id'))
		->where('product_id','=',Input::get('product_id'))
		->first();

		if ($order != null) {
			return Response::json(
				array(
					'code' 		=> '400',
					'message' 	=> 'Order is already in database',
					'data' 		=> '',
					);
			}
		}

		$order = new Order;
		$order->quote_id 	= Input::get('quote_id');
		$order->product_id 	= Input::get('product_id');
		$order->quantity 	= Input::get('quantity');
		$order->save();

		return Response::json(
			array(
				'code' 		=> '200',
				'message' 	=> 'Order is created!',
				'data' 		=> '',
				);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$order = Order::find($id);
		return Response::json($order);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update() {
		$order = Order::where('quote_id','=', Input::get('quote_id'))
		->where('product_id','=', Input::get('product_id'))
		->firstOrFail();

		$order->quantity = Input::get('quantity');
		$order->save();
		return Response::json($order);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$order = Order::findOrFail($id);
		$order->delete();

		return Response::json(array(
			'error' 	=> false,
			'type' 		=> '200',
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
		->firstOrFail();

		$this->destroy($order->id);
	}
}