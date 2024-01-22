  <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Menú del Bar</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <style type="text/css">
    .navbar {
      background-color: #E5773D;
      color: black;
    }

    .arriba {
      display: grid;
      place-items: center;
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

    footer.footer p,
    footer.footer a {
      color: #fff;
    }
  </style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
  .product-image {
    height: 250px; /* Ajusta la altura deseada para las imágenes */
    width:80px;
    object-fit: cover;
  }
</style>

</head>

<body>
  <!-- Barra de navegación -->
  <!--navbar navbar-expand-lg navbar-dark bg-dark-->
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
						<a class="nav-link" href="PaginaInicial.html">Inicio</a>
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
  <h1 align="center">Selecciona un tipo de bebida</h1>

  <div class="arriba">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" onclick="filterProducts('all')">TODOS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" onclick="filterProducts('whisky')">WHISKY</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" onclick="filterProducts('brandy')">BRANDY</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" onclick="filterProducts('tequila')">TEQUILA</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" onclick="filterProducts('ron')">RON</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" onclick="filterProducts('vodka')">VODKA</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" onclick="filterProducts('cerveza')">CERVEZA</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" onclick="filterProducts('otros')">OTROS</a>
          </li>
        </ul>
      </div>
    </nav>
  </div>

  <div class="container mt-4">
    <div id="product-list" class="row"></div>
  </div>

  <!-- Agregar los enlaces a los scripts de Bootstrap y jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <?php
  // Leer el archivo CSV
  $file = fopen("productos.csv", "r");

  // Crear un arreglo vacío para almacenar los productos
  $products = array();

  // Leer cada línea del archivo CSV y agregar los datos al arreglo de productos
  while (($data = fgetcsv($file)) !== FALSE) {
    $product = array(
      "name" => $data[0],
      "type" => $data[1],
      "price" => $data[2],
      "description" => $data[3],
      "image" => $data[4]
    );
    $products[] = $product;
  }

  // Cerrar el archivo CSV
  fclose($file);
?>

  <script>
    // Datos de ejemplo (se pueden reemplazar con los productos reales)
    var products = <?php echo json_encode($products); ?>;

    

    // Función para filtrar y mostrar los productos por
    function filterProducts(type) {
      var productList = document.getElementById("product-list");
      productList.innerHTML = ""; // Limpiar la lista de productos antes de agregar los nuevos
      if (type === "all") {
        // Mostrar todos los productos
        for (var i = 0; i < products.length; i++) {
          addProductToDOM(products[i]);
        }
      } else {
        // Filtrar y mostrar los productos según el tipo seleccionado
        for (var i = 0; i < products.length; i++) {
          if (products[i].type === type) {
            addProductToDOM(products[i]);
          }
        }
      }
    }

    // Función para agregar un producto al DOM

    function addProductToDOM(product) {
      var productList = document.getElementById("product-list");

      var col = document.createElement("div");
      col.className = "col-lg-3 col-md-6 mb-4";

      var card = document.createElement("div");
      card.className = "card h-100";

      var img = document.createElement("img");
      img.className = "card-img-top product-image mx-auto";
      img.src = product.image;
      img.alt = product.name;

      var cardBody = document.createElement("div");
      cardBody.className = "card-body";

      var title = document.createElement("h5");
      title.className = "card-title";
      title.textContent = product.name;

      var price = document.createElement("p");
      price.className = "card-text";
      price.textContent = "Precio: " + product.price;

      var description = document.createElement("p");
      description.className = "card-text";
      description.textContent = product.description;

      cardBody.appendChild(title);
      cardBody.appendChild(price);
      cardBody.appendChild(description);

      card.appendChild(img);
      card.appendChild(cardBody);

      col.appendChild(card);

      productList.appendChild(col);
    }

    // Mostrar todos los productos por defecto
    filterProducts("all");
  </script>

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