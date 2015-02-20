<?php
class UsuarioController extends BaseController {
	public function getLoguear(){
		if (Auth::viaRemember())
		{
		return Redirect::auth('/dashboard/cerrar');
		}else{
		return View::make('index');
		}
	}
	public function postLoguear(){
		$validador = Validator::make(Input::all(),
			array(
				'email'=>'required|email',
				'password'=>'required'
			)
		);
		/*Aqui si falla la validacion es devuelto a la pagina de inicio*/
		if($validador->fails()){
			return Redirect::route('index-get')
				->withErrors($validador)
				->withInput();
				print_r($validador);
		/*Por lo contrario si pasa, va a la pagina de inicio (creo que hare un redirect luego para otra pagina)*/
		}else{
			/*Esta es la variable para autenticar si el usuario esta registrado*/
			$pass=Input::get('password');
			$validate = Auth::attempt(
				array(
					'email'=>Input::get('email'),
					'password'=>$pass,
					'status'=>1
				),true
			);
			if($validate){
				/*Reedireccionar al dash board*/
				return Redirect::intended('/dashboard')->with('global','Usuario logueado con exito!');
			}else{
				return Redirect::route('index-get')
				->with('global', 'Usuario no activo o inexistente');
			}
		}
		return Redirect::route('index-get')
		->with('global', 'Ocurrio algun problema al intetar loguear, intente de nuevo mas tarde');
	}
	public function getcerrar(){
		if(Auth::check()){
			Auth::logout();
			return Redirect::route('index-get');
		}
	}
	public function getCreate(){
		return View::make('account.crear');
	}
	public function postCreate(){
		$validador = Validator::make(Input::all(),
			array(
				'usuario'	=>'required| max:16	| min:4|unique:usuarios',
				'email'		=>'required| max:100 | email | unique:usuarios',
				'password'	=>'required| min:6 | max:16',
				'password2'	=>'required| same:password'
			)
		);
		/*Si los datos no han pasado la validacion entonces redirecciona al formulario con todos los datos que se habia introducido anteriormente*/
		if($validador->fails()){
			return Redirect::route('usuario-crear')
				->withErrors($validador)
				->withInput();
		/*Si los campos han pasado la validacion, entonces se procede a hacer el siguiente codigo*/
		}else{
			$usuarios  	=Input::get('usuario');
			$email		=Input::get('email');
			$password 	=Input::get('password');
			//Codigo de activacion string_aleatorio
			$codigo 	= str_random(35);
			//Se encierra en una variable instanciando el modelo y el metodo "create" para insertar en la base de datos
			//Nota: en el modelo deben estar dentro de una variable "$fillable" los datos con los que estaremos habilitados para trabajar
			$creater	= Usuario::create(
				array(
				'usuario'=> $usuarios,
				'email'=> $email,
				'password'=> Hash::make($password),
				'codigo'=> $codigo,
				'status'=> 0
				)
			);
			//si la en la base de datos se ha insertado esto. entonces se procedera a lo que esta dentro del "if"
			if($creater){
				//Aqui comienza el envio del correo
				Mail::send('emails.auth.prueba', array(
					'link'=>URL::route('usuario-activar', $codigo),
					'usuario'=>$usuarios), function($message) use ($creater){
					$message->to($creater->email, $creater->usuario)->subject('Verifique su cuenta por favor');
				});
				//Hasta aqui se envia el correo
				return Redirect::route('index-get')->with('global','Te has registrado satisfactoriamente, Confirma en tu correo la llave de activacion ahora');
			}
		}
	}
	public function getActivar($codigo){
		/*Aqui se crea una variable instanciando el modelo y el metodo "where" para delimitar la busqueda de la base de datos a un usuario en especifico*/
		$uservalid = Usuario::where('codigo','=',$codigo)->where('status','=',0);
		if($uservalid->count()){
			$uservalid=$uservalid->first();
			/*Aqui se designa codigo en null y el campo del status de la cuenta para mque el usuairo pueda activar su cuenta y poder usar la app luego.*/
			$uservalid->status=1;
			$uservalid->codigo='';
			if($uservalid->save()){
				return Redirect::route('index-get')
				->with('global','Tu cuenta ha sido activada satisfactoriamente');
			}
		}
		return Redirect::route('index-get')
		->with('global','No se pudo activar tu cuenta, por favor intentelo mas tarde...');
	}
	public function getUsuarioRecuperar(){
		return View::make('account.usuariorecuperar');
	}
	public function postUsuarioRecuperar(){
		$validator= Validator::make(Input::all(),
			array(
				'email'=>'required | email'
				)
			);
		if($validator->fails()){
			return Redirect::route('usuario-recuperar-password')
			->withErrors($validator)
			->withInput();
		}else{
			$usuario= Usuario::where('email','=', Input::get('email'));
			if($usuario->count()){
				$usuario= $usuario->first();
				//Aqui se genera el nuevo codigo para restaurar la contraseña
				$codigo= str_random(60);
				$password = str_random(10);
				$usuario->codigo = $codigo;
				$usuario->contraseña_temp= Hash::make($password);
				if ($usuario->save()) {
					Mail::send('emails.auth.recovery', array('url'=>URL::route('usuario-recuperar-codigo', $codigo), 'username'=>$usuario->usuario, 'password'=>$password), function($message) use ($usuario){
						$message ->to($usuario->email, $usuario->usuario)->subject('Tu nueva contraseña');
					});
				return Redirect::route('index-get')->with('global','Te hemos enviado un mensaje a tu correo');
				}
			}
		}
		return Redirect::route('usuario-recuperar-password')
		->with('global','No se pudo procesar su peticion, Intente de nuevo mas tarde.');
	}
	//Entra la parte de cambio de clave aqui.
	public function getCambiaClave(){
		return View::make('account.cambiaclave');
	}
	public function postCambiaClave(){
		//el primer parametro es el nombre en el campo del formulario.
		$validator= Validator::make(Input::all(), array(
			'passwordactual'=>'required',
			'password'=>'required|min:6',
			'password2'=>'required|same:password'
			));
		if($validator->fails()){
			Redirect::route('cambio-password')->withErrors($validator);
		}else{
			//cambiar la contraseña
			$usuario= Usuario::find(Auth::user()->id);
			$old_password=Input::get('passwordactual');
			$password=Input::get('password');
			if(Hash::check($old_password, $usuario->getAuthPassword())){
				$usuario->password = Hash::make(Input::get('password'));
				if($usuario->save()){
					return Redirect::route('principal')
					->with('global','¡Tu contraseña ha sido cambiada con exito!');
				}
			}
		}
		return Redirect::route('cambio-password')
				->with('global','No se pudo cambiar tu contraseña en este momento, intentalo mas tarde');
	}
	public function getRecover($codigo){
		$usuario= Usuario::where('codigo', '=', $codigo)
		->where('contraseña_temp','!=', '');
		if($usuario->count()){
			$usuario= $usuario->first();
			$usuario->password = $usuario->contraseña_temp;
			$usuario->contraseña_temp='';
			$usuario->codigo='';
			if($usuario->save()){
				return Redirect::route('index-get')->with('global','Se ha establecido una nueva contraseña temporal para ti.');
			}
		}
	return Redirect::route('index-get')
	->with('global','No se pudo recuperar la contraseña');
	}
}