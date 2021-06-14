<?php 

$datoJSON = '[
   {"id":"1","name":"sandos","destino":"cancun","precio":"10"},
   {"id":"2","name":"pardor","destino":"cancun","precio":"10"},
   {"id":"3","name":"Krystal Urban","destino":"cancun","precio":"10"},
   {"id":"4","name":"Real Inn Cancún","destino":"cancun","precio":"10"},
   {"id":"5","name":"Hotel Maya Turquesa","destino":"playa del carmen","precio":"15"},
   {"id":"6","name":"Hard Rock","destino":"playa del carmen","precio":"15"},
   {"id":"7","name":"Posada Mariposa","destino":"playa del carmen","precio":"15"},
   {"id":"8","name":"Sina Suites","destino":"playa del carmen","precio":"15"},
   {"id":"9","name":"Coco Tulum Hotel","destino":"tulum","precio":"20"},
   {"id":"10","name":"Zenses Wellness","destino":"tulum","precio":"20"},
   {"id":"11","name":"Casa Don Diego","destino":"tulum","precio":"20"},
   {"id":"12","name":"Axkan Arte Tulum","destino":"tulum","precio":"20"}
 ]';
$someArray = json_decode($datoJSON, true);
$destinos=array();

if ($_SERVER["REQUEST_METHOD"]=="POST") {

   
   $validacion["destino"] 			    = array("etiqueta" =>"destino", 		"validacion" => "letras");
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

      $destino	= $limpios['destino'];
      
      foreach ($someArray  as $key => $value) {
         if ($destino==$value['destino']) {
            $destinos[] = $value;
         }
      
      }

   }



   echo json_encode($destinos);

   function limpiarString($string){
   
      $string = trim($string); // Elimina espacios antes y después de los string
      $string = stripslashes($string); // Elimina backslashes \
      $string = htmlspecialchars($string); // Traduce caracteres especiales en entidades HTML
      return $string;
   }

}
