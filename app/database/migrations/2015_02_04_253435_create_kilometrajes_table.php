<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKilometrajesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('kilometrajes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_auto')->unsigned();
			$table->foreign('id_auto')->references('id')->on('autos');
			$table->integer('kilometro')->unsigned();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('kilometrajes');
	}

}
