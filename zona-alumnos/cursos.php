<?php
session_start();

if(!isset($_SESSION['token']) || !isset($_SESSION['dni'])){
  header('location: login.php');
}

$token = $_SESSION['token'];
$dni = $_SESSION['dni'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://tildagrifo.futureimagick.com/api/Student/$dni",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer $token"
  ),
));

$response = curl_exec($curl);
$data = json_decode($response);

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>Jamming · Certificados</title>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet"> 

    <!-- Bootstrap core CSS -->
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
    <header>
  <div class="navbar navbar-dark fixed-top bg-jamming-header shadow-sm">
    <div class="container d-flex justify-content-between">
      <a href="#" class="navbar-brand d-flex align-items-center">
       <i class="fa fa-user-circle-o mr-2" aria-hidden="true"></i>
        <strong>HOLA, ALEXIS</strong>
      </a>
       <form class="form-inline mt-2 mt-md-0">
        <a class="btn btn-danger my-2 my-sm-0" href="logout"><i class="fa fa-sign-out mr-1" aria-hidden="true"></i>CERRAR SESIÓN</a>
      </form>
    </div>
  </div>
</header>

<main role="main">

  <section class="jumbotron text-center">
    <div class="container">
      <h1 class="text-white">¡Bienvenido!</h1>
      <p class="lead text-white">Mis Cursos</p>
    </div>
  </section>

  <div class="certificados py-5 bg-light">
    <div class="container">
      <div class="row">

      <?php
      foreach($data as $item){
        $courseCode = $item->courseCode;
        $courseName = $item->courseName;
        $allowDownloadPdf=$item->allowDownloadPdf;
        $courseUrlPathImage = $item->courseUrlPathImage;

        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://tildagrifo.futureimagick.com/api/Student/$dni/$courseCode",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $token"
          ),
        ));

        $response = curl_exec($curl);
        $course = json_decode($response);

      ?>
        <div class="col-sm-6 col-md-6 col-lg-4">
          <div class="card mb-4 shadow-sm">
            <img src="<?php echo $courseUrlPathImage?>" class="img-fluid">
            <div class="card-body">
              <p class="card-text"><?php echo $courseName;?></p>
              <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-download mr-2" aria-hidden="true"></i>Ver mi certificado</button>
                </div>
              </div>
              <div class="d-flex justify-content-end mb-3">
              	<small class="text-muted">Enero 14, 2020</small>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>


      </div>
    </div>
  </div>
</main>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
      	 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      	<h4>¡Felicidades, Alexis Acosta!</h4>
      	<p>Has finalizado este curso con éxito</p>
      	<figure><img src="images/certificado-curso-03.jpg" class="img-fluid"></figure>
      	  	<div class="btn-group">
	      	  	<button type="button" class="btn btn-sm btn-outline-secondary"><i class="fa fa-facebook" aria-hidden="true"></i></button>
		    	<button type="button" class="btn btn-sm btn-outline-secondary"><i class="fa fa-twitter" aria-hidden="true"></i></button>
		   		<button type="button" class="btn btn-sm btn-outline-secondary"><i class="fa fa-linkedin" aria-hidden="true"></i></button>
        	</div>
        	<button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-download mr-2" aria-hidden="true"></i>Descarga tu certificado</button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<footer class="text-muted">
  <div class="container">
    <p>&copy; Jamming 2020</p>
  </div>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="assets/dist/js/bootstrap.bundle.min.js"></script>
</html>
<?php
curl_close($curl);
?>