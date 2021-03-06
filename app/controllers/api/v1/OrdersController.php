
<?php

class OrdersController extends \MaemController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {

		$hashset = $this-> pickRandomIds('orders', 5);

		$output = array();
		
		foreach ($hashset as $id => $value) {
			$order = Order::find($id);
			if ($order != null) {
				$output[] = $order->toArray();
			} else {
				$output[] = $this->findRemainItem('orders', $hashset);
			}
		}

		return Response::json($output);
	}

	private function findRemainItem($table, $hashset) {

		$id = $this->pickAdditionalRandomIdForSet($table, $hashset);

		$order = Order::find($id);
		if ($order != null) {
			return $order->toArray();
		} else {
			return $this->findRemainItem($table, $hashset);
		}
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
					));
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
				));
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
		->first();

		if (is_null($order)) {
			return Response::json(array(
				'error' 	=> false,
				'type' 		=> '400',
				'message' 	=> 'product is not existed',
				));
		}

		return $this->destroy($order->id);
	}
}