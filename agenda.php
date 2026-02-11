<?php
$host="localhost";
$user="root";
$password="";
$db="visto_db";

session_start();

$conexao=mysqli_connect($host,$user,$password,$db);
if($conexao===false){
	die("connection error");
}

if(!isset($_SESSION["username"])){
	header("location:login.php");
	exit;
}

?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Visto | Angola</title>

<link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png">
<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.ico">
<link rel="manifest" href="assets/img/favicons/manifest.json">
<meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
<meta name="theme-color" content="#ffffff">

<link href="assets/css/theme.css" rel="stylesheet" />
<link href="assets/css/style.css" rel="stylesheet" />
<link rel="stylesheet" href="assets/css/sweetalert2.min.css">
<script src="assets/js/sweetalert2.all.min.js"></script>
</head>

<body>
<main class="main" id="top">
<nav class="navbar navbar-expand-lg navbar-light fixed-top py-5 d-block" data-navbar-on-scroll="data-navbar-on-scroll">
<div class="container">
<a class="navbar-brand fsize" href="index.php">AngoVisto</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
<ul class="navbar-nav ms-auto pt-2 pt-lg-0 font-base align-items-lg-center align-items-start">
<li class="nav-item px-3 px-xl-4"><a class="nav-link fw-medium" href="index.php#service">Serviços</a></li>
<li class="nav-item px-3 px-xl-4"><a class="nav-link fw-medium" href="vistoManager.php">Agendamento</a></li>
<li class="nav-item px-3 px-xl-4"><a class="nav-link fw-medium" href="index.php#booking">Sobre</a></li>
<li class="nav-item px-3 px-xl-4"><a class="nav-link fw-medium" href="index.php#contacto">Contacto</a></li>
<li class="nav-item px-3 px-xl-4"><a class="btn btn-outline-dark fw-medium" href="php/logout.php">Log out</a></li>
</ul>
</div>
</div>
</nav>

<div class="page-wrapper mt-5">
<div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
<div class="row justify-content-center w-100">
<div class="col-md-8 col-lg-6 col-xxl-3">
<div class="card mb-0">
<div class="card-body">
<h2 class="text-center mt-5 fs-5 text-primary"><?= $editar ? 'Editar Agendamento' : 'Agendar' ?></h2>

<?php
$editar = false;
$dados = null;

/* =====================
   MODO EDITAR
===================== */
if(isset($_GET['id'])){
	$editar = true;
	$id = intval($_GET['id']);

	$sql = "SELECT * FROM tbagenda WHERE id=$id";
	$res = mysqli_query($conexao,$sql);
	$dados = mysqli_fetch_assoc($res);

	if(!$dados){
		echo "<script>alert('Registro não encontrado');window.location='agenda.php';</script>";
		exit;
	}
}

/* =====================
   SALVAR
===================== */
if(isset($_POST["submit"])){

	$nome      = $_POST["nome"];
	$dataNasc = $_POST["dataNasc"];
	$sexo      = $_POST["sexoType"];
	$country   = $_POST["country"];
	$entrada   = $_POST["entrada"];
	$tipo      = $_POST["tipo"];

	$newImageName = $editar ? $dados['foto'] : null;

	if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0){

		$fileName = $_FILES["image"]["name"];
		$fileSize = $_FILES["image"]["size"];
		$tmpName  = $_FILES["image"]["tmp_name"];

		$validImageExtension = ['jpg','jpeg','png'];
		$ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

		if(!in_array($ext,$validImageExtension)){
			echo "<script> Swal.fire({ 
              title: 'Erro!',
              text: 'Invalid Image Extension!',    
              icon: 'error' 
              });
            </script>";
			exit;
		}

		if($fileSize > 1000000){
			echo "<script> Swal.fire({ 
              title: 'Erro!',
              text: 'Image Size Is Too Large!',    
              icon: 'error' 
              });
            </script>";
			exit;
		}

		$newImageName = uniqid().".".$ext;
		move_uploaded_file($tmpName,"img/".$newImageName);
	}

	if($editar){

		$id = intval($_POST['id']);

		$sql = "UPDATE tbagenda SET
				nome='$nome',
				data_Nasc='$dataNasc',
				sexo='$sexo',
				country='$country',
				entrada='$entrada',
				tipo='$tipo',
				foto='$newImageName'
				WHERE id=$id";

	}else{

		$sql = "INSERT INTO tbagenda
				(nome,data_Nasc,sexo,country,entrada,tipo,foto)
				VALUES
				('$nome','$dataNasc','$sexo','$country','$entrada','$tipo','$newImageName')";
	}

	mysqli_query($conexao,$sql);

	echo "<script>
          Swal.fire({
              icon: 'success',
              title: 'Sucesso!',
              text: 'Agendado com sucesso!',
              confirmButtonText: 'OK'
          }).then(() => {
              window.location.href = 'agenda.php';
          });
        </script>";
	exit;
}
?>

