<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDishesTable extends Migration
{
	public function up()
	{
		Schema::create('dishes', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('category_id');
			$table->string('name');
			$table->decimal('price', 5, 2);
			$table->integer('quantity');
			$table->integer('sorted');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('dishes');
	}
}
