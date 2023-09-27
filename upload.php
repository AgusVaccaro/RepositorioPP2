<?php
include "includes/db.php";
include "includes/documento.php";

$titulo = $_POST["titulo"];
$autor = $_POST["autor"];
$categoria = $_POST["categoria"];
$carrera = $_POST["carrera"];


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
