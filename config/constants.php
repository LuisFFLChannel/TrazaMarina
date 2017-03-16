<?php

return [

	//Status del regalo

	'gift_upNext'          	=> 1,
	'gift_available'       	=> 2,
	'gift_soldOut'         	=> 3,

	//Tipo de documento de identidad
 
	'national'		    	=>1,
	'international'   		=>2,
	'passport'		   		=>3,
	
	//Tipo de usuario

	'client'          		=> 1,
	'salesman'        		=> 2,
	'promoter'        		=> 3,
	'admin'	          		=> 4,
	'usuarioPesca'    		=> 5,
	'usuarioIntermediario'	=> 6,
	'usuarioValidacion' 	=> 7,
	'clientMaster' 	=> 8,

   	//Status de los asientos 
   	'seat_available' => 1,
   	'seat_reserved'  => 2, 
   	'seat_taken'	 => 3,    


   	//Tipo de promocion
   	'discount' => 1,
	'ofert' => 2,

	//Tipo de pago
	'credit'	=> 1,
	'cash'		=> 2,
	'mix'		=> 3,

	//Tipo de local
	'numbered'				=> 1,
	'notNumbered'			=> 2,
	'notEditable'			=> 0,

	//Tipo de Asistencia Vendedor
	'in'	=> 1,
	'out'	=> 2,

	//Cantidad de eventos destacados
	'maxDestacados' => 5,

	//Tipo de cambio activo
	'active'		=> 1,

];