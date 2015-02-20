<?php 

class Tiempostableseeder extends Seeder {

    public function run()
    {
        DB::table('tiempos')->delete();

        Tiempo::create(
	    	array(
	    		'kms'=> '5000',
	    		'periodo'=>'90'
	    	)

        );

        Tiempo::create(
	    	array(
	    		'kms'=> '10000',
	    		'periodo'=>'180'
	    	)

        );

        Tiempo::create(
	    	array(
	    		'kms'=> '20000',
	    		'periodo'=>'365'
	    	)

        );

        Tiempo::create(
	    	array(
	    		'kms'=> '50000',
	    		'periodo'=>'1080'
	    	)

        );
    }
}