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
        <?php
        // Conectar a la base de datos (debes configurar esto)
        $servername = "localhost:3307";
        $username = "root";
        $password = "";
        $dbname = "repositorio";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("La conexión a la base de datos falló: " . $conn->connect_error);
        }

        // Obtener nombres y apellidos de alumnos desde la tabla "alumnos"
        $consultaAlumnos = "SELECT nombre, apellido FROM alumnos";
        $resultadoAlumnos = $conn->query($consultaAlumnos);

        // Crear el desplegable de autores con nombres y apellidos
        echo '<select name="autor" required>';
        while ($filaAlumno = $resultadoAlumnos->fetch_assoc()) {
            $nombreAlumno = $filaAlumno["nombre"];
            $apellidoAlumno = $filaAlumno["apellido"];
            $nombreCompleto = $nombreAlumno . ' ' . $apellidoAlumno;
            echo '<option value="' . $nombreCompleto . '">' . $nombreCompleto . '</option>';
        }
        echo '</select>';
        ?>
        <br>
        <label for="categoria">Categoría:</label>
        <input type="text" name="categoria" required><br>
        <label for="carrera">Carrera:</label>
        <select name="carrera" required>
        <option value="Desarrollo de Software">Desarrollo de Software</option>
        <option value="Analista Funcional">Analista Funcional</option>
        <option value="Infraestructura de Tecnología de la Información">Infraestructura de Tecnología de la Información</option>
        </select><br>
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
