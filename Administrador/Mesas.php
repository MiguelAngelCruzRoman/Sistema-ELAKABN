<?php
// Verificar si el usuario ha iniciado sesión
session_start();
if (!isset($_SESSION['username'])) {
    // Si el usuario no ha iniciado sesión, redirigir al formulario de inicio de sesión
    header("Location: login.php");
    exit();
}

// Obtener el nombre de usuario de la sesión
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesas del bar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style type="text/css">
footer.footer p,
		footer.footer a {
			color: #fff;
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
        </style>
</head>

<body>
    <!-- Barra de navegación -->
    <header>
		<nav class="navbar navbar-expand-md  navbar-dark bg-dark">
			<a class="navbar-brand" href="PaginaInicial.html">ELAKABN</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
				aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item active">
						<a class="nav-link" href="Mesas.html">Ordenar</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="servicios.html">Servicios extra</a>
					</li>
					<li class="nav-item ">
						<a class="nav-link" href="almacen.php">Almacén</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="reportes.php">Reportes</a>
					</li>
                    <li class="nav-item">
						<a class="nav-link" href="registros.html">Registros</a>
					</li>
                    <li class="nav-item">
						<a class="nav-link" href="consultar.html">Consultar</a>
					</li>
				</ul>
				<ul class="navbar-nav ml-auto">
                <li class="nav-item">
					<a class="nav-link" href="?logout=true">Cerrar sesión</a></li>
				</ul>
			</div>
		</nav>
	</header>

    <div class="container">
        <h1>Mesas del Bar</h1>
        <div class="row">
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Mesa 1</h5>
                        <form method="post">
                        <button type="submit" name="boton1" class="btn btn-primary">Seleccionar</button>  
                        </form>                      
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Mesa 2</h5>
                        <form method="post">
                        <button type="submit" name="boton2" class="btn btn-primary">Seleccionar</button>  
                        </form>                   
                     </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Mesa 3</h5>
                        <form method="post">
                        <button type="submit" name="boton3" class="btn btn-primary">Seleccionar</button>  
                        </form>                   
                     </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Mesa 4</h5>
                        <button type="submit" name="boton4" class="btn btn-primary">Seleccionar</button>  
                    </div>
                </div>
            </div>
            <!-- Agrega más tarjetas de mesa si es necesario -->
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <?php
    // Verifica qué botón se ha presionado y redirige a la misma página con un mensaje personalizado
    if (isset($_POST['boton1'])) {
      header("Location: Ordenar.php" );
      $_SESSION['Mesa']= 'Mesa #1' ;
      exit();
    } elseif (isset($_POST['boton2'])) {
        header("Location: Ordenar.php" );
        $_SESSION['Mesa']= 'Mesa #2' ;
        exit();
    } elseif (isset($_POST['boton3'])) {
        header("Location: Ordenar.php" );
        $_SESSION['Mesa']= 'Mesa #3' ;
        exit();
    }elseif (isset($_POST['boton4'])) {
        header("Location: Ordenar.php" );
        $_SESSION['Mesa']= 'Mesa #4' ;
        exit();
    }
    ?>

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