<?php

use Illuminate\Database\Schema\Blueprint;

class UserTableSeeder extends Seeder {

	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        // Uncomment the below to wipe the table clean before populating
		DB::table('users')->truncate();

		$names = $this->genNames(8);

		$date = new DateTime;
		$users = array();

		foreach ($names as $name) {
			$user = array(
				'email' 		=> $name.'@gmail.com',
				'password' 		=> Hash::make('000000'),
				'created_at' 	=> $date, 
				'updated_at' 	=> $date, 
				);
			array_push($users, $user);
		}

		DB::table('users')->insert($users);
		unset($users);
		$users = array();

        // Uncomment the below to run the seeder
		//DB::table('users')->insert($users);
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

	function genNames($trial) {

		$names = array();
		$i = 0;
		while ($i < $trial) {
			$name = '';
			for ($j = 0; $j < 5; $j++) {
				$name .= chr(rand(97, 122));
			}
			$name .= rand(0, 99);
			array_push($names, $name);
			$i++;
		}
		return $names;
	}
}