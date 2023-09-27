<?php
require_once "includes/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procesa el formulario de edición aquí y actualiza la base de datos
    $id = $_POST["id"];
    $nuevo_titulo = $_POST["nuevo_titulo"];
    $nuevo_autor = $_POST["nuevo_autor"];
    $nueva_categoria = $_POST["nueva_categoria"];
    $nueva_materia = $_POST["nueva_materia"];
    $nueva_carrera = $_POST["nueva_carrera"];


    // Ejecuta una consulta SQL UPDATE para actualizar los detalles del documento en la base de datos
    $sql = "UPDATE documentos SET titulo = ?, autor = ?, categoria = ?, carrera = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $nuevo_titulo, $nuevo_autor, $nueva_categoria, $nueva_materia, $nueva_carrera, $id);

    if ($stmt->execute()) {
        // Redirige al usuario a la página de detalles del documento o a la lista de documentos
        header("Location: documents.php");
        exit();
    } else {
        $error = "Error al actualizar el documento: " . $stmt->error;
    }
} else {
    // Recupera el documento existente para mostrarlo en el formulario
    $id = $_GET["id"];
    $sql = "SELECT * FROM documentos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
    } else {
        $error = "Documento no encontrado.";
    }
}

// Cierra la conexión
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Encabezado HTML y enlaces a CSS/JS aquí -->
</head>
<body>
    <h1>Editar Documento</h1>

    <?php if (isset($error)) { echo "<p>Error: $error</p>"; } ?>

    <form method="post" action="edit.php">
        <!-- Campos del formulario para editar los detalles del documento aquí -->
        <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
        <label for="nuevo_titulo">Nuevo Título:</label>
        <input type="text" name="nuevo_titulo" value="<?php echo $row["titulo"]; ?>" required><br>
        <label for="nuevo_autor">Nuevo Autor:</label>
        <input type="text" name="nuevo_autor" value="<?php echo $row["autor"]; ?>" required><br>
        <label for="nueva_categoria">Nueva Categoría:</label>
        <input type="text" name="nueva_categoria" value="<?php echo $row["categoria"]; ?>" required><br>
        <label for="nueva_categoria">Nueva Materia:</label>
        <input type="text" name="nueva_materia" value="<?php echo $row["materia"]; ?>" required><br>
        <label for="nueva_carrera">Nueva Carrera:</label>
        <input type="text" name="nueva_carrera" value="<?php echo $row["carrera"]; ?>" required><br>
        <input type="submit" value="Guardar Cambios">
    </form>

    <a href="documents.php">Volver a la Lista de Documentos</a>
</body>
</html>
