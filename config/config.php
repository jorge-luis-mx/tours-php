<?php

if (!isset($_SESSION)) session_start();
$user = (isset($_SESSION['user']))? $_SESSION['user'] : array();
define("USUARIO_ACTUAL",$user);

class Config{

    public function db_connect() {
        //$con = new mysqli('localhost','root','','horasextras');
        $con = new mysqli('www.decocancun.com','decoc642_hora23z','zd45jklmpg19e','decoc642_horasextras');
        if ($con->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $con->connect_errno . ") " . $con->connect_error;
        }
        /* change character set to utf8 */
        if (!$con->set_charset("utf8")) {
            echo "Error loading character set utf8: %s\n", $con->error;
            exit();
        }
        return $con;
    }



    public function executeQuery($string){
        $res = array();

        if ($string!="") {
           $con = self::db_connect();

            $stmt = $con->query($string);

             if ($stmt) {
                while ($exec = $stmt->fetch_assoc()) {
                    $res[] = $exec;
                }
            }
        }
        return $res;
    }


    public function clean_and_validate($arrValidation, $_post){

        $errors = array();
        $dataOk = array();
        if (count($arrValidation)>0) {

            //print_r($arrValidation);
            foreach ($arrValidation as $input => $value) {

                $postString = (isset($_post[$input]))? $_post[$input] : "";

                if ($value["obligatorio"] == "1") {
                    if ($postString == ""){
                        $errors[$input] = "El campo " . $value["etiqueta"] . ", es obligatorio.";
                    }
                }


                if (!isset($errors[$input])){
                    switch ($value["validacion"]) {
                        case 'email':
                            if ($postString!="") {
                                if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $postString)) {
                                    $string = self::cleanString($postString);
                                    $dataOk[$input] = $string;
                                } else {
                                    $errors[$input] = "El campo " . $value["etiqueta"] . ", es incorrecto.";
                                }
                            }
                            break;

                        case 'fecha_db':
                            if ($postString!="") {
                                if (preg_match("/^[0-9]{2}(\/|-)[0-9]{2}(\/|-)[0-9]{4}$/",$postString)) {
                                    $postString = self::cambiarFormatFecha($postString,"en","db","","-");
                                    $dataOk[$input] = $postString;
                                } else {
                                    $errors[$input] = "El campo " . $value["etiqueta"] . ", es incorrecto.";
                                }
                            }else{
                                $dataOk[$input] = "";
                            }

                            $dataOk[$input] = $postString;
                            break;
                        case 'fecha_es':
                            if ($postString!="") {
                                if (preg_match("/^[0-9]{2}(\/|-)[0-9]{2}(\/|-)[0-9]{4}$/", $postString)) {
                                    $postString = self::cambiarFormatFecha($postString,"es","db","","-");
                                    $dataOk[$input] = $postString;
                                } else {
                                    $errors[$input] = "El campo " . $value["etiqueta"] . ", es incorrecto.";
                                }
                            }else{
                                $dataOk[$input] = "";
                            }
                            break;

                        case 'numeros':
                            if (is_array($postString) && count($postString)>0){
                                foreach ($postString as $k=>$item){
                                    if (preg_match("/^([0-9])+$/", $item)) {
                                        $dataOk[$input][$k] = $item;
                                    } else {
                                        $errors[$input] = "El campo " . $value["etiqueta"] . ", es incorrecto.";
                                    }
                                }
                            }else{
                                if ($postString!=""){
                                    if (preg_match("/^([0-9])+$/", $postString)) {
                                        $string = self::cleanString($postString);
                                        $dataOk[$input] = $string;
                                    } else {
                                        $errors[$input] = "El campo " . $value["etiqueta"] . ", es incorrecto.";
                                    }
                                }else{
                                    $dataOk[$input] = "";
                                }
                            }

                            break;
                        case 'decimales':
                            if ($postString!="") {
                                if (preg_match("/^([0-9])*(\.)?([0-9]){1,2}$/", $postString)) {
                                    $dataOk[$input] = $postString;
                                } else {
                                    $errors[$input] = "El campo " . $value["etiqueta"] . ", es incorrecto.";
                                }
                            }else{
                                $dataOk[$input] = "";
                            }

                            break;

                        case 'letras_numeros':
                            if ($postString!="") {
                                if (preg_match("/^[a-zA-Z0-9]+$/", $postString)) {
                                    $string = self::cleanString($postString);
                                    $dataOk[$input] = $string;
                                } else {
                                    $errors[$input] = "El campo " . $value["etiqueta"] . ", es incorrecto.";
                                }
                            }else{
                                $dataOk[$input] = "";
                            }
                            break;

                        case 'letras':
                            if ($postString!="") {
                                if (preg_match("/^[A-Za-z]+$/", $postString)) {
                                    $string = self::cleanString($postString);
                                    $dataOk[$input] = $string;
                                } else {
                                    $errors[$input] = "El campo " . $value["etiqueta"] . ", es incorrecto.";
                                }
                            }else{
                                $dataOk[$input] = "";
                            }
                            break;

                        case 'letras_espacios':
                            if ($postString!="") {
                                if (preg_match("/^[A-Za-z áéíóúüñÑÁÉÍÓÚÜ\s]+$/", $postString)) {
                                    $string = self::cleanString($postString);
                                    $dataOk[$input] = $string;
                                } else {
                                    $errors[$input] = "El campo " . $value["etiqueta"] . ", es incorrecto.";
                                }
                            }else{
                                $dataOk[$input] = "";
                            }
                            break;

                        case'horas':

                            if ($postString!="") {
                                if (preg_match("/^([0-1][0-9]|2[0-3])(:)([0-5][0-9])$/", $postString)) {
                                    $dataOk[$input] = $postString;
                                } else {
                                    $errors[$input] = "El campo " . $value["etiqueta"] . ", es incorrecto.";
                                }
                            }else{
                                $dataOk[$input] = "";
                            }

                        break;


                        case 'letras_numeros_espacios':
                            if ($postString!="") {
                                if (preg_match("/^[A-Za-z0-9\s]+$/", $postString)) {
                                    $string = self::cleanString($postString);
                                    $dataOk[$input] = $string;
                                } else {
                                    $errors[$input] = "El campo " . $value["etiqueta"] . ", es incorrecto.";
                                }
                            }else{
                                $dataOk[$input] = "";
                            }

                            break;

                        //Si no cumple ninguna de los casos ejecuta la default y termina.
                        default:
                            $string = self::cleanString($postString);
                            $dataOk[$input] = $string;
                            break;
                    }
                }


            }
        }else{
            $errors[] = "No se recibieron datos.";
        }

        $arrOut = array('data_ok'=>$dataOk,'errors'=>$errors);
        return $arrOut;
    }

    
    public function cleanString($string){
        $string = trim($string); // Elimina espacios antes y después de los string
        $string = addslashes($string);
        #$string = stripslashes($string); // Elimina backslashes \
        #$string = htmlspecialchars($string); // Traduce caracteres especiales en entidades HTML
        #$string = htmlentities($string);
        return $string;
    }
    
    // FUNCIONES GENERAES

    public function tableQuery($table,$status=""){

        $resultado=array();
        if ($table!="") {
            $status = ($status!="")? " WHERE status IN(".$status.")" : "";
            $sqlQuery = self::executeQuery("SELECT * FROM $table $status");

            if (count($sqlQuery)>0) {
                $resultado["success"]=1;
                $resultado["data"]=$sqlQuery;
            }else{
                $resultado["success"]=0;
                $resultado["message"]="No se encontraron datos";
            }
        }else{
            $resultado["success"]=0;
            $resultado["message"]="Tabla Necesaria";
        }     

        return $resultado;
    }

}

 ?>


