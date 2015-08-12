<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Bican\Roles\Models\Role;

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

		$adminRole = Role::create([
			'name' => 'Admin',
			'slug' => 'admin',
			'description' => '',
		]);

		$admin = User::create([
			'name' => 'Amministratore',
			'password' => Hash::make('cippalippa')
		]);

		$admin->attachRole($adminRole);

		Area::create([
			'name' => 'Comune',
			'trasversal' => true
		]);

		Config::create([
			'name' => 'intro_text',
			'value' => ''
		]);

		Config::create([
			'name' => 'print_theme',
			'value' => 'default'
		]);

		Model::reguard();
	}
}
