<?php

if ($_SERVER["REQUEST_METHOD"]=="POST") {

   $validacion["name"] 			    = array("etiqueta" =>"name", 		"validacion" => "letras");
   
   $errors = array();
   $limpios = array();

   foreach ($validacion as $input => $value) {
   
      if (isset($_POST[$input])) {
         if( $_POST[$input] =="") {
            $errors[$input] = "The ".$value["etiqueta"]." field is required *";
   
         }
         switch ($value["validacion"]) {
   
            case 'letras':
            
            if (isset($errors[$input]) && $errors[$input]!='') {}else{
   
                  if(preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/",$_POST[$input])) {
   
                  $nombre = $_POST[$input];
                  $limpios[$input] = $nombre;
   
               }else{
                  $errors[$input] = $value["etiqueta"]." is incorrect *";
               }
   
            }
            break;

   
            default:
               $texto = limpiarString($_POST[$input]);
               $limpios[$input] = $texto;
            break;
         }
      }
      else{
   
         $errors[$input] = "El campo ".$value["etiqueta"]." no esta en el Post.";
      }
   }





   if (count($errors)==0 && isset($_POST['save'])&& $_POST['save']=="ok") {

      $data['id_productos']=$_POST['id'];
      $data['name']=        $limpios['name'];
      $data['email']=       $_POST['email'];
      $data['total']=       $_POST['total'];


      $data_to_file_json = json_encode($data,JSON_UNESCAPED_UNICODE);

      $fp = fopen('results.json', 'w+');
      fwrite($fp, $data_to_file_json);
      fclose($fp);


      $resultado["status"]="success";
		$resultado["mesage"]="Se guardo correctamente";
		$resultado['ResExitoso']= $limpios;

   }

   echo json_encode($resultado);


   function limpiarString($string){
   
      $string = trim($string); // Elimina espacios antes y después de los string
      $string = stripslashes($string); // Elimina backslashes \
      $string = htmlspecialchars($string); // Traduce caracteres especiales en entidades HTML
      return $string;
   }

}


?>