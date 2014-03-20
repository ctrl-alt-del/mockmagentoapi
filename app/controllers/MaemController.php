<?php

class MaemController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	/**
	 * Pick a given amount of ids randomly from a given table.
	 *
	 * @param $table the name of the table
	 * @param $amount the number of ids
	 * @return $hashset an array that constains randomly selected ids
	 */
	protected function pickRandomIds($table, $amount)
	{
		$hashset = array();
		$totalRow = DB::table($table)->count();

		do {
			
			$id = rand(1, $totalRow);

			if (DB::table($table)->where('id', '=', $id) != null) {
				$hashset[] = true;
			}
			
		} while (count($hashset) < $amount);

		return $hashset;
	}

	/**
	 * Pick a random id of given table.
	 *
	 * @param $table the name of the table
	 * @return $id
	 */
	protected function pickRandomId($table) {

		$totalRow = DB::table($table)->count();
		
		$id = rand(1, $totalRow);

		if (DB::table($table)->where('id', '=', $id) == null) {
			return $this->pickRandomId($table);
		}
		return $id;
	}

	/**
	 * Pick a random id of given table and make sure it is not
	 * existed in the given hashset
	 *
	 * @param $table the name of the table
	 * @param $hashset an array that constains randomly selected ids
	 * @return id
	 */
	protected function pickAdditionalRandomIdForSet($table, $hashset) {

		$totalRow = DB::table($table)->count();

		do {
			$id = rand(1, $totalRow);
		} while (array_key_exists($id, $hashset) ||
			DB::table($table)->where('id', '=', $id) == null);

		return $id;
	}
}