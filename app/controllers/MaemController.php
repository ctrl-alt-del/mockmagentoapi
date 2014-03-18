<?php

class MaemController extends BaseController {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function pickRandomIds($table, $amount)
	{
		$hashset = array();
		$totalRow = DB::table('orders')->count();

		while (count($hashset) < $amount) {
			$hashset[rand(1, $totalRow)] = true;
		}

		return $hashset;
	}



}