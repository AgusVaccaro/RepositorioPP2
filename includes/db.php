<?php
function conexionDB() {
    $servername = "localhost:3307";
    $username = "root";
    $password = "";
    $dbname = "repositorio";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("La conexión a la base de datos falló: " . $conn->connect_error);
    }

    return $conn; 
}
$conn = conexionDB();
?>
