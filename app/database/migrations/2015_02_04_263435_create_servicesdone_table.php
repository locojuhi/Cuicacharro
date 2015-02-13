<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesdoneTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('serv_realizados', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_servicios')->unsigned();
			$table->foreign('id_servicios')->references('id')->on('servicios');
			$table->integer('id_auto')->unsigned();
			$table->foreign('id_auto')->references('id')->on('autos');
			$table->integer('id_kilometraje')->unsigned();
			$table->foreign('id_kilometraje')->references('id')->on('kilometrajes');
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
		Schema::drop('serv_realizados');
	}

}
