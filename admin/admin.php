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
        <div class="container"><a class="navbar-brand fsize" href="home.php">AngoVisto</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"> </span></button>
          <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto pt-2 pt-lg-0 font-base align-items-lg-center align-items-start">
              <li class="nav-item px-3 px-xl-4"><a class="nav-link fw-medium" aria-current="page" href="home.php#service">Serviços</a></li>
              <li class="nav-item px-3 px-xl-4"><a class="nav-link fw-medium" aria-current="page" href="admin.php">Solicitação</a></li>
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


<section style="padding-top: 10rem;">

  <div class="container pt-5 vh-100" data-aos="fade-up" data-aos-delay="100">
    <h1 class="text-center mb-5" id="addProductBtn">Solicitação de Vistos</h1>
  <div class="d-flex mt-5 w-100">
  
</div>
  <table class="table mt-5">
    <thead>
      <tr>
        <th scope="col">Nº Passport</th>
        <th scope="col">Foto</th>
        <th scope="col">Nome</th>
        <th scope="col">Data Nasc</th>
        <th scope="col">Sexo</th>
        <th scope="col">Nacionalidade</th>
        <th scope="col">Entrada</th>
        <th scope="col">Tipo/Class</th>
        <th scope="col">Data Criação</th>
        <th scope="col">Acção</th>
      </tr>
    </thead>
    <tbody class="table-group-divider">
      <?php
        $sql = "SELECT * FROM tbagenda"; // Substitua 'produtos' pelo nome da sua tabela
                
          $result = mysqli_query($conexao, $sql);

            if ($result->num_rows > 0) {
                while ($linha = $result->fetch_assoc()) {    
                  echo " 
                    <tr>
                      <td>" .$linha['id'] . "</td>
                      <td> <img src='../img/".$linha['foto']." ' width=80 height=80 ></td>
                      <td>" .$linha['nome']. "</td>
                      <td>" .$linha['data_Nasc']. "</td>
                      <td>" .$linha['sexo']. "</td>
                      <td>" .$linha['country']. "</td>
                      <td>" .$linha['entrada']. "</td>
                      <td>" .$linha['tipo']. "</td>
                      <td>" .$linha['data_create']. "</td>
                      <td> 
                        <a href='visto.php?id=".$linha['id']."&
                        imagem=".$linha['foto']."&
                        nome=".$linha['nome']."&
                        dataNasc=".$linha['data_Nasc']."&
                        sexo=".$linha['sexo']."&
                        country=".$linha['country']."&
                        entrada=".$linha['entrada']."&
                        tipo=".$linha['tipo']."&
                        create=".$linha['data_create']."'>

                          <button class='btn btn-success'>Verificar</button>
                        </a>

                      </td>
                    </tr>

                 ";
              }
            }
      ?>

  </tbody>
</table>        
</div>


    </div>
  </div>
</section>






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
    <script src="../assets/js/jquery-3.5.1.slim.min.js"></script>
    <script src="../vendors/@popperjs/popper.min.js"></script>
    <script src="../vendors/bootstrap/bootstrap.min.js"></script>
    <script src="../vendors/is/is.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="../vendors/fontawesome/all.min.js"></script>
    <script src="../assets/js/theme.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;family=Volkhov:wght@700&amp;display=swap" rel="stylesheet">
  </body>

</html>