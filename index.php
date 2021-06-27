<?php
   session_start();

   if (isset($_SESSION['user'])) {

      header('location:panel.php');
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
   <title>Document</title>
</head>
<body>
      <div class="d-flex justify-content-center mt-4">
         <form id="loginForm">
            <div class="mb-3">
               <label for="exampleInputEmail1" class="form-label">Correo</label>
               <input type="text" class="form-control" id="textUsers" name="textUsers" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
               <label for="exampleInputPassword1" class="form-label">Password</label>
               <input type="password" class="form-control" id="textPassword" name="textPassword">
            </div>
            <button type="button" class="btn btn-primary" onclick="login(event)">Enviar</button>
         </form>
      </div>

   <script src="js/jquery-3.3.1.min.js"></script>
   <script src="js/ajaxlogin.js"></script>

   <script>
      textUsers.focus();
   </script>
</body>
</html>