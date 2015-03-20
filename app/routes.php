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
		Route::post('dashboard/auto/servicio/agregar',
			array(
				'as'=>'agregar-servicio-post',
				'uses'=>'AutoController@postAgregarServicio'
				)
			);
		Route::post('dashboard/auto/kilometraje/agregar',
			array(
				'as'=>'agregar-kilometraje-post',
				'uses'=>'AutoController@postAgregarKilometraje'
				)
			);
		Route::post('dashboard/auto/kilometraje-actual/agregar',
			array(
				'as'=>'agregar-kilometraje-actual-post',
				'uses'=>'AutoController@postAgregarKilometrajeatual'
				)
			);
		});
		//historial
		Route::get('/dashboard/auto/selected/historial/{id}',
			array(
				'as'=>'Historial',
				'uses'=>'AutoController@getHistorial'
				)
			);
		//Redirecciona a seleccion de vehiculo
		Route::get('redireccion/auto',
			array(
				'as'=>'redirect-selected',
				'uses'=>'Autocontroller@backtoAutoSelected'
				)
			);
			//Redireccionamiento hasta el panel principal
		Route::get('/redirecciona',
			array(
				'as'=>'mainPanel',
				'uses'=>'AutoController@Backtomain'
				)
			);
			//Pagina principal despues de loguear
			Route::get('/dashboard',
				array(
				'as'=>'principal',
				'uses'=>'AutoController@mainpanel'
				)
			);
			//Cerrar sesion
			Route::get('/dashboard/cerrar',
				array(
				'as'=>'cerrar-sesion',
				'uses'=>'UsuarioController@getCerrar'
				)
			);
			//Registro de un vehiculo
			Route::get('/dashboard/auto/crear',
				array(
				'as'=>'crear-auto',
				'uses'=>'AutoController@getCrear'
				)
			);
			//cuando se ha creado el auto...
			Route::post('/dashboard/auto/creado',
				array(
				'as'=>'crear-auto-post',
				'uses'=>'AutoController@postCrear'
				)
			);
			//Borrar el auto
			route::post('/dashboard/auto/borrar',
				array(
					'as'=>'eliminar_auto',
					'uses'=>'AutoController@postEliminarAuto'
				)
			);
			//cambiar contraseña
			Route::get('/usuario/contraseña',
				array(
			'as'=>'cambio-password',
			'uses'=>'UsuarioController@getCambiaClave'
				)
			);
			//para solicitar por comunicando con script.
			//los modelos por marca
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
			//para agregar los servicios a un automovil
			Route::get('/dashboard/auto/selected/servicio/{id}',
			array(
				'as'=>'agregar-servicio-get',
				'uses'=>'AutoController@getServicioAgregar'
				)
			);
			//Agregar un kilometraje
			Route::get('dashboard/auto/selected/kilometraje/{id}',
				array(
					'as'=>'agregar-kilometraje',
					'uses'=>'AutoController@getKilometrajeAgregar'
				)
			);
			//Agregar kilometraje actual
			Route::get('dashboard/auto/selected/kilometraje-actual/{id}',
				array(
					'as'=>'agregar-kilometraje-actual',
					'uses'=>'AutoController@getAgregakm'
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
		//post para loguear
		Route::post('/inicio', array(
			'as'=>'login-post',
			'uses'=>'UsuarioController@postLoguear'
		));
		//post para enviar mensaje de recuperar contraseña
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
		//validar codigo de recuperar para cuentas
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
	//ruta para validar el codigo para actvar cuenta
	Route::get('/usuario/activar/{codigo}',array(
		'as'=>'usuario-activar',
		'uses'=>'UsuarioController@getActivar'

	));
});

