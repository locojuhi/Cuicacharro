<?php

class ModelosController extends BaseController {
	public function getModeloxMarca(){
		$marca=Input::get('marca');
		$modelo=Modelo::whereIdMarca($marca)->get(array('id', 'nombre'));
		View::share('modelos', $modelo);
		return $modelo;
	}
}