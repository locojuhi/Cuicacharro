<?php

class AutoController extends BaseController {

	public function mainpanel(){
		//$usuario=Usuario::find(Auth::user()->id);	
		$usuario = Auto::all();
		$autos = DB::table('autos')->where('id_usuario', Auth::user()->id)->lists('placa');
		View::share('auto', $autos);
		return View::make('mainpanel');
		
		
	}

	public function getCrear(){
		//Esto es equivalente a "Select nombre from marcas order by id"
		//$marcas = DB::table('marcas')->lists('nombre', 'id');
		View::share('marcas', Marca::get(array('nombre','id')));
		return View::make('account.auto');
		
	}
	



}