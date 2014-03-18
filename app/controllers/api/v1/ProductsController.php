<?php

class ProductsController extends \MaemController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {

		$hashset = $this-> pickRandomIds('products', 5);

		$output = array();
		
		foreach ($hashset as $id => $value) {
			$order = Product::find($id);
			if ($order != null) {
				$output[] = $order->toArray();
			} else {
				$output[] = $this->findRemainItem('products', $hashset);
			}
		}

		return Response::json($output);
	}

	private function findRemainItem($table, $hashset) {

		$id = $this->pickAdditionalRandomIdForSet($table, $hashset);

		$order = Product::find($id);
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
	public function store()
	{
		$data = array(
			'name' => Input::get('name'),
			'price' => Input::get('price'),
			'sku' => Input::get('sku'),
			);

		$rules = array('sku' => 'unique:products,sku');

		$validator = Validator::make($data, $rules);

		if ($validator->fails()) {
			return Response::json(
				array(
					'code' 		=> '400',
					'message' 	=> 'Oops, product is already on database.',
					'data' 		=> '',
					));
			} else {

				$product = new Product;
				$product->name = Input::get('name');
				$product->price = Input::get('price');
				$product->sku = Input::get('sku');
				$product->save();

				return Response::json(
					array(
						'code' 		=> '200',
						'message' 	=> 'Product is registered, thank you!',
						'data' 		=> '',
						));
			}
		}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		//
		return Response::json(Product::findOrFail($id));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showIdWithSku($sku)
	{
		$product = Product::where('sku', '=', $sku)->firstOrFail();
		return Response::json($product);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$product = Product::findOrFail($id);
		$product->name = Input::get('name');
		$product->save();
		
		return Response::json($product);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}