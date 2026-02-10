<?php
$host="localhost";
$user="root";
$password="";
$db="visto_db";

session_start();


$conexao=mysqli_connect($host,$user,$password,$db);

if($conexao===false)
{
	die("connection error");
}

if(!isset($_SESSION["username"]))
{
	header("location:login.php");
}


$imagem = isset($_GET['imagem']) ? $_GET['imagem'] : '';  
$id = isset($_GET['id']) ? $_GET['id'] : '';
$nome = isset($_GET['nome']) ? $_GET['nome'] : '';
$dataNasc = isset($_GET['dataNasc']) ? $_GET['dataNasc'] : '';
$sexo = isset($_GET['sexo']) ? $_GET['sexo'] : '';
$country = isset($_GET['country']) ? $_GET['country'] : '';
$entrada = isset($_GET['entrada']) ? $_GET['entrada'] : '';
$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : '';
$create = isset($_GET['create']) ? $_GET['create'] : '';

if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$id=$_POST["id"];
	$nome=$_POST["nome"];
  $foto=$_POST["foto"];
  $dataNasc=$_POST["data_Nasc"];
  $sexo=$_POST["sexo"];
  $country=$_POST["country"];
  $entrada=$_POST["entrada"];
  $tipo=$_POST["tipo"];
  $dataVal=$_POST["create"];
  $dataExp=$_POST["dataExp"];

$sql="INSERT INTO tbvisto(id, nome, data_Nasc, sexo, country, entrada, tipo, foto, data_create, data_exp) 
VALUES('".null."', '".$nome."', '".$dataNasc."', '".$sexo."', '".$country."', '".$entrada."', '".$tipo."', '".$foto."', '".$dataVal."', '".$dataExp."') ";

$result=mysqli_query($conexao,$sql);

	if(!$result)
	{	
		echo "<script>
            alert('erro ao Registrar ');
            window.location.href='admin.php';
          </script>";

	} else {
    
    header("Location: page.php?id=$id&nome=$nome&dataNasc=$dataNasc&sexo=$sexo&country=$country&entrada=$entrada&tipo=$tipo&foto=$foto&create=$dataVal&dataExp=$dataExp");
		
	}
    
  
}

?>


