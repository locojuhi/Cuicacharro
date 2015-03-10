<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Modelo extends Eloquent implements UserInterface, RemindableInterface {

	protected $fillable	=	array('nombre','id_marca');
	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'modelos';
	
	 public function marcas()
    {
        return $this->belongsTo('Marca');
    }
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	protected $guarded = [];

}