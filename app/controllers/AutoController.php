<?php
class AutoController extends BaseController {

	public function postEliminarAuto(){
		$id_auto = Input::get('id_auto');
		$x = Auto::find($id_auto);
		$kilometraje = Kilometraje::where('id_auto', '=', $id_auto)->lists('id');
		$serv = Servrealizado::where('id_auto', '=', $id_auto)->lists('id');
		if($x){
			if($serv){
		Servrealizado::destroy($serv);	
			}
		Kilometraje::destroy($kilometraje);
		$x->delete();
		return Redirect::route('principal')
		->with('global', 'Se ha eliminado el auto de la lista satisfactoriamente');
		}
	}
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
		View::share('id_carro', $id);
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
	public function getServicioAgregar($id){
		$validador=Auto::where('id','=',$id)->where('id_usuario','=', Auth::user()->id)->get(array('id','id_usuario'));
		$idauto=null;
		$idusuario=null;
		foreach($validador as $auto)
					{
					   $idauto=$auto['id'];
					    $idusuario=$auto['id_usuario'];
					}


		if($idauto==$id && $idusuario==Auth::user()->id){
		return View::make('account.agregaservice');
		}else{return 'este auto no te pertenece.';}
			
	}
	//para abrir el formulario para agregar un nuevo kilometraje
	public function getKilometrajeAgregar($id){
		$validador=Auto::where('id','=',$id)->where('id_usuario','=', Auth::user()->id)->get(array('id','id_usuario'));
		$idauto=null;
		$idusuario=null;
		foreach($validador as $auto)
					{
					   $idauto=$auto['id'];
					    $idusuario=$auto['id_usuario'];
					}


		if($idauto==$id && $idusuario==Auth::user()->id){
			View::share('id_auto',$id);
		return View::make('account.agregarkilometro');
		}else{return 'este auto no te pertenece.';}
	}
	//Agregar kilometraje para ese dias
	public function getAgregakm(){

	}
	//Agrega un kilometraje de cualquier fecha
	public function postAgregarKilometraje(){
		$validador = Validator::make(Input::all(),
			array(
				'kilometraje'=>'required',
				'fecha'=>'required|date'
			)
		);
		if($validador->fails()){
			return Redirect::route('agregar-kilometraje')
					->withErrors($validador)
					->witInput();
					print_r($validador);
		}else{
			$id_auto = Input::get('id_auto');
			$kilometraje = Input::get('kilometraje');
			$fecha = Input::get('fecha');
			$kilometrajecrear = Kilometraje::create(array(
				'id_auto'	=>	$id_auto,
				'kilometro'=> $kilometraje,
				'created_at'=> $fecha
				)
			);
			return array($fecha, $kilometraje, $id_auto);
		}
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
				'placa'=>'required|min:3',
				'modelo'=>'required',
				'kilometraje'=>'required|numeric|min:1'
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
					'kilometro'=>$kilometraje,
					
					)
				);
				return Redirect::route('principal');
			}else{
				return Redirect::route('principal')->with('global','No se pudo agregar un vehiculo, intentelo de nuevo mas tarde');
			}
		}return Redirect::route('principal')->with('global','Por favor intente agergar un vehiculo mas tarde... Gracias!');
	}
}