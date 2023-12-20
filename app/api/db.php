<?php

//Guardo los datos de conexión de la base de datos en un fichero YML
function getDBConfig() {
    $dbFileConfig=dirname(__FILE__)."/../dbconfiguration.yml";

    $configYML = yaml_parse_file($dbFileConfig);//necesita la extensión php-yaml

	$cad = sprintf("mysql:dbname=%s;host=%s;charset=UTF8", $configYML["dbname"], $configYML["ip"]);

    $result = array(
        "cad" => $cad,
        "user" => $configYML["user"],
        "pass" => $configYML["pass"]
    );

	return $result;
}

function getDBConnection() {
    try {
        $res = getDBConfig();

        $bd = new PDO($res["cad"], $res["user"], $res["pass"]);

        return $bd;
    } catch(PDOException $e) {
        return null;
    }
}

function getProductsDB() {
    try {
    	$bd = getDBConnection();

        if(!is_null($bd)) {
            $sqlPrepared = $bd->prepare("SELECT id,name,description,price from product");
            $sqlPrepared->execute();

            return $sqlPrepared->fetchAll(PDO::FETCH_ASSOC);
        } else
            return $bd;

    } catch (PDOException $e) {
       return null;
    }
}