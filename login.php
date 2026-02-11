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
?>



<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Visto | Angola</title>
  <link href="assets/css/theme.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/sweetalert2.min.css">
  <script src="assets/js/sweetalert2.all.min.js"></script>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" style="background-color: #ccc;" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-75">
          <div class="col-md-8 col-lg-6 col-xxl-3  w-75">
            <div class="card mb-0">
              <div class="card-body d-flex">
              
              <div class="w-50 p-4" style="background: url(assets/img/travel.png); background-repeat: no-repeat; background-size: cover; background-position: center;">
              </div>
              
              <div class="p-4">
              <h2 class="text-center">Login</h2>

              <?php

                if($_SERVER["REQUEST_METHOD"]=="POST")
                {
                  $username=$_POST["username"];
                  $password=$_POST["password"];


                  $sql="select * from usuario where username='".$username."' AND password='".$password."' ";

                  $result=mysqli_query($conexao, $sql);

                  $row=mysqli_fetch_array($result);
                
                
                  if($row["usertype"]=="user")
                  {	

                    $_SESSION["username"]=$username;
                    $_SESSION['id'] = $row['id'];

                    header("location:index.php");
                  }

                  else if($row["usertype"]=="admin")
                  {

                    $_SESSION["username"]=$username;
                    
                    header("location:./admin/admin.php");
                  }

                    else
                    {       
                      echo "<script>
                            Swal.fire({
                            icon: 'error',
                            title: 'Erro!',
                            text: 'Palavra-passe ou Usuario errado!',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = 'login.php';
                        });
                          </script>";
                    }

                }	

                ?>

                <form action="#" method="POST">
                                 
                  <div class="mt-4 mb-3">
                    <label for="username" class="form-label">username</label>
                    <input type="text" class="form-control" id="email" name="username" required>
                  </div>
                  <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                   </div>
                  <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="form-check">
                      <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                      <label class="form-check-label text-dark" for="flexCheckChecked">
                        Remeber this Device
                      </label>
                    </div>
                    </div>

                    <div class="mb-3">
                    <button type="submit" class="btn btn-primary form-control">Entrar</button>
                  </div>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="mb-0 fw-bold">don't have count?</p>
                    <a class="text-primary fw-bold ms-2" href="register.php">Create an account</a>
                  </div>
                </form>
              </div>

                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

    <script src="vendors/@popperjs/popper.min.js"></script>
    <script src="vendors/bootstrap/bootstrap.min.js"></script>
    <script src="vendors/is/is.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="vendors/fontawesome/all.min.js"></script>
    <script src="assets/js/theme.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;family=Volkhov:wght@700&amp;display=swap" rel="stylesheet">

</body>

</html>