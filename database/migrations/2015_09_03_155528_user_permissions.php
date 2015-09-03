<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserPermissions extends Migration
{
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->integer('area_id');
		});
	}

	public function down()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->dropColumn(['area_id']);
		});
	}
}
