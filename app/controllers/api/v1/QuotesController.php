<?php

class QuotesController extends \MaemController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {

		$hashset = $this-> pickRandomIds('quotes', 5);

		$output = array();
		
		foreach ($hashset as $id => $value) {
			$order = Quote::find($id);
			if ($order != null) {
				$output[] = $order->toArray();
			} else {
				$output[] = $this->findRemainItem('quotes', $hashset);
			}
		}

		return Response::json($output);
	}

	private function findRemainItem($table, $hashset) {

		$id = $this->pickAdditionalRandomIdForSet($table, $hashset);

		$order = Quote::find($id);
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
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$quote = Quote::findOrFail($id);
		return Response::json($quote);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showOrders($id)
	{
		$quote = Quote::findOrFail($id);
		return Response::json($quote->orders);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$quote = Quote::findOrFail($id);
		$quote->quantity = Input::get('quantity');
		$quote->save();

		return Response::json($quote);
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