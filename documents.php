<!DOCTYPE html>
<html>
<head>
    <title>Documentos - Repositorio Académico</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf.js"></script>
    <style>
        /* Agrega estilos CSS personalizados aquí */
        .documento {
            display: inline-block;
            width: 25%; /* Ancho del contenedor de documento */
            margin: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }

        .pdf-viewer {
            max-width: 100%;
        }
    </style>
</head>
<body>
    <center>
    <h1>Documentos en el Repositorio Académico</h1>

    <?php
    // Conectar a la base de datos 
    $servername = "localhost:3307";
    $username = "root";
    $password = "";
    $dbname = "repositorio";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("La conexión a la base de datos falló: " . $conn->connect_error);
    }

    $sql = "SELECT id, titulo, autor, categoria, carrera, archivo FROM documentos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Comienza un div contenedor de documentos
        echo '<div class="documentos-container">';
        
        while ($row = $result->fetch_assoc()) {
            // Comienza un div para cada documento
            echo '<div class="documento">';
            echo "<h3>" . $row["titulo"] . "</h3>";
            echo "<p><strong>Autor:</strong> " . $row["autor"] . "</p>";
            echo "<p><strong>Categoría:</strong> " . $row["categoria"] . "</p>";
            echo "<p><strong>Carrera:</strong> " . $row["carrera"] . "</p>";
            
            // Agregar el visor PDF.js
            echo '<div class="pdf-viewer">';
            echo '<canvas id="pdfViewer' . $row["id"] . '"></canvas>';
            echo '</div>';
            
            echo "<p><a href='uploads/" . $row["archivo"] . "' target='_blank'>Descargar</a></p>";
            echo "<p><a href='delete.php?id=" . $row["id"] . "'>Eliminar</a></p>"; 
            // Cierra el div del documento
            echo '</div>';
        }

        // Cierra el div contenedor de documentos
        echo '</div>';
    } else {
        echo "No se encontraron documentos."; echo '<a href="cargardoc.php"> Cargar documento </a>';
    }

    $conn->close();
    echo '<br><a href="cargardoc.php">Cargar documento</a>';
    echo '<br><a href="main.php">Volver a inicio</a>';
    ?>

    <script>
        // Código JavaScript para inicializar PDF.js en cada visor
        <?php
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "PDFJS.getDocument('uploads/" . $row["Conveniotgi.pdf"] . "').promise.then(function(pdf) {
                pdf.getPage(1).then(function(page) {
                    var canvas = document.getElementById('pdfViewer" . $row["id"] . "');
                    var context = canvas.getContext('2d');
                    var viewport = page.getViewport({ scale: 1 });
                    canvas.width = viewport.width;
                    canvas.height = viewport.height;
                    page.render({ canvasContext: context, viewport: viewport });
                });
            });";
        }
        ?>
    </script>
    </center>
</body>
</html>
