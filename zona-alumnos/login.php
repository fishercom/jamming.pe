<?php
//require 'vendor/autoload.php';
//use GuzzleHttp\Psr7\Request;
//use GuzzleHttp\Client;

session_start();

if(isset($_POST['dni']) && isset($_POST['password'])){
  $dni = $_POST['dni'];
  $password = $_POST['password'];


  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "http://tildagrifo.futureimagick.com/api/Account",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS =>"{\n  \"idStudent\": 0,\n  \"userName\": \"$dni\",\n  \"password\": \"$password\"\n}",
    CURLOPT_HTTPHEADER => array(
      "Content-Type: application/json"
    ),
  ));

  $response = curl_exec($curl);
  curl_close($curl);

  $data = json_decode($response);
  if(isset($data->token)){
      $_SESSION['token']=$data->token;
      $_SESSION['dni']  =$dni;
      header('location: cursos.php');
  }
  $err = 'Los datos ingresados no son válidos!';
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>Jamming · Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet"> 

    <!-- Bootstrap core CSS -->
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body class="bg-login">
  <section class="box-login">
  <div class="container">
    <form class="form-signin" method="post">
        <div class="text-center mb-4">
          <img src="images/logo-jamming.png" class="img-fluid pl-4 pr-4">
        </div>

        <div class="form-label-group">
          <input type="number" name="dni" id="inputEmail" class="form-control" placeholder="DNI" required autofocus>
          <label for="inputEmail">DNI</label>
        </div>

        <div class="form-label-group">
          <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Contraseña" required>
          <label for="inputPassword">Contraseña</label>
        </div>

        <div class="checkbox mb-3">
          <label class="text-white">
            <input type="checkbox" name="remember" value="remember-me"> ¿Olvidastes la contraseña?
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Acceder</button>
        <?php if(isset($err)) echo '<p class="mt-2 mb-3 text-center text-warning">'.$err.'</p>';?>
        <p class="mt-5 mb-3 text-center text-white">&copy; Jamming 2020</p>
    </form>
  </div>
  </section>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
