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
$id=$_POST['id'];

foreach ($someArray  as $key => $value) {
   if ($id==$value['id']) {
      $destinos[] = $value;
   }

}


echo json_encode($destinos);

}