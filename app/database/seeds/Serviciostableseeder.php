<?php 

class Serviciostableseeder extends Seeder {

    public function run()
    {
        DB::table('servicios')->delete();

        Servicio::create(
	    	array(
	    		'nombre'=>'Cambio de aceite de motor y filtro',
	    		'tiempo_id'=>'1'
	    	)

        );

		        
		Servicio::create(
	    	array(
	    		'nombre'=>'Limpieza de bornes de bateria',
	    		'tiempo_id'=>'1'
	    	)

        );

        Servicio::create(
	    	array(
	    		'nombre'=>'Limpieza de filtro de aire',
	    		'tiempo_id'=>'1'
	    	)

        );
        
		Servicio::create(
	    	array(
	    		'nombre'=>'Revision de aceite hidraulico',
	    		'tiempo_id'=>'2'
	    	)

        );
        
		Servicio::create(
	    	array(
	    		'nombre'=>'Revision de frenos',
	    		'tiempo_id'=>'2'
	    	)

        );
        
		Servicio::create(
	    	array(
	    		'nombre'=>'Alineacion y balanceo de neumaticos',
	    		'tiempo_id'=>'2'
	    	)

        );
        
		Servicio::create(
	    	array(
	    		'nombre'=>'Ajustes de liquido de frenos',
	    		'tiempo_id'=>'2'
	    	)

        );

        Servicio::create(
	    	array(
	    		'nombre'=>'Cambio de filtro de aire',
	    		'tiempo_id'=>'3'
	    	)

        );

		Servicio::create(
	    	array(
	    		'nombre'=>'Cambio de bujias',
	    		'tiempo_id'=>'3'
	    	)

        );
        
		Servicio::create(
	    	array(
	    		'nombre'=>'Limpieza de inyectores',
	    		'tiempo_id'=>'3'
	    	)

        );
        
		Servicio::create(
	    	array(
	    		'nombre'=>'Nivelacion de bateria',
	    		'tiempo_id'=>'3'
	    	)

        );
        
		Servicio::create(
	    	array(
	    		'nombre'=>'Revision de luces y cambio de bombillas',
	    		'tiempo_id'=>'3'
	    	)

        );
        
		Servicio::create(
	    	array(
	    		'nombre'=>'Revision de amortiguadores',
	    		'tiempo_id'=>'3'
	    	)

        );
        
		Servicio::create(
	    	array(
	    		'nombre'=>'Cambio de bomba de agua',
	    		'tiempo_id'=>'4'
	    	)

        );
        
		Servicio::create(
	    	array(
	    		'nombre'=>'Cambio de filtro de gasolina',
	    		'tiempo_id'=>'4'
	    	)

        );
        
		Servicio::create(
	    	array(
	    		'nombre'=>'Revision de suspension',
	    		'tiempo_id'=>'4'
	    	)

        );
        
		Servicio::create(
	    	array(
	    		'nombre'=>'Revision de tren delantero',
	    		'tiempo_id'=>'4'
	    	)

        );
        
		Servicio::create(
	    	array(
	    		'nombre'=>'Cambio de correa del Servicio',
	    		'tiempo_id'=>'4'
	    	)

        );
        
		Servicio::create(
	    	array(
	    		'nombre'=>'Cambio de correo de alternador',
	    		'tiempo_id'=>'4'
	    	)

        );
        
		Servicio::create(
	    	array(
	    		'nombre'=>'Revision y servicio al sistema de clutch',
	    		'tiempo_id'=>'4'
	    	)

        );
        
		

        
    }
}