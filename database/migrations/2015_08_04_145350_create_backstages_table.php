<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBackstagesTable extends Migration
{
	public function up()
	{
		Schema::create('backstages', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->integer('quantity');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('backstages');
	}
}
