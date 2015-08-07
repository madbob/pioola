<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderRowsTable extends Migration
{
	public function up()
	{
		Schema::create('order_rows', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('order_id');
			$table->integer('dish_id');
			$table->integer('quantity');
			$table->decimal('price', 5, 2);
			$table->text('notes');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('order_rows');
	}
}
