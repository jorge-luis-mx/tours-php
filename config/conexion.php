<?php

class Conexion {


   function conectar(){

      $con = new mysqli('www.decocancun.com','decoc642_hora23z','zd45jklmpg19e','decoc642_horasextras');
      if ($con->connect_errno) {
         echo "Fallo al conectar a MySQL: (" . $con->connect_errno . ") " . $con->connect_error;
      }
      $con->set_charset('utf8');

      return $con;

   }
 


}