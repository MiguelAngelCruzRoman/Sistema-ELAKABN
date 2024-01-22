<?php
if($_SERVER["REQUEST_METHOD"] === "POST"){
    //obtener los datos del formulario
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $telefono = $_POST["telefono"];
    $tipo = $_POST["tipo"];

    //crea un array con los datos del formulario
    $datos = array(
        array(       
        "nombre" => $nombre,
        "apellidos" => $apellidos,
        "telefono" => $telefono,
        "tipo" => $tipo)
    );

    //abrimos el archivo empleados.csv
    $archivo = "C:/xampp/htdocs/Sistema_ELAKABN/Archivos/empleados.csv";
    $csv = fopen($archivo,"a");

    //colocamos los datos del array en el csv
    foreach($datos as $fila){
        fputcsv($csv,$fila);
    }

    //cerramos el archivo
    fclose($csv);
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Registro de empleados</title>
	<!--Estilo-->
	<style>
        #dropzone {
          border: 2px dashed gray;
		  width: 50vh;
		  height: 50vh;
          padding: 20px;
		  display: flex;
          align-items: center;
          font-size: 24px;
          margin: 50px;
        }

		#opciones{
			border: 2px;
			margin: 50px;
			display: flex;
			align-items: center;
		}

		#principal{
			border: 2px;
			margin: auto;
			display: flex;
			justify-content: center;
			align-items: center;
		}
    footer.footer {
      position: fixed;
      left: 0;
      bottom: 0;
      width: 100%;
      background-color: #343a40;
      color: #fff;
      padding: 10px 0;
    }

    footer.footer p, footer.footer a {
      color: #fff;
    }
    </style>
	<!-- Agregue los enlaces de Bootstrap CSS y jQuery -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!-- Agregue el enlace del archivo JavaScript de Bootstrap -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
	<header>
		<nav class="navbar navbar-expand-md  navbar-dark bg-dark">
			<a class="navbar-brand" href="PaginaInicial.html">ELAKABN</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
				aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="Mesas.html">Ordenar</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="servicios.html">Servicios extra</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="almacen.php">Almacén</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="reportes.php">Reportes</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="registros.html">Registros</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="consultar.html">Consultar</a>
					</li>
				</ul>
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active">
						<a class="nav-link" href="../">Cerrar sesión</a>
					</li>
				</ul>
			</div>
		</nav>
	</header>
	
	<h1 class="text-center">Registro de empleados</h1>
	<div id="principal">
		<!--forumlario-->
		<div id ="opciones">
			<form method ="POST" action = "<?php echo $_SERVER["PHP_SELF"]; ?>">
				<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" class="form-control" name ="nombre" id="nombre"  placeholder="Nombre" required>
				</div>
				<div class="form-group">
				<label for="apellidos">Apellidos</label>
				<input type="text" class="form-control" name="apellidos" id="apellidos"  placeholder="Apellidos" required>
				</div>
				<div class="form-group">
				<label for="telefono">Teléfono</label>
				<input type="tel" class="form-control" name="telefono" id="telefono"  placeholder="Teléfono" required>
				</div>
				<div class="form-group">
				<label for="tipo">Tipo</label>
				<input type="text" class="form-control" name="tipo" id="tipo"  placeholder="Tipo de empleado" required>
				</div>
				<button type="submit" class="btn btn-primary">Guardar</button>
				<button type="submit" class="btn btn-primary" Onclick="window.history.back();">Cancelar</button>
			</form>
		</div>

		<!--Aqui se guarda la imagen-->
		<div id = "dropzone">Coloca tu foto aquí</div>		
		<script src="js/upload_image.js"></script>
	</div>

	<footer class="footer bg-dark text-white">
		<div class="container">
		  <div class="row">
			<div class="col-md-6">
			  <ul class="list-inline">
				<li class="list-inline-item"><a href="../ArchivosEnComún/IntegrantesProyecto.html">&copy; 2023 Bar "ELAKABN". Todos los derechos reservados.</a></li>
				<li class="list-inline-item"><a href="../ArchivosEnComún/IntegrantesProyecto.html">Conócenos</a></li>
			  </ul>
			</div>
			<div class="col-md-6">
			  <ul class="list-inline text-md-right">
				<li class="list-inline-item"><a href="../ArchivosEnComún/TérminosUso.html">Términos de uso</a></li>
				<li class="list-inline-item"><a href="../ArchivosEnComún/PoliticaPrivacidad.html">Política de privacidad</a></li>
				<li class="list-inline-item"><a href="../ArchivosEnComún/AvisoLegal.html">Aviso legal</a></li>
			  </ul>
			</div>
		  </div>
		</div>
	  </footer>	 
</body>
</html>