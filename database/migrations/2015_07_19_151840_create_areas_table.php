<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreasTable extends Migration
{
	public function up()
	{
		Schema::create('areas', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->integer('current_index');
			$table->boolean('trasversal');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('areas');
	}
}
