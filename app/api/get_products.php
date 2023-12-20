<?php
require_once "utils.php";
require_once "db.php";

try {
	if ( $_SERVER["REQUEST_METHOD"] == "GET" ) {

		$resp = getProductsDB();

		if(is_null($resp))
			echo getResponse(500,"KO","Error interno de base de datos");
		else
			echo getResponse(200,"OK", "Productos obtenidos correctamente", $resp);

	} else {
	 	echo getResponse(400,"KO_REQUEST","Tipo de petición incorrecta");
	}

} catch(Exception $e) {
	echo getResponse(500,"KO","Error interno");
}