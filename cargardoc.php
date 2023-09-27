<?php
include "includes/documento.php"; 
require_once "includes/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $autor = $_POST["autor"];
    $categoria = $_POST["categoria"];
    $materia = $_POST["materia"]; // Agrega la variable $materia
    $carrera = $_POST["carrera"];
    $archivoNombre = $_FILES["archivo"]["name"];
    $archivoTemporal = $_FILES["archivo"]["tmp_name"];

    $documento = new Documento(null, $titulo, null, $autor, $categoria, null, $archivoNombre, $materia, $carrera);

    $resultado = $documento->cargarDocumento($archivoTemporal);
    
    echo $resultado;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargar Documento - Repositorio Académico</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <center>
    <h1>Cargar Documento en el Repositorio</h1>
    <form method="post" action="cargardoc.php" enctype="multipart/form-data">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" required><br>
        <label for="autor">Autor:</label>
        <select name="autor" required>
            <?php
            $consultaAlumnos = "SELECT nombre, apellido FROM alumnos";
            $resultadoAlumnos = $conn->query($consultaAlumnos);

            while ($filaAlumno = $resultadoAlumnos->fetch_assoc()) {
                $nombreAlumno = $filaAlumno["nombre"];
                $apellidoAlumno = $filaAlumno["apellido"];
                $nombreCompleto = $nombreAlumno . ' ' . $apellidoAlumno;
                echo '<option value="' . $nombreCompleto . '">' . $nombreCompleto . '</option>';
            }
            ?>
        </select><br>
        </select><br>
        <label for="categoria">Categoría:</label>
        <input type="text" name="categoria" required><br>
        <label for="mateira">Materia:</label>
        <input type="text" name="materia" required><br>
        <label for="carrera">Carrera:</label>
        <select name="carrera" required>
            <option value="Desarrollo de Software">DS</option>
            <option value="Analista Funcional">AF</option>
            <option value="Infraestructura de Tecnología de la Información">ITI</option>
        </select><br>
        <label for="archivo">Archivo PDF:</label>
        <input type="file" name="archivo" accept=".pdf" required><br>
        <input type="submit" value="Cargar">
    </form>

    <br><a href="documents.php">Ver Documentos</a>
    <br><a href="admin.php">Volver a inicio</a>
    </center>
</body>
</html>
