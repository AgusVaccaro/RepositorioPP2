<?php
require_once "includes/db.php";
include "includes/documento.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Resultados de Búsqueda - Repositorio Académico</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/jpg" href="img/favicon.gif"/>
</head>
<body>
    <center>
    <h1>Resultados de Búsqueda</h1>

    <?php
    $search_query = $_GET['q'];

    $sql = "SELECT id, titulo, autor, categoria, materia, carrera, archivo, fecha_creacion FROM documentos WHERE 
            titulo LIKE '%$search_query%' OR
            autor LIKE '%$search_query%' OR
            categoria LIKE '%$search_query%' OR
            materia LIKE '%$search_query%' OR
            carrera LIKE '%$search_query%' OR
            fecha_creacion LIKE '%$search_query%'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<div class="documentos-container">';
        
        while ($row = $result->fetch_assoc()) {

            echo '<div class="documento">';
            echo "<h3>" . $row["titulo"] . "</h3>";
            echo "<p><strong>Autor:</strong> " . $row["autor"] . "</p>";
            echo "<p><strong>Categoría:</strong> " . $row["categoria"] . "</p>";
            echo "<p><strong>Materia:</strong> " . $row["materia"] . "</p>";
            echo "<p><strong>Carrera:</strong> " . $row["carrera"] . "</p>";
            echo "<p><strong>Fecha de Creación:</strong> " . $row["fecha_creacion"] . "</p>";

            echo '<div class="pdf-viewer">';
            echo '<canvas id="pdfViewer' . $row["id"] . '"></canvas>';
            echo '</div>';
            
            echo "<p><a href='uploads/" . $row["archivo"] . "' target='_blank'>Descargar</a></p>";
            echo '</div>';
        }

        echo '</div>';
    } else {
        echo "No se encontraron documentos que coincidan con la búsqueda.";
    }

    $conn->close();
    echo '<br><a href="index.php">Volver a inicio</a>';
    ?>
    </center>
</body>
</html>
