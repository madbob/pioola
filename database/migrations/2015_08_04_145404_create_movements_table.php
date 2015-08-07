<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovementsTable extends Migration
{
	public function up()
	{
		Schema::create('movements', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('object_id');
			$table->integer('person_id');
			$table->boolean('added');
			$table->integer('quantity');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('movements');
	}
}
