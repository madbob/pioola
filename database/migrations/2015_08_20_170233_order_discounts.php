<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderDiscounts extends Migration
{
	public function up()
	{
		Schema::table('orders', function(Blueprint $table)
		{
			$table->decimal('total', 5, 2);
			$table->integer('ticket_id');
		});
	}

	public function down()
	{
		Schema::table('orders', function(Blueprint $table)
		{
			$table->dropColumn(['total']);
			$table->dropColumn(['ticket_id']);
		});
	}
}
