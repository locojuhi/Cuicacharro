<?php 

class UsuariosSeeder extends Seeder {

    public function run()
    {
        $this->call('UsuariosTableSeeder');

        $this->command->info('¡Tabla usuarios llenada con exito!');
    }

}


class UsuariosTableSeeder extends Seeder {

    public function run()
    {
        DB::table('usuarios')->delete();
        $password = Hash::make('20944605');

        Usuario::create(array(

                            'usuario' => 'Danny',
                            'email'=>'danny.torresxd@gmail.com',
        					'password'=>$password,
                            'contraseña_temp'=>'',
                            'codigo'=>'',
                            'status'=>'1',
                            'remember_token'=>''

                            ));
    }

}