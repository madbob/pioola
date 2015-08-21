<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombosTable extends Migration
{
	public function up()
	{
		Schema::create('combos', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->integer('area_id');
			$table->decimal('price', 5, 2);
			$table->timestamps();
		});

		Schema::create('category_combo', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('combo_id');
			$table->integer('category_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('combos');
		Schema::drop('category_combo');
	}
}
