<?php
require_once "db.php";

if (isset($_GET['carrera'])) {
    $carrera = $_GET['carrera'];

    $sql = "SELECT id, titulo, autor, categoria, materia, archivo FROM documentos WHERE carrera = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $carrera);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="documento">';
            echo "<h3>" . $row["titulo"] . "</h3>";
            echo "<p><strong>Autor:</strong> " . $row["autor"] . "</p>";
            echo "<p><strong>Categoría:</strong> " . $row["categoria"] . "</p>";
            echo "<p><strong>Materia:</strong> " . $row["materia"] . "</p>";

            echo '<div class="pdf-viewer">';
            echo '<iframe src="uploads/' . $row["archivo"] . '" frameborder="0"></iframe>';
            echo '</div>';

            echo "<p><a href='uploads/" . $row["archivo"] . "' target='_blank'>Descargar</a></p>";
            echo '</div>';
        }
    } else {
        echo "No se encontraron documentos para esta carrera.";
    }

    $stmt->close();
} else {
    echo "Carrera no especificada.";
}

$conn->close();
?>
