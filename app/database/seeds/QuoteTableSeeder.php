<?php

use Illuminate\Database\Schema\Blueprint;

class QuoteTableSeeder extends Seeder {

	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        // Uncomment the below to wipe the table clean before populating
		DB::table('quotes')->truncate();

		

		$date = new DateTime;
		$quotes = array();

		$users = User::all();

		foreach ($users as $user) {
			$quote = array(
				'user_id' => $user->id,
				'created_at' => $date,
				'updated_at' => $date,
				);

			array_push($quotes, $quote);
		}

		DB::table('quotes')->insert($quotes);
		unset($quotes);
		$quotes = array();

        // Uncomment the below to run the seeder
		// DB::table('quotes')->insert($quotes);
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}
}