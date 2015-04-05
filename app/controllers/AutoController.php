<?php
class AutoController extends BaseController {
	//post para eliminar el auto seleccionado

	public function BacktoMain(){
		return Redirect::action('AutoController@mainpanel');
		/*return Redirect::action('AutoController@getAutoSelected', array($id_auto))
											->with('global','Servicio agregado con exito!!!!');*/
	}
	public function backtoAutoSelected(){
		return Redirect::action('AutoController@getAutoSelected',array($id_auto));
	}

	public function getHistorial($id){
		$reporte = DB::table('serv_realizados')
				->join('servicios','serv_realizados.id_servicios','=','servicios.id')
				->join('kilometrajes','serv_realizados.id_kilometraje','=','kilometrajes.id')
				->where('serv_realizados.id_auto','=', $id)
				->get(array('serv_realizados.fecha', 'servicios.nombre', 'kilometrajes.kilometro'));
		View::share('reporte',$reporte);
		View::share('id_auto',$id);
		return View::make('account.historial');

	}
	public function getReportePdf(){
		$html = "hola mundo";
		return PDF::load($html,'A4','portrait')->show(); 
	}
	public function postEliminarAuto(){
		$id_auto = Input::get('id_auto');
		$x = Auto::find($id_auto);
		$kilometraje = Kilometraje::where('id_auto', '=', $id_auto)->lists('id');
		$serv = Servrealizado::where('id_auto', '=', $id_auto)->lists('id');
		if($x){
			if($serv){
		Servrealizado::destroy($serv);	}
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
		/*Equivalente a:
		Select id_serviciso, id_auto, id_kilometraje form serv_realizados.*/
		$kilometrajeactual = Kilometraje::where('id_auto','=',$id)
										->orderBy('kilometro', 'desc')
										->get(array('kilometro'))
										->first();
		$serviciosrea = Servrealizado::where('id_auto','=', $id)
					->get(array('id_servicios'));
		$proximose = DB::table('proximose')
						->join('serv_realizados','proximose.id_servicio','=','serv_realizados.id')
						->join('servicios','serv_realizados.id','=','servicios.id')
						->select('proximose.id','proximose.kilometro','proximose.fecha','proximose.status','nombre')
						->where('status','=','1')
						->where('id_auto','=',$id)
						->take('10')
						->orderBy('kilometro','asc')
						->orderBy('fecha','asc')
						->get();
		View::share('id_serv_prox',$proximose);
		//Compartiendo la variable con la vista.
		View::share('id_auto', Auto::where('id','=', $id)
					->get(array('placa')));
		View::share('kmactual', $kilometrajeactual);
		View::share('serv_realizado', $serviciosrea);
		View::share('id_carro', $id);
		return View::make('account.autoselected');
	}
	//Esto abre la vista para añadir un auto a la lista.
	public function getCrear(){
		//Esto es equivalente a "Select nombre, id from marcas order by id"
		View::share('marcas', Marca::get(array('nombre','id')));
		return View::make('account.auto');
	}
	//Agregar un servicio realizado
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
			$servicios = DB::table('servicios')->lists('id', 'nombre');
			View::share('servicios', $servicios);
			View::share('id_auto',$id);
			return View::make('account.agregaservice');

		}else{return 'este auto no te pertenece.';}		
	}
	public function postAgregarServicio(){
		$id_auto=Input::get('id_auto');
		$validador = Validator::make(Input::all(),
			array(
				'id'=>'required|exists:servicios',
				'kilometraje'=>'required|numeric',
				'fecha'=>'required|date'
				)
			);
		if($validador->fails()){
			return Redirect::back()
					->withErrors($validador);
					print_r($validator);
		}else{
			$id_servicio = Input::get('id');
			$id_auto = Input::get('id_auto');
			$kilometraje = Input::get('kilometraje');
			$fecha = Input::get('fecha');
			$kilometrajecreate = Kilometraje::create(
				array(
					'id_auto'=>$id_auto,
					'kilometro'=>$kilometraje,
					'fecha'=>$fecha
					)
				);
			if($kilometrajecreate){
				$x=DB::table('kilometrajes')
					->where('id_auto','=',$id_auto)
					->orderBy('id','desc')
					->pluck('id');
				/*return Redirect::back()
					->with('global','Servicio realizado con exito');*/
				$servicioagrega = Servrealizado::create(
					array(
						'id_servicios'=>$id_servicio,
						'id_auto'=>$id_auto,
						'id_kilometraje'=>$x,
						'fecha'=>$fecha
						)
					);
				if ($servicioagrega){
					$id_servicio_rea = Servrealizado::where('id_kilometraje','=', $x)
													->get(array('id'));
					$servicio_id=null;
					foreach ($id_servicio_rea as $key) {
						$servicio_id = $key->id;
					}
					
					$periodo=Servicio::where('id','=',$id_servicio)
							->get(array('tiempo_id'));

					$periodo_id=null;
					foreach ($periodo as $key) {
						$periodo_id = $key->tiempo_id;
					}
					switch ($periodo_id) {
						case 1:
							$kms=5000;
							$kilometraje;
							$fecha;
							$nuevafecha = strtotime ( '+90 day' , strtotime ( $fecha ) ) ;
							$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
							Nextser::create(
								array(
									'id_servicio'=>$servicio_id,
									'kilometro'=>$kilometraje+$kms,
									'fecha'=>$nuevafecha,
									'status'=>'1'
									)
								);
							return Redirect::action('AutoController@getAutoSelected', array($id_auto))
											->with('global','Servicio agregado con exito!!!!');
							break;
						
						case 2:
							$kms=10000;
							$kilometraje;
							$fecha;
							$nuevafecha = strtotime ( '+180 day' , strtotime ( $fecha ) ) ;
							$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
							Nextser::create(
								array(
									'id_servicio'=>$servicio_id,
									'kilometro'=>$kilometraje+$kms,
									'fecha'=>$nuevafecha,
									'status'=>'1'
									)
								);
							return Redirect::action('AutoController@getAutoSelected', array($id_auto))
											->with('global','Servicio agregado con exito!!!!');
							break;

						case 3:
							$kms=20000;
							$kilometraje;
							$fecha;
							$nuevafecha = strtotime ( '+365 day' , strtotime ( $fecha ) ) ;
							$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
							Nextser::create(
								array(
									'id_servicio' => $servicio_id,
									'kilometro' => $kilometraje+$kms,
									'fecha' => $nuevafecha,
									'status' => '1'
									)
								);
							return Redirect::action('AutoController@getAutoSelected', array($id_auto))
											->with('global','Servicio agregado con exito!!!!');
							break;

						case 4:
							$kms=50000;
							$kilometraje;
							$fecha;
							$nuevafecha = strtotime ( '+1080 day' , strtotime ( $fecha ) ) ;
							$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
							Nextser::create(
								array(
									'id_servicio'=>$servicio_id,
									'kilometro'=>$kilometraje+$kms,
									'fecha'=>$nuevafecha,
									'status'=>'1'
									)
								);
							return Redirect::action('AutoController@getAutoSelected', array($id_auto))
											->with('global','Servicio agregado con exito!!!!');
							break;
					}
					return Redirect::action('AutoController@getAutoSelected', array($id_auto))
					->with('global','Servicio agregado con exito!!!!');
				}
			}else{
				return Redirect::back()
					->with('global','No se pudo agregar el servicio');
			}
		}
	}
	//para abrir el formulario para agregar un nuevo kilometraje de cualquier fecha(No utilizado actualmente)
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
		return View::make('account.agregarkilometro');
		}else{return 'este auto no te pertenece.';}
	}
	//Agregar kilometraje actual
	public function getAgregakm($id){
		/*Todas estas lineas de codigo son utilizadas para que el usuario solo pueda acceder a su vehiculo
		y no al de los demas*/
		//aqui se consulta los datos del auto
		$validador=Auto::where('id','=',$id)->where('id_usuario','=', Auth::user()->id)->get(array('id','id_usuario'));
		$idauto=null;
		$idusuario=null;
		//se codifica el arreglo
		foreach($validador as $auto){
			$idauto=$auto['id'];
			$idusuario=$auto['id_usuario'];
		}
		//validacion
		if($idauto==$id && $idusuario==Auth::user()->id){
			View::share('id_auto',$id);
			return View::make('account.agregarkilometroactual');
		}else{
			return 'este auto no te pertenece.';
		}
	}
	public function postAgregarKilometrajeatual(){
		$id_auto=Input::get('id_auto');
		$validador = Validator::make(Input::all(),
			array(
				'kilometraje'=>'required|numeric'
				)
			);
		if($validador->fails()){
			return Redirect::back()
					->withErrors($validador);
					print_r($validator);
		}else{
			$id_auto = Input::get('id_auto');
			$kilometraje = Input::get('kilometraje');
			$fecha = date("Y-m-d"); 
			$kilometrajecrear = Kilometraje::create(array(
				'id_auto'	=>	$id_auto,
				'kilometro'=> $kilometraje,
				'fecha'=> $fecha
				)
			);
			if($kilometrajecrear){
				return Redirect::action('AutoController@getAutoSelected', array($id_auto));
			}
		}
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
					->withInput();
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