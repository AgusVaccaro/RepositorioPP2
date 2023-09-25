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

// Obtener datos del formulario
$titulo = $_POST["titulo"];
$autor = $_POST["autor"];
$categoria = $_POST["categoria"];
$carrera = $_POST["carrera"];

// Procesar la carga del archivo
$archivoNombre = $_FILES["archivo"]["name"];
$archivoTemporal = $_FILES["archivo"]["tmp_name"];
$archivoDestino = "uploads/" . $archivoNombre;

if (move_uploaded_file($archivoTemporal, $archivoDestino)) {
    $fechaCarga = date('Y-m-d H:i:s'); 

    $sql = "INSERT INTO documentos (titulo, autor, categoria, archivo, carrera, fecha_de_carga) VALUES ('$titulo', '$autor', '$categoria', '$archivoNombre', '$carrera', '$fechaCarga')";
    
    
    if ($conn->query($sql) === TRUE) {
        echo "Documento cargado y registrado en la base de datos con éxito.";
    } else {
        echo "Error al registrar el documento en la base de datos: " . $conn->error;
    }
} else {
    echo "Error al subir el archivo.";
}

$conn->close();
header("Location: documents.php");
exit;

?>
