<?php

   $someJSON = '[
      {"name":"sandos"},
      {"name":"pardor"},
      {"name":"Krystal Urban"},
      {"name":"Real Inn Cancún"},
   ]';


   $someArray = json_decode($someJSON, true);
   print_r($someArray);
   die($someArray);
?>