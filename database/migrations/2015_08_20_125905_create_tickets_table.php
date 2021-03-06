<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
	public function up()
	{
		Schema::create('tickets', function (Blueprint $table) {
			$table->increments('id');
			$table->decimal('value', 5, 2);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('tickets');
	}
}
