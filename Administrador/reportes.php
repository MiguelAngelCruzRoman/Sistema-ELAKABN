<!DOCTYPE html>
<html>

<head>
    <title>Reportes de ventas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            overflow-x: hidden;
            background-color: #FAFAFA;
        }

        .canvas {
            width: 100%;
            height: 100%;
        }

        .form {
            margin: 0 +100px;
            left: 100px;
        }

        .arriba {
            position: absolute;
            top: 200px;
            left: 1100px;
            height: 350px;
            width: 30%;
            margin: 0 -15px;
            border: 2px;
            border-radius: 15px;
            background-color: #F8F4F4;
        }

        .arriba0 {
            position: absolute;
            top: 200px;
            left: 200px;
            height: 350px;
            width: 30%;
            margin: 0 -15px;
            border: 2px;
            border-radius: 15px;
            background-color: #F0FDFF;
        }

        .row1 {
            position: absolute;
            top: 570px;
            left: 200px;
            height: 350px;
            width: 30%;
            margin: 0 -15px;
            border: 2px;
            border-radius: 15px;
            background-color: #FBF1FA;
        }

        .row2 {
            position: absolute;
            top: 570px;
            left: 1000px;
            width: 40%;
            height: 400px;
            border: 2px;
            border-radius: 15px;
            margin: 0 -15px;
            background-color: #F2FCEB;
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
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                    <li class="nav-item active">
                        <a class="nav-link" href="reportes.php">Reportes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="registros.html">Registros</a>
                    </li>
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
    <div align="center">
        <h1>Reporte de ventas</h1>
    </div>
    <!-- Formulario -->
    <div class="form">
        <h6>Seleccione fecha inicio y fecha fin para la generación de su reporte:</h6>
        <form method="post" action="">
            <div class="form-inline">
                <label for="fecha_inicio" class="mr-sm-2">Fecha de inicio:</label>
                <input type="date" class="form-control mr-sm-2" id="fecha_inicio" name="fecha_inicio">

                <label for="fecha_fin" class="mr-sm-2">Fecha de fin:</label>
                <input type="date" class="form-control mr-sm-2" id="fecha_fin" name="fecha_fin">

                <button type="submit" class="btn btn-primary" id="generar">Generar</button>
                <button type="submit" class="btn btn-primary" Onclick="window.history.back();">Cancelar</button>
            </div>
        </form>
    </div>


    <!-- Gráfica Pastel -->
    <div class="container">
        <div class="row1">
            <h3 align="center">Los más vendidos (Unidades)</h3>
            <canvas id="pieChart"></canvas>
        </div>
    </div>
    <!-- Gráfica Barras (Productos vendidos) -->
    <div class="container">
        <div class="row2">
            <h3 align="center">Productos vendidos (Unidades)</h3>
            <canvas id="barChart"></canvas>
        </div>
    </div>
    <!-- Gráfica Barras (venta de 7 dias) -->
    <div class="container">
        <div class="arriba">
            <h3 align="center">Venta semanal (Unidades)</h3>
            <canvas id="weekChart"></canvas>
        </div>
    </div>
    <!-- Gráfica Lineas (Ganancias de 7 dias) -->
    <div class="container">
        <div class="arriba0">
            <h3 align="center">Ganancias por día (Monetario)</h3>
            <canvas id="lineChart"></canvas>
        </div>
    </div>


    <!-- Funciones para las gráficas -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script>
        function generarGraficas() {

            // Cargar el CSV y generar las gráficas
            $(document).ready(function() {
                $.ajax({
                    url: "../Archivos/ventas.csv", // Ruta del archivo CSV
                    dataType: "text",
                    success: function(data) {
                        processData(data); // Procesar los datos del CSV
                    }
                });
            });

            function processData(allText) {
                // Separar el texto del CSV en líneas y encabezados
                var allTextLines = allText.split(/\r\n|\n/);
                var headers = allTextLines[0].split(",");
                var lines = [];

                // Recorrer las líneas del CSV y crear un arreglo con los datos
                for (var i = 1; i < allTextLines.length; i++) {
                    var data = allTextLines[i].split(",");
                    if (data.length === headers.length) {
                        var tarr = [];
                        for (var j = 0; j < headers.length; j++) {
                            tarr.push(data[j]);
                        }
                        lines.push(tarr);
                    }
                }

                // Obtener las 3 cantidades más grandes por producto utilizando switch: case
                var top3Lines = [];
                var productCounters = {};

                lines.forEach(function(line) {
                    var productName = line[4];
                    var quantity = parseInt(line[5]);

                    switch (productName) {
                        case "J&B":
                        case "Buchanan's":
                        case "J Walker Red":
                        case "Torres X":
                        case "Torres V":
                        case "Captain Morgan":
                        case "Fundador":
                        case "Magno":
                        case "Presidente":
                        case "Don Pedro":
                        case "Cazadores":
                        case "Corralejo":
                        case "Hornitos":
                        case "Jose Cuervo":
                        case "Jimador":
                        case "100 Años Azul":
                        case "Apletón Especial":
                        case "Bacardí Blanco":
                        case "Baraima":
                        case "Absolut Azul":
                        case "Absolut Citron":
                        case "Absolut Mandarin":
                        case "Smirnoff":
                        case "Negra Modelo":
                        case "Corona/Victoria":
                        case "Especial Xtreme":
                        case "Agua Purificada":
                        case "Refresco":
                        case "Jugo 1L":
                        case "Papas":
                            if (!productCounters[productName]) {
                                productCounters[productName] = quantity;
                            } else {
                                productCounters[productName] += quantity;
                            }
                            break;
                    }
                });

                Object.keys(productCounters).forEach(function(productName) {
                    top3Lines.push([productName, productCounters[productName]]);
                });

                top3Lines.sort(function(a, b) {
                    return b[1] - a[1];
                });

                top3Lines = top3Lines.slice(0, 3);

                // Obtener los nombres de los productos y las cantidades para la gráfica de pastel
                var pieLabels = [];
                var pieValues = [];
                top3Lines.forEach(function(line) {
                    pieLabels.push(line[0]);
                    pieValues.push(line[1]);
                });

                // Crear la gráfica de pastel
                var ctxPie = document.getElementById("pieChart").getContext("2d");
                var pieChart = new Chart(ctxPie, {
                    type: "pie",
                    data: {
                        labels: pieLabels,
                        datasets: [{
                            data: pieValues,
                            backgroundColor: ["#FF871A", "#848382", "#F8BB0C"]
                        }]
                    },
                    options: {
                        responsive: true,
                        legend: {
                            position: "right"
                        },
                        tooltips: {
                            callbacks: {
                                label: function(tooltipItem, data) {
                                    var dataset = data.datasets[tooltipItem.datasetIndex];
                                    var total = dataset.data.reduce(function(previousValue, currentValue) {
                                        return previousValue + currentValue;
                                    });
                                    var currentValue = dataset.data[tooltipItem.index];
                                    var percentage = Math.floor((currentValue / total) * 100 + 0.5);
                                    return pieLabels[tooltipItem.index] + ": " + currentValue + " (" + percentage + "%)";
                                }
                            }
                        }
                    }
                });

                // Crear la gráfica de barras por bebidas utilizando switch: case
                var barLabels = ["J&B", "Buchanan's", "J Walker Red", "Torres X", "Torres V", "Captain Morgan", "Fundador", "Magno", "Presidente", "Don Pedro", "Cazadores", "Corralejo", "Hornitos", "Jose Cuervo", "Jimador", "100 Años Azul", "Apletón Especial", "Bacardí Blanco", "Baraima", "Absolut Azul", "Absolut Citron", "Absolut Mandarin", "Smirnoff", "Negra Modelo", "Corona/Victoria", "Especial Xtreme", "Agua Purificada", "Refresco", "Jugo 1L", "Papas"];
                var barValues = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

                lines.forEach(function(line) {
                    var productName = line[4];
                    var quantity = parseInt(line[5]);

                    switch (productName) {
                        case "J&B":
                            barValues[0] += quantity;
                            break;
                        case "Buchanan's":
                            barValues[1] += quantity;
                            break;
                        case "J Walker Red":
                            barValues[2] += quantity;
                            break;
                        case "Torres X":
                            barValues[3] += quantity;
                            break;
                        case "Torres V":
                            barValues[4] += quantity;
                            break;
                        case "Captain Morgan":
                            barValues[5] += quantity;
                            break;
                        case "Fundador":
                            barValues[6] += quantity;
                            break;
                        case "Magno":
                            barValues[7] += quantity;
                            break;
                        case "Presidente":
                            barValues[8] += quantity;
                            break;
                        case "Don Pedro":
                            barValues[9] += quantity;
                            break;
                        case "Cazadores":
                            barValues[10] += quantity;
                            break;
                        case "Corralejo":
                            barValues[11] += quantity;
                            break;
                        case "Hornitos":
                            barValues[12] += quantity;
                            break;
                        case "Jose Cuervo":
                            barValues[13] += quantity;
                            break;
                        case "Jimador":
                            barValues[14] += quantity;
                            break;
                        case "100 Años Azul":
                            barValues[15] += quantity;
                            break;
                        case "Apletón Especial":
                            barValues[16] += quantity;
                            break;
                        case "Bacardí Blanco":
                            barValues[17] += quantity;
                            break;
                        case "Baraima":
                            barValues[18] += quantity;
                            break;
                        case "Absolut Azul":
                            barValues[19] += quantity;
                            break;
                        case "Absolut Citron":
                            barValues[20] += quantity;
                            break;
                        case "Absolut Mandarin":
                            barValues[21] += quantity;
                            break;
                        case "Smirnoff":
                            barValues[22] += quantity;
                            break;
                        case "Negra Modelo":
                            barValues[23] += quantity;
                            break;
                        case "Corona/Victoria":
                            barValues[24] += quantity;
                            break;
                        case "Especial Xtreme":
                            barValues[25] += quantity;
                            break;
                        case "Agua Purificada":
                            barValues[26] += quantity;
                            break;
                        case "Refresco":
                            barValues[27] += quantity;
                            break;
                        case "Jugo 1L":
                            barValues[28] += quantity;
                            break;
                        case "Papas":
                            barValues[29] += quantity;
                            break;
                    }
                });

                // Crear la gráfica de barras por bebidas
                var ctxBar = document.getElementById("barChart").getContext("2d");
                var barChart = new Chart(ctxBar, {
                    type: "bar",
                    data: {
                        labels: barLabels,
                        datasets: [{
                            label: "Productos Vendidos",
                            data: barValues,
                            backgroundColor: "#FF8045"
                        }]
                    },
                    options: {
                        responsive: true,
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });

                // Crear la gráfica de barras por semana utilizando switch: case
                var weekLabels = ["lunes", "martes", "miercoles", "jueves", "viernes", "sabado", "domingo"];
                var weekValues = [0, 0, 0, 0, 0, 0, 0];

                lines.forEach(function(line) {
                    var dateStr = line[0];
                    var dateParts = dateStr.split("-");
                    var date = new Date(dateParts[2], dateParts[1] - 1, dateParts[0]);

                    var dayOfWeek = getDayOfWeek(date);

                    switch (dayOfWeek) {
                        case "lunes":
                            weekValues[0] += parseInt(line[5]);
                            break;
                        case "martes":
                            weekValues[1] += parseInt(line[5]);
                            break;
                        case "miercoles":
                            weekValues[2] += parseInt(line[5]);
                            break;
                        case "jueves":
                            weekValues[3] += parseInt(line[5]);
                            break;
                        case "viernes":
                            weekValues[4] += parseInt(line[5]);
                            break;
                        case "sabado":
                            weekValues[5] += parseInt(line[5]);
                            break;
                        case "domingo":
                            weekValues[6] += parseInt(line[5]);
                            break;
                    }
                });

                // Crear la gráfica de barras por semana
                var ctxWeek = document.getElementById("weekChart").getContext("2d");
                var weekChart = new Chart(ctxWeek, {
                    type: "bar",
                    data: {
                        labels: weekLabels,
                        datasets: [{
                            label: "Unidades al día",
                            data: weekValues,
                            backgroundColor: "#FF5353"
                        }]
                    },
                    options: {
                        responsive: true,
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });

                // Crear la gráfica de líneas de ganancias por día
                var profitLabels = weekLabels; // Utilizamos los mismos días de la semana como etiquetas
                var profitValues = [0, 0, 0, 0, 0, 0, 0]; // Inicializamos el array de valores de ganancias por día

                lines.forEach(function(line) {
                    var dateStr = line[0];
                    var dateParts = dateStr.split("-");
                    var date = new Date(dateParts[2], dateParts[1] - 1, dateParts[0]);

                    var dayOfWeek = getDayOfWeek(date);

                    switch (dayOfWeek) {
                        case "lunes":
                            profitValues[0] += parseInt(line[2]) - parseInt(line[3]); // Restamos el costo (columna 3) para obtener las ganancias
                            break;
                        case "martes":
                            profitValues[1] += parseInt(line[2]) - parseInt(line[3]);
                            break;
                        case "miercoles":
                            profitValues[2] += parseInt(line[2]) - parseInt(line[3]);
                            break;
                        case "jueves":
                            profitValues[3] += parseInt(line[2]) - parseInt(line[3]);
                            break;
                        case "viernes":
                            profitValues[4] += parseInt(line[2]) - parseInt(line[3]);
                            break;
                        case "sabado":
                            profitValues[5] += parseInt(line[2]) - parseInt(line[3]);
                            break;
                        case "domingo":
                            profitValues[6] += parseInt(line[2]) - parseInt(line[3]);
                            break;
                    }
                });

                var ctxProfit = document.getElementById("lineChart").getContext("2d");
                var profitChart = new Chart(ctxProfit, {
                    type: "line",
                    data: {
                        labels: profitLabels,
                        datasets: [{
                            label: "Ganancias por Día",
                            data: profitValues,
                            borderColor: "#FF6384",
                            fill: false
                        }]
                    },
                    options: {
                        responsive: true,
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });

            }

            function getDayOfWeek(date) {
                var daysOfWeek = ["domingo", "lunes", "martes", "miercoles", "jueves", "viernes", "sabado"];
                return daysOfWeek[date.getDay()];
            }
        }

        //evento hacer funcionar el botón
        $(document).ready(function() {
            // Controlador de eventos para el botón "Generar"
            $('#generar').click(function(event) {
                event.preventDefault(); // Evita el envío del formulario
                generarGraficas(); // Llama a la función para generar las gráficas
            });
        });
    </script>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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