<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('autos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_usuario')->unsigned();
			$table->foreign('id_usuario')->references('id')->on('usuarios');
			$table->string('placa');
			$table->integer('id_marca')->unsigned();
			$table->foreign('id_marca')->references('id')->on('marcas');
			$table->integer('id_modelo')->unsigned();
			$table->foreign('id_modelo')->references('id')->on('modelos');
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
		Schema::drop('autos');
	}

}
