<?php 
		
	Asi es como se llama a un controlador desde el url por el metodo "get"
	/*
			Route::get('/', array(

			'as'=>'index',
			'uses'=> 'HomeController@index'
		));
	*/
	Asi es que como se envia un correo por laravel (Este ejemplo fue hecho en el controlador, en donde emails.auth.prueba es como la plantilla que se estara enviando por email(correo))
	/*
		Mail::send('emails.auth.prueba', array('name'=>'Danny'), function($message){
			$message->to(Usuario::find(1)->email, 'Danny Torres')->subject('Correo de prueba');

		});
	*/
 ?>