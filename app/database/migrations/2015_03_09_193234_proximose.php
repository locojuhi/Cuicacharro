<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Proximose extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('proximose', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_servicio')->unsigned();
			$table->foreign('id_servicio')->references('id')->on('serv_realizados');
			$table->integer('kilometro');
			$table->date('fecha');
			$table->integer('status')->default('1');
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
		//
	}

}
