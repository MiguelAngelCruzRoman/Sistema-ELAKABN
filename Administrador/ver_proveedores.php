<?php
    $archivo = "C:/xampp/htdocs/Sistema_ELAKABN/Archivos/proveedores.csv";
    $csvData = file_get_contents($archivo);

    $rows = str_getcsv($csvData, "\n");
    $data = array();

    foreach ($rows as $row){
        $data[] = str_getcsv($row, ",");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver proveedores</title>
    <!--Estilo-->
	<style>

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
    <!--enlaces de Bootstrap CSS y jQuery -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!--enlace del archivo JavaScript de Bootstrap -->
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
					<li class="nav-item">
						<a class="nav-link" href="registros.html">Registros</a>
					</li>
					<li class="nav-item active">
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

    <h1 class="text-center">Consultar proveedores</h1>

    <div>
        <?php
        echo '<table class="table"><thead class="thead-dark"><tr><th scope="col">Nombre</th>      <th scope="col">Apellidos</th>
        <th scope="col">Teléfono</th>
        <th scope="col">Producto</th>
        </tr>
        </thead><tbody>';
        foreach($data as $row){
            echo '<tr>';
            foreach($row as $cell){
                echo '<td>' .htmlspecialchars($cell).'</td>';
            }
            echo '</tr>';
        }
        echo "</tbody></table>";
        ?>
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