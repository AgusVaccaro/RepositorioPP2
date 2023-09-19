<!DOCTYPE html>
<html>
<head>
    <title>Documentos - Repositorio Académico</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <center>
    <h1>Documentos en el Repositorio Académico</h1>

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

    // Consulta para obtener documentos desde la base de datos (esto puede variar según tu estructura de datos)
    $sql = "SELECT id, titulo, autor, categoria, archivo FROM documentos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Categoría</th>
                    <th>Enlace</th>
                    <th>Eliminar documento</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["titulo"] . "</td>";
            echo "<td>" . $row["autor"] . "</td>";
            echo "<td>" . $row["categoria"] . "</td>";
            echo "<td><a href='uploads/" . $row["archivo"] . "' target='_blank'>Descargar</a></td>";
            echo "<td><a href='delete.php?id=" . $row["id"] . "'>Eliminar</a></td>"; 
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron documentos."; echo '<a href="cargardoc.php"> Cargar documento </a>';
  
    }

    $conn->close();
    echo '<br><a href="cargardoc.php">Cargar documento</a>';
    echo '<br><a href="main.php">Volver a inicio</a>';
    ?>
    </center>
</body>
</html>
