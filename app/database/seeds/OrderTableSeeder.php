<?php

use Illuminate\Database\Schema\Blueprint;

class OrderTableSeeder extends Seeder {

	public function run() {
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        // Uncomment the below to wipe the table clean before populating
		DB::table('orders')->truncate();

		
		$quotes = Quote::all();
		$products = Product::all();

		$date = new DateTime;
		$orders = array();

		foreach ($quotes as $quote) {
			foreach ($products as $product) {
			$order = array(
				'quote_id' => $quote->id,
				'product_id' => $product->id,
				'quantity' => rand(1,10),
				'created_at' => $date, 
				'updated_at' => $date, 
				);
			array_push($orders, $order);
		}
		}

		DB::table('orders')->insert($orders);
		unset($orders);
		$orders = array();

		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}
}