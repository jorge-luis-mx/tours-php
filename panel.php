<?php

session_start();

if (!isset($_SESSION['user'])) {

  header('location:index.php');
}
?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

  <title>Tours de jorge Luis gomez</title>
</head>

<body>

  <div class="container">
    <div class="row mt-4">
      <div class="col-md-12">
        <h2 class="text-center mb-5">TRANSPORTACION TURISTICA</h2>
        <form id="tours" class="border p-4">
          <div class="row">
            <div class="col-md-6 mb-3">
              <select id="destino" name="destino" class="form-select" aria-label="Default select example">
                <option value="cancun">Cancun</option>
                <option value="playa del carmen">Playa del Carmen</option>
                <option value="tulum">Tulum</option>
              </select>
            </div>
            <div class="row">
              <div class="col-md-4">
                <button type="button" class="btn btn-primary" onclick='send("ok");'>Buscar</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog  modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row mb-4">
              <div class="col-md-12 d-flex justify-content-end">
                <form id="form_calcular">
                  <div class="card" style="width: 18rem;">
                    <ul id="detalle" class="list-group list-group-flush"></ul>
                        <div id="total" class="card-footer">
                    </div>
                    <div class="input-group">
                      <button class="btn btn-outline-secondary" type="button" onclick="restaDSP()">-</button>
                        <input type="text" name="diaSP" id="diaSP" value="1" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-md">
                      <button class="btn btn-outline-secondary" type="button" onclick="sumaDSP()">+</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="row border-1 m-2">
              <form id="saveForm">
                <div class="col-md-12 border p-3">
                  <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" id="name" name="name" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="name@example.com">
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick='saveForm("ok");'>Reservar Hotel</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>


    <div class="card mt-4">
      <div class="card-header">
        Promociones de Hoteles
      </div>
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Nombre</th>
              <th scope="col">Hotel</th>
              <th scope="col">Precio</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody id="tabla_hoteles">
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
    integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT"
    crossorigin="anonymous"></script>
  <script src="js/send.js"></script>
  <!-- <script src="js/modal_succes"></script> -->
  <script>

  $(document).ready(function(){
    send()
    
  });
  </script>
</body>

</html>