<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Visto | Angola</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicons/favicon.ico">
    <link rel="manifest" href="../assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="../assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="../assets/css/theme.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />

  </head>


  <body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      <nav class="navbar navbar-expand-lg navbar-light fixed-top py-5 d-block" data-navbar-on-scroll="data-navbar-on-scroll">
        <div class="container"><a class="navbar-brand fsize" href="index.php">AngoVisto</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"> </span></button>
          <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto pt-2 pt-lg-0 font-base align-items-lg-center align-items-start">
              <li class="nav-item px-3 px-xl-4"><a class="nav-link fw-medium" aria-current="page" href="home.php#service">Serviços</a></li>
              <li class="nav-item px-3 px-xl-4"><a class="nav-link fw-medium" aria-current="page" href="home.php#booking">Sobre</a></li>              
              <li class="nav-item px-3 px-xl-4"><a class="nav-link fw-medium" aria-current="page" href="home.php#contacto">Contacto</a></li>
              <li class="nav-item px-3 px-xl-4"><a class="btn btn-outline-dark order-1 order-lg-0 fw-medium" href="../php/logout.php">Log out</a></li>
              <li class="nav-item dropdown px-3 px-lg-0"> <a class="d-inline-block ps-0 py-2 pe-3 text-decoration-none dropdown-toggle fw-medium" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">EN</a>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg" style="border-radius:0.3rem;" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#!">EN</a></li>
                  <li><a class="dropdown-item" href="#!">PT</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      
      
      <!--  Body Wrapper -->
  <div class="page-wrapper mt-5" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body mt-5">
                <h2 class="text-center mt-5 fs-5 text-primary">Criação de Visto</h2>
                <form method="POST" action="#" id="productForm">
                  <div class="form-group mt-3 mb-4">
                    <img src="../img/<?php echo htmlspecialchars($imagem); ?>" height="200" width="200">
                    <input type="hidden" class="form-control" name="foto" value="<?php echo htmlspecialchars($imagem); ?>" readonly> 
                  </div>
                  <div class="form-group mt-2">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control btnOnly" name="nome" value="<?php echo htmlspecialchars($nome); ?>" readonly>
                    <input type="hidden" class="form-control" name="id" value="<?php echo htmlspecialchars($id); ?>" readonly>
                  </div>
                  <div class="form-group mt-3">
                    <label for="dataNasc">Data de Nascimento</label>
                    <input type="text" class="form-control" name="data_Nasc" value="<?php echo htmlspecialchars($dataNasc); ?>"  readonly>
                  </div>
                  <div class="form-group mt-3">
                    <label for="sexo">Sexo</label>
                    <input type="text" class="form-control" name="sexo" value="<?php echo htmlspecialchars($sexo); ?>" readonly>
                  </div>
                  <div class="form-group mt-3">
                    <label for="country">Nacionalidade</label>
                    <input type="text" class="form-control" name="country" value="<?php echo htmlspecialchars($country); ?>" readonly>
                    <input type="hidden" class="form-control" name="entrada" value="<?php echo htmlspecialchars($entrada); ?>" readonly>
                    <input type="hidden" class="form-control" name="tipo" value="<?php echo htmlspecialchars($tipo); ?>" readonly>                  
                  </div>
                  <div class="form-group mt-3"> 
                    <label for="sexo">Data da Criação</label>
                    <input type="text" class="form-control" name="create" value="<?php echo htmlspecialchars($create); ?>" readonly>
                  </div>
                  <div class="form-group mt-3">
                    <label for="sexo">Data de Expiração</label>
                    <input type="date" class="form-control" name="dataExp" required>
                  </div>
                  <div class="modal-footer">
                    <a href="admin.php">
                      <button type="button" class="btn btn-danger">Voltar</button>
                    </a>
                    <button type="submit" class="btn btn-primary">Gerar Passport</button>
                  </div>
              </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section id="contacto" class="pb-0 pb-lg-4">

        <div class="container">
          <div class="row">
            <div class="col-lg-3 col-md-7 col-12 mb-4 mb-md-6 mb-lg-0 order-0 fsize"> AngoVisto
              <p class="fs--1 text-secondary mb-0 fw-medium">Book your trip in minute, get full Control for much longer.</p>
            </div>
            <div class="col-lg-2 col-md-4 mb-4 mb-lg-0 order-lg-1 order-md-2">
              <h4 class="footer-heading-color fw-bold font-sans-serif mb-3 mb-lg-4">Company</h4>
              <ul class="list-unstyled mb-0">
                <li class="mb-2"><a class="link-900 fs-1 fw-medium text-decoration-none" href="#!">About</a></li>
                <li class="mb-2"><a class="link-900 fs-1 fw-medium text-decoration-none" href="#!">Careers</a></li>
                <li class="mb-2"><a class="link-900 fs-1 fw-medium text-decoration-none" href="#!">Mobile</a></li>
              </ul>
            </div>
            <div class="col-lg-2 col-md-4 mb-4 mb-lg-0 order-lg-2 order-md-3">
              <h4 class="footer-heading-color fw-bold font-sans-serif mb-3 mb-lg-4">Contact</h4>
              <ul class="list-unstyled mb-0">
                <li class="mb-2"><a class="link-900 fs-1 fw-medium text-decoration-none" href="#!">Help/FAQ</a></li>
                <li class="mb-2"><a class="link-900 fs-1 fw-medium text-decoration-none" href="#!">Press</a></li>
                <li class="mb-2"><a class="link-900 fs-1 fw-medium text-decoration-none" href="#!">Affiliate</a></li>
              </ul>
            </div>
            <div class="col-lg-2 col-md-4 mb-4 mb-lg-0 order-lg-3 order-md-4">
              <h4 class="footer-heading-color fw-bold font-sans-serif mb-3 mb-lg-4">More</h4>
              <ul class="list-unstyled mb-0">
                <li class="mb-2"><a class="link-900 fs-1 fw-medium text-decoration-none" href="#!">Airlinefees</a></li>
                <li class="mb-2"><a class="link-900 fs-1 fw-medium text-decoration-none" href="#!">Airline</a></li>
                <li class="mb-2"><a class="link-900 fs-1 fw-medium text-decoration-none" href="#!">Low fare tips</a></li>
              </ul>
            </div>
            <div class="col-lg-3 col-md-5 col-12 mb-4 mb-md-6 mb-lg-0 order-lg-4 order-md-1">
              <div class="icon-group mb-4"> <a class="text-decoration-none icon-item shadow-social" id="facebook" href="#!"><i class="fab fa-facebook-f"> </i></a><a class="text-decoration-none icon-item shadow-social" id="instagram" href="#!"><i class="fab fa-instagram"> </i></a><a class="text-decoration-none icon-item shadow-social" id="twitter" href="#!"><i class="fab fa-twitter"> </i></a></div>
              <h4 class="fw-medium font-sans-serif text-secondary mb-3">Discover our app</h4>
              <div class="d-flex align-items-center"> <a href="#!"> <img class="me-2" src="../assets/img/play-store.png" alt="play store" /></a><a href="#!"> <img src="../assets/img/apple-store.png" alt="apple store" /></a></div>
            </div>
          </div>
        </div><!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->


      <div class="py-5 text-center">
        <p class="mb-0 text-secondary fs--1 fw-medium">All rights reserved@angovisto.co.ao </p>
      </div>
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->




    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="../vendors/@popperjs/popper.min.js"></script>
    <script src="../vendors/bootstrap/bootstrap.min.js"></script>
    <script src="../vendors/is/is.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="../vendors/fontawesome/all.min.js"></script>
    <script src="../assets/js/theme.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;family=Volkhov:wght@700&amp;display=swap" rel="stylesheet">
  </body>

</html>