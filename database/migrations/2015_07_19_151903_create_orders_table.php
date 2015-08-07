<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
	public function up()
	{
		Schema::create('orders', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('area_id');
			$table->text('notes');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}
