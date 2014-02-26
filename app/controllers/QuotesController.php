<?php

class QuotesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		return Response::json(Quote::all());
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
		//
		$quote = Quote::find($id);


		if ($quote != null) {
			return Response::json($quote);
		}

		return Response::json(array(
			'error' => true,
			'type' => '404',
			));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showOrders($id)
	{
		
		$quote = Quote::find($id);
		$orders = $quote->orders;

		if ($orders != null) {
			return Response::json($orders);
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
		// Quote::find($id)->update(array(
		// 	// 'product_id' => Input::get('product_id'),
		// 	'quantity' => Input::get('quantity'),
		// 	));
		$quote->quantity = Input::get('quantity');
		$quote->save();

		return Response::json($quote);
		// return Response::json(Input::get('quantity'));
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