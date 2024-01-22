<!DOCTYPE html>
<html>
<head>
	<title>Inicio de sesión</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<style type="text/css">
	body{
		background-image: url("Imagenes/logo_transparente.png");
		background-repeat:no-repeat;
		align: center;
		background-color: #fa9a45;
        background-size: initial;
        background-position:center center; /*respecto a body*/
        height: 100%;
    }
html{
        height: 100%; /*respecto a la ventana*/
    }

	#texto{
		color: #ffffff ;
		font-size: 5vh;
		display: flex;
		justify-content:center;
		text-height: 50%;
	}

	#texto2{
		color: #ffffff;
		font-size: 3vh;
	}

	#inicioSesion{
		color: #ffffff;
		font-size: 5vh;
	}

	#boton{
		display: flex;
		justify-content:center;
	}

  </style>
  </head>
<body>
	
<a>
        <img src="Imagenes/logoChido.png" width="50px" height="50px" alt="ELAKABN">
      </a>

	<div  class="container mt-5">
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<h3 id ="inicioSesion"class="mb-3">Inicio de sesión</h3>
				<form method="post" action="index.php">
					<div class="form-group">
						<label id ="texto2" for="username">Nombre de usuario</label>
						<input type="text" class="form-control" id="username" name="username" required>
					</div>
					<div class="form-group">
						<label id="texto2" for="password">Contraseña</label>
						<input type="password" class="form-control" id="password" name="password" required>
					</div>
					<div id ="boton"><button type="submit" class="btn btn-primary">Ingresar</button></div>
					<div><br><br><br><br><br><br><br><br><br><a id ="texto" href="Clientes/index.html">¿Eres cliente? Da click aquí</a></div>					
				</form>
			</div>
		</div>
	</div>
	<!-- jQuery y Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/XpEdLvPEO0eSbLJ" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
<?php
// Verificar si se recibieron los datos del formulario
if (isset($_POST['username']) && isset($_POST['password'])) {
	// Obtener los datos del formulario
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	// Abrir el archivo CSV para leer los datos
	//$a = glob();
	$csv = fopen('C:\xampp\htdocs\Sistema_ELAKABN\Archivos\usuarios.csv', "r");
	
	// Buscar el usuario en el archivo CSV
	$encontrado = false;
	$encontrado2 = false;

	while (($fila = fgetcsv($csv, 1000, ",")) !== false) {
		if ($fila[0] == $username && $fila[1] == $password) {
			if($fila[2] == "Administrador"){
			$encontrado = true;
			break;}
			if($fila[2] == "Mesero"){
				$encontrado2 = true;
				break;}
		}
	}
	
	// Cerrar el archivo CSV
	fclose($csv);
	
	// Redirigir a la página siguiente si es administrador o mostrar un mensaje de error
	if ($encontrado) {
		header("Location: Administrador/PaginaInicial.html");
		session_start();
		$_SESSION['username']=$username;
		exit();
	} else {
		echo "<script>alert('Usuario o contraseña incorrectos');</script>";
	}

	// Redirigir a la página siguiente si es mesero o mostrar un mensaje de error
	if ($encontrado2) {
		header("Location: Trabajadores/ordenar.php");
		exit();
	} else {
		echo "<script>alert('Usuario o contraseña incorrectos');</script>";
	}
}


?>