<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::group(array('before' => 'auth'), function(){

		//crsf proteccion
		Route::group(array('before'=>'csrf'), function(){
			Route::post('/usuario/contraseña',
				array(
			'as'=>'cambio-password-post',
			'uses'=>'UsuarioController@postCambiaClave'
				)
			);
		});
			Route::get('/dashboard', 
				array(
				'as'=>'principal',
				'uses'=>'AutoController@mainpanel'
				)
			);
			Route::get('/dashboard/cerrar', 
				array(
				'as'=>'cerrar-sesion',
				'uses'=>'UsuarioController@getCerrar'
				)
			);
			Route::get('/dashboard/auto/crear', 
				array(
				'as'=>'crear-auto',
				'uses'=>'AutoController@getCrear'
				)		
			);
			Route::post('/dashboard/auto/creado', 
				array(
				'as'=>'crear-auto-post',
				'uses'=>'AutoController@postCrear'
				)
			);
			//password change
			Route::get('/usuario/contraseña',
				array(
			'as'=>'cambio-password',
			'uses'=>'UsuarioController@getCambiaClave'
				)
			);
			Route::get('/dashboard/auto/modelo',
				array(
					'as'=>'seleccione-modelo',
					'uses'=>'ModelosController@getModeloxMarca'
				)
			);
			//route para meterse a una pagina cuando se selecciona un auto
			Route::get('/dashboard/auto/selected/{id}',
				array(
					'as'=>'seleccion-carro',
					'uses'=>'AutoController@getAutoSelected'
				)
			);	
		});		
//Grupo no identificado
Route::group(array('before'=>'guest'), function(){
	//Protecion del grupo CSRF
	Route::group(array('before'=>'csrf'), function(){
		//crear una cuenta post
		Route::post('/usuario/crear', array(
		'as'=>'usuario-crear-post',
		'uses'=>'UsuarioController@postCreate'

		));
		Route::post('/inicio', array(
			'as'=>'login-post',
			'uses'=>'UsuarioController@postLoguear'
		));

		Route::post('/usuario/recuperar', array(
			'as'=>'usuario-recuperar-password-post',
			'uses'=>'UsuarioController@postUsuarioRecuperar'
		));
	});
		//recuperar password
		Route::get('/usuario/recuperar', array(
			'as'=>'usuario-recuperar-password',
			'uses'=>'UsuarioController@getUsuarioRecuperar'
		));

		Route::get('/usuario/recuperar/{codigo}', array(
			'as'=>'usuario-recuperar-codigo',
			'uses'=>'UsuarioController@getRecover'
		));
	
		//Loguear get
		Route::get('/', array(
			'as'=>'index-get',
			'uses'=>'UsuarioController@getLoguear'
		));
	//Crear una cuenta (get)
	Route::get('/usuario/crear', array(
		'as'=>'usuario-crear',
		'uses'=>'UsuarioController@getCreate'

	));

	Route::get('/usuario/activar/{codigo}',array(
		'as'=>'usuario-activar',
		'uses'=>'UsuarioController@getActivar'

	));
	Route::get('/hola/{nombre}', function($nombre){
		return $nombre;
	});
});

