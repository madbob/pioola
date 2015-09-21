<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderMoreDiscounts extends Migration
{
	public function up()
	{
		Schema::table('orders', function(Blueprint $table)
		{
			$table->integer('ticket_quantity');
		});
	}

	public function down()
	{
		Schema::table('orders', function(Blueprint $table)
		{
			$table->dropColumn(['ticket_quantity']);
		});
	}
}
