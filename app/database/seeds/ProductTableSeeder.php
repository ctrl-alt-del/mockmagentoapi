<?php

use Illuminate\Database\Schema\Blueprint;

class ProductTableSeeder extends Seeder {

	public function run() {
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        // Uncomment the below to wipe the table clean before populating
		DB::table('products')->truncate();

		
		$names = array(
			'Edmonton Winter' 		=> '8376',
			'Fulani Nomad' 			=> '834765',
			'Ashanti Nomad' 		=> '320984',
			'Bambara Cargo'			=> '23984', 
			'Jola Summer Purple'	=> '48576.1',
			'Jola Summer Green'		=> '48576.2',
			'Marka Sport Red'		=> '934875.1', 
			'Marka Sport Blue'		=> '934875.2', 
			'Tuareg Summer'			=> '38746',
			);

		$prices = array(
			'8376' 		=> '160',
			'834765'	=> '59.9',
			'320984'	=> '29.5',
			'23984'		=> '12.5',
			'48576.1'	=> '47',
			'48576.2'	=> '47',
			'934875.1'	=> '45',
			'934875.2'	=> '45', 
			'38746'		=> '39.9',
			);

		$date = new DateTime;
		$products = array();

		foreach ($names as $name => $sku) {
			$product = array(
				'name' 			=> $name,
				'price' 		=> rand(200, 900),
				'sku' 			=> $sku,
				'price' 		=> $prices[$sku],
				'created_at' 	=> $date, 
				'updated_at' 	=> $date, 
				);
			array_push($products, $product);
		}

		DB::table('products')->insert($products);
		unset($products);
		$products = array();

		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}
}