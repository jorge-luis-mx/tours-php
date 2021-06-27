<?php
include_once '../models/User.php';
include_once '../config/config.php';


$objCon 	= new Config();
$objUser 	= new User($objCon);

$validacion["textUsers"]= array("etiqueta" =>"usuario", "validacion" => "letras_numeros_espacios", 	"obligatorio" => "1" );
$validacion["textPassword"]= array("etiqueta" =>"contraseña","validacion" => "letras_numeros_espacios", "obligatorio" => "1" );

$validar = $objCon->clean_and_validate($validacion,$_POST);

$errors = $validar["errors"];
$limpios = $validar["data_ok"];

if (count($errors)==0) {

	$datos = $objUser->loginUser($limpios['textUsers'],$limpios['textPassword']);

	if ($datos["success"]==1) {
		$resutado["success"]=1;
		$resutado["message"]="Autorizado";
	}else{
		$resutado["success"]=0;
		$resutado["message"]="Datos incorrectos";
	}

}else{
	$resutado["success"]=0;
	$resutado["message"]="Erorr en los datos";
	$resutado["errors"]=$errors;
}

$resutado = json_encode($resutado);
die($resutado);

?>