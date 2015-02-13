<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		$this->call('UsuariosSeeder');
		$this->call('Tiempostableseeder');
		$this->call('Serviciostableseeder');
		$this->call('Marcastableseeder');
		$this->call('Modelostableseeder');
		
		
		

	}

}
