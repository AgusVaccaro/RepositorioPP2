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
    <form method="post" action="upload.php" enctype="multipart/form-data">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" required><br>
        <label for="autor">Autor:</label>
        <input type="text" name="autor" required><br>
        <label for="categoria">Categoría:</label>
        <input type="text" name="categoria" required><br>
        <label for="archivo">Archivo PDF:</label>
        <input type="file" name="archivo" accept=".pdf" required><br>
        <input type="submit" value="Cargar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Procesar el formulario de carga aquí, incluido el manejo del archivo PDF
        // ...
    }
    echo '<br><a href="documents.php">Ver Documentos</a>';
    echo '<br><a href="main.php">Volver a inicio</a>';
    ?>
    </center>
</body>
</html>



