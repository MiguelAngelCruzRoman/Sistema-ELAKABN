<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>Menú de bebidas alcohólicas</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<style>
		.product-image {
    height: 250px; /* Ajusta la altura deseada para las imágenes */
    width:80px;
    object-fit: cover;
  }

		div {
			align-items: center;
		}
		footer.footer {
			width: 100%;
			background-color: #343a40;
			color: #fff;
			padding: 10px 0;
		}

		footer.footer p,
		footer.footer a {
			color: #fff;
		}
	</style>
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
				<ul class="navbar-nav ">
				<li class="nav-item active">
						<a class="nav-link" href="ordenar.php">Menú</a>
					</li>
          <li class="nav-item ">
						<a class="nav-link" href="servicios.html">Servicios extra</a>
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

	<br>
	<div class="container mt-5">

		<div class="row">
			<div class="col-md-12">
				<h1>Menú para ordenar</h1>
			</div>
		</div>

		<div class="row mt-5">
			<?php
			// Abrir el archivo CSV y leer los datos
			$archivo_csv = fopen('C:\xampp\htdocs\Sistema_ELAKABN\Archivos\productos.csv', 'r');
			$products = array();
			while (($fila = fgetcsv($archivo_csv)) !== false) {
				$products[] = array(
					'id' => $fila[0],
					'name' => $fila[1],
					'type' => $fila[2],
					'price' => $fila[3],
					'description' => $fila[4],
					'image' => $fila[5]
				);
			}

			// Comprobar si se ha añadido un producto al carrito
			if (isset($_POST['action']) && $_POST['action'] == 'add') {
				$id = intval($_POST['product_id']);
				if (isset($_SESSION['cart'][$id])) {
					$_SESSION['cart'][$id]['quantity'] += intval($_POST['quantity']);
				} else {
					$_SESSION['cart'][$id] = array(
						'quantity' => intval($_POST['quantity']),
						'price' => floatval($_POST['price'])
					);
				}
			}

			// Comprobar si se ha eliminado un producto del carrito
			if (isset($_GET['action']) && $_GET['action'] == 'delete') {
				$id = intval($_GET['product_id']);
				unset($_SESSION['cart'][$id]);
			}

			// Mostrar los productos del menú
			foreach ($products as $product) {
				?>
				<div class=" col-md-3 mb-4">
					<div class="card">
						<img src="<?php echo $product['image']; ?>" class="product-image" 
							alt="<?php echo $product['name']; ?>">
						<div class="card-body">
							<h5 class="card-title">
								<?php echo $product['name']; ?>
							</h5>
							<p class="card-text">
								<?php echo '$' . number_format($product['price'], 2); ?>
							</p>
							<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
								<input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
								<input type="hidden" name="price" value="<?php echo $product['price']; ?>">
								<div class="form-group">
									<label for="quantity_<?php echo $product['id']; ?>">Cantidad:</label>
									<input type="number" class="form-control" id="quantity_<?php echo $product['id']; ?>"
										name="quantity" value="1" min="1">
								</div>
								<button type="submit" class="btn btn-primary" name="action" value="add">Agregar al
									carrito</button>
							</form>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<?php
if (isset($_POST['NoSeguir'])) {
	unset($_SESSION['cart']);
	unset($_SESSION['Mesa']);
	echo '<script type="text/javascript">alert("LA ÚLTIMA ORDEN NO SE GUARDÓ. REDIRIGIENDO A MESAS."); window.location.href = "Mesas.php";</script>';
	exit();
} elseif (isset($_POST['Seguir'])) {
	unset($_SESSION['cart']);
	echo '<script type="text/javascript">alert("ORDEN REGISTRADA CORRECTAMENTE.");</script>';
}


?>
		<div class="row mt-5">
			<div class="col-md-12">
				<h2>Carrito de compras</h2>
				<table class="table" id="carrito">
					<thead>
						<tr align="center">
							<th>Producto</th>
							<th>Cantidad</th>
							<th>Precio unitario</th>
							<th>Subtotal</th>
							<th>Acciones</th> <!-- Agregamos la columna de acciones -->
						</tr>
					</thead>
					<tbody>
						<?php
						// Mostrar los productos del carrito
						$total = 0;
						if (isset($_SESSION['cart'])) {
							foreach ($_SESSION['cart'] as $id => $item) {
								$product = $products[$id - 1];
								$subtotal = $product['price'] * $item['quantity'];
								$total += $subtotal;
								?>
								<tr align="center">
									<td>
										<?php echo $product['name']; ?>
									</td>
									<td>
										<?php echo $item['quantity']; ?>
									</td>
									<td>
										<?php echo '$' . number_format($product['price'], 2); ?>
									</td>
									<td>
										<?php echo '$' . number_format($subtotal, 2); ?>
									</td>
									<td> <!-- Agregamos el botón de eliminación del producto -->
										<a href="<?php echo $_SERVER['PHP_SELF'] . '?action=delete&product_id=' . $product['id']; ?>"
											class="btn btn-danger">
											<i class="fa fa-trash"></i> Eliminar
										</a>
									</td>
								</tr>
							<?php }
						} ?>
						<tr>
							<td colspan="2"></td>
							<td colspan="1" align="center"><strong>Total:</strong></td>
							<td colspan="1" align="center">
								<?php echo '$' . number_format($total, 2); ?>
							</td>
						</tr>
					</tbody>
				</table>
				
				<div class="container mt-5" align="center">
				<form method="post">
					<button name="NoSeguir" class="btn btn-primary" onclick="dialogo.showModal();">Volver</button>
					<button   class="btn btn-primary" name="Seguir" onclick="dialogo.showModal();"> Ordenar</button>
					</form>
				</div>
			</div>
		</div>
	</div>




	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
		integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
		crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.1/dist/umd/popper-base.min.js"
		integrity="sha384-3qV0swl8fqSZu2Qy1SltjKtRi0NquCjQd65Ncz+xk6RpiNwmzQTnM/9/Z6fa5q1I"
		crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"
		integrity="sha384-zJbxiCWSlYz0jvT0UKD7VDCqbD+w2Qzpa/E0UL/huJ7VQT0YKuR7VxxBXOz09xTG"
		crossorigin="anonymous"></script>

		<br><br>
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