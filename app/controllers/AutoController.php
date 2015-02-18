<?php

class AutoController extends BaseController {
	//Este es para entrar en la ventana principal del usuario
	public function mainpanel(){
		//$usuario=Usuario::find(Auth::user()->id);	
		//$usuario = Auto::all();
		//$autos = DB::table('autos')->where('id_usuario', Auth::user()->id)->lists('placa');
		View::share('auto', Auto::where('id_usuario','=', Auth::user()->id)->get(array('placa','id')));
		return View::make('mainpanel');
		
		
	}
	//Esto abre la vista para añadir un auto a la lista.
	public function getCrear(){
		//Esto es equivalente a "Select nombre from marcas order by id"
		//$marcas = DB::table('marcas')->lists('nombre', 'id');
		View::share('marcas', Marca::get(array('nombre','id')));
		return View::make('account.auto');
		
	}

	public function postCrear(){
		//Reglas para validar
		$validador = Validator::make(Input::all(),
			array(

				'placa'=>'required',
				'modelo'=>'required',
				'kilometraje'=>'required'
			)
		);
		//Si falla en las reglas, redirecciona de nuevo al formulario
		//con todas las varibles puesta para volver a intentarlo
		if($validador->fails()){
			return Redirect::route('crear-auto')
				->withErrors($validador)
				->withInput();
				print_r($validador);
		//de lo contrario, pasara a introducir los valores en la base de datos
		}else{
			$usuario 		=	Auth::id();
			$placa			=	Input::get('placa');
			$marca 			=	Input::get('marca');
			$modelo			=	Input::get('modelo');
			$kilometraje	=	Input::get('kilometraje');

			$autocrear = Auto::create(array(
				'id_usuario'=> $usuario,
				'placa'	=>	$placa,
				'id_marca'=>$marca,
				'id_modelo'=>$modelo
				)
			);
			if($autocrear){
				$autokilometro	=	DB::table('autos')
								->select('id')
								->orderBy('id','desc')
								->first();
				foreach($autokilometro as $auto)
					{
					   echo $auto['id'];
					}
					
				Kilometraje::create(array(
					'id_auto'=> $auto,
					'kilometro'=>$kilometraje
					)
				);
				return Redirect::route('principal');
			}else{
				return Redirect::route('principal')->with('global','No se pudo agregar un vehiculo, intentelo de nuevo mas tarde');
			}
		}return Redirect::route('principal')->with('global','Por favor intente agergar un vehiculo mas tarde... Gracias!');
	
	}


}