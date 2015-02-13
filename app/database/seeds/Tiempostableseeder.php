<?php 

class Tiempostableseeder extends Seeder {

    public function run()
    {
        DB::table('tiempos')->delete();

        Tiempo::create(
	    	array(
	    		'kms'=> '5000',
	    		'periodo'=>'3'
	    	)

        );

        Tiempo::create(
	    	array(
	    		'kms'=> '10000',
	    		'periodo'=>'6'
	    	)

        );

        Tiempo::create(
	    	array(
	    		'kms'=> '20000',
	    		'periodo'=>'12'
	    	)

        );

        Tiempo::create(
	    	array(
	    		'kms'=> '50000',
	    		'periodo'=>'36'
	    	)

        );
    }
}