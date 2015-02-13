<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Usuarios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuarios', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('usuario')->unique();
			$table->string('email')->unique();
			$table->string('password');
			$table->string('contraseña_temp')->nullable();
			$table->string('codigo')->nullable();
			$table->integer('status')->unsigned();
			$table->string('remember_token')->nullable();	
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
		Schema::drop('usuarios');
	}

}
