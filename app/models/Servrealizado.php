<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Servrealizado extends Eloquent implements UserInterface, RemindableInterface {

	protected $fillable	=	array('id_servicios','id_auto','id_kilometraje');
	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'serv_realizados';
	public function proximoserv()
    {
        return $this->hasMany('id_servicio', 'kilometro', 'fecha', 'status');
    }

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	protected $guarded = [];

}