<form method="POST" enctype="multipart/form-data">

<?php if($editar): ?>
<input type="hidden" name="id" value="<?= $dados['id'] ?>">
<?php endif; ?>

<div class="form-group mt-2">
<label>Nome</label>
<input type="text" class="form-control" name="nome" value="<?= $editar ? $dados['nome'] : '' ?>" required>
</div>

<div class="form-group mt-3">
<label>Data de Nascimento</label>
<input type="date" class="form-control" name="dataNasc" value="<?= $editar ? $dados['data_Nasc'] : '' ?>" required>
</div>

<div class="form-group mt-3">
<label>Sexo</label>
<select name="sexoType" class="form-control" required>
<option value="">Sexo</option>
<option value="M" <?= $editar && $dados['sexo']=='M'?'selected':'' ?>>Masculino</option>
<option value="F" <?= $editar && $dados['sexo']=='F'?'selected':'' ?>>Femenino</option>
</select>
</div>

 <div class="form-group mt-3">
<label for="country">Nacionalidade</label>
<?php
  $countries = array("Angola", "Albania", "Algeria", "American Samoa", "Andorra", "Afghanistan", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
?>

<select name="country"  class="form-control" required>
<option value selected >Seleciona seu país</option>
<?php
  foreach($countries as $key => $value):
    echo '<option value="'.$value.'" '.($editar && $dados['country']==$value?'selected':'').'>'.$value.'</option>';
  endforeach;
?>
</select>
</div>

<div class="form-group mt-3">
<label>Entrada</label>
<select name="entrada" class="form-control" required>
<option value="">Selecione</option>
<option value="Uma Vez" <?= $editar && $dados['entrada']=='Uma Vez'?'selected':'' ?>>Uma Vez</option>
<option value="Duplo" <?= $editar && $dados['entrada']=='Duplo'?'selected':'' ?>>Duplo</option>
<option value="Multiplo" <?= $editar && $dados['entrada']=='Multiplo'?'selected':'' ?>>Multiplo</option>
</select>
</div>

<div class="form-group mt-3">
<label for="entrada">Tipo/Class</label>
<?php
$entradas = array("Diplomático", "Negocios", "Turismo", "Estudante","Trabalho",
"Jornalista", "Artista", "Religião");
?>

<select name="tipo" class="form-control" required>
<option value selected >Selecione Tipo de Visto</option>
<?php
foreach($entradas as $key => $value):
  echo '<option value="'.$value.'" '.($editar && $dados['tipo']==$value?'selected':'').'>'.$value.'</option>';
endforeach;
?>
</select>
</div>

<div class="form-group mt-3 mb-4">
<label>Foto</label>
<input type="file" class="form-control" name="image" accept=".jpg,.jpeg,.png">
</div>

<div class="modal-footer">
<button type="submit" name="submit" class="btn btn-primary">Salvar</button>
</div>

</form>
</div>
</div>
</div>
</div>
</div>
</div>
</main>

<script src="vendors/@popperjs/popper.min.js"></script>
<script src="vendors/bootstrap/bootstrap.min.js"></script>
<script src="vendors/is/is.min.js"></script>
<script src="vendors/fontawesome/all.min.js"></script>
<script src="assets/js/theme.js"></script>
</body>
</html>
