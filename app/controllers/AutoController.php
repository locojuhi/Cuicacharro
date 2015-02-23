<?php
class AutoController extends BaseController {
	//Este es para entrar en la ventana principal del usuario
	public function mainpanel(){
		View::share('auto', Auto::where('id_usuario','=', Auth::user()->id)->get(array('placa','id')));
		return View::make('mainpanel');	
	}//Para seleccionar trabajar con un auto
	public function getAutoSelected($id){
		//Aqui se consulta a la placa que se ha seleccionado.
		//Compartienedo la variable con la vista.
		View::share('id_auto', Auto::where('id','=', $id)
					->get(array('placa')));
		/*Equivalente a:
		Select id_serviciso, id_auto, id_kilometraje form ser_realizados.*/
		$serviciosrea = Servrealizado::where('id_auto','=', $id)
					->get(array('id_servicios', 'id_kilometraje'));
		//Inicializo las variables para el forEach
		$idServicio=null;
		$idKm=null;
		//inicio el forEach para extraer los valores del arreglo de datos.
		foreach ($serviciosrea as $servicio) {
			$idServicio=$servicio->id_servicios;
			$idKm=$servicio->id_kilometraje;
		}
		//Servicio
		/*$service = Servicio::where('id','=',$idServicio)
				->get(array('nombre','tiempo_id'));
		//Foreach para separar los elementos de los servicios
			$servic=null;
			$tempo=null;
			foreach ($service as $serv) {
				$servic=$serv->nombre;
				$tempo=$serv->tiempo_id;
			}
		//tiempo que debe transcurrir antes de volver a hacer el servicio
		$tiempo=Tiempo::where('id','=',$tempo)
				->get(array('periodo'));
		//auto
		$id;
		//kilometraje
		$km = Kilometraje::where('id','=',$idKm)
			->get(array('kilometro','created_at'));
			$kmd=null;
			$fecha=null;
			foreach ($km as $kms) {	
				$kmd=$kms->kilometro;
				$fecha=$kms->created_at;
			}
*/
		//Compartiendo la variable con la vista.
		View::share('id_servicio', $idServicio);
		View::share('id_km', $idKm);
		return View::make('account.autoselected');
	}
	//Esto abre la vista para añadir un auto a la lista.
	public function getCrear(){
		//Esto es equivalente a "Select nombre from marcas order by id"
		//$marcas = DB::table('marcas')->lists('nombre', 'id');
		View::share('marcas', Marca::get(array('nombre','id')));
		return View::make('account.auto');
	}
	public function getServicioAgregar(){
		return View::make('account.agregaservice');
		
	}
	//para abrir el formulario para agregar un nuevo kilometraje
	public function getKilometrajeAgregar(){
		return View::make('account.agregarkilometro');
	}
	//post para añadir un servicio nuevo a un automovil
	public function postAgregarServicio($id){
		$validador= Validator::make(Input::all(),
			array(
				'servicio'		=>'required',
				'fecha'			=>'required',
				'kilometraje'	=>'required'
				)
			);
		if($validador->fais()){
			return Redirect::route('agregar-servicio')
					->withErrors($validador)
					->witInput();
					print_r($validador);
		}else{
			$id_auto		=	$id;
			$servicio 		=	'servicio';
			$fecha			=	'fecha';
			$kilometraje 	=	'kilometraje';
		}

	}
	//para crear un auto nuevo en cada cuenta de usuario.
	public function postCrear(){
		//Reglas para validar.
		$validador = Validator::make(Input::all(),
			array(
				'placa'=>'required',
				'modelo'=>'required',
				'kilometraje'=>'required'
			)
		);
		//Si falla en las reglas, redirecciona de nuevo al formulario
		//con todas las varibles puesta para volver a intentarlo.
		if($validador->fails()){
			return Redirect::route('crear-auto')
				->withErrors($validador)
				->withInput();
				print_r($validador);
		//de lo contrario, pasara a introducir los valores en la base de datos.
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