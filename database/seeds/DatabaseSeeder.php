<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Area;
use App\Config;

class DatabaseSeeder extends Seeder
{
	public function run()
	{
		Model::unguard();

		DB::table('users')->delete();
		DB::table('password_resets')->delete();
		DB::table('areas')->delete();
		DB::table('dishes')->delete();
		DB::table('orders')->delete();
		DB::table('categories')->delete();
		DB::table('order_rows')->delete();

		User::create([
			'name' => 'Amministratore',
			'password' => Hash::make('cippalippa')
		]);

		Area::create([
			'name' => 'Comune',
			'trasversal' => true
		]);

		Config::create([
			'name' => 'head_documents',
			'value' => ''
		]);

		Config::create([
			'name' => 'intro_text',
			'value' => ''
		]);

		Config::create([
			'name' => 'print_footer_text',
			'value' => ''
		]);

		Model::reguard();
	}
}
