<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigsTable extends Migration
{
	public function up()
	{
		Schema::create('configs', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('value');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('configs');
	}
}
