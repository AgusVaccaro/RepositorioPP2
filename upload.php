<?php
require_once "includes/db.php"; 
include "includes/documento.php";

$titulo = $_POST["titulo"];
$autor = $_POST["autor"];
$categoria = $_POST["categoria"];
$carrera = $_POST["carrera"];
$fecha_creacion = $_POST["fecha_creacion"];
$archivoNombre = $_FILES["archivo"]["name"];
$archivoTemporal = $_FILES["archivo"]["tmp_name"];
$archivoDestino = "uploads/" . $archivoNombre;

if (move_uploaded_file($archivoTemporal, $archivoDestino)) {
    $fechaCarga = date('Y-m-d');
    
    $sql = "INSERT INTO documentos (titulo, autor, categoria, archivo, carrera, fecha_de_carga, fecha_creacion) VALUES (?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssssss", $titulo, $autor, $categoria, $archivoNombre, $carrera, $fechaCarga, $fecha_creacion);
        if ($stmt->execute()) {
            echo "Documento cargado y registrado en la base de datos con éxito.";
        } else {
            echo "Error al registrar el documento en la base de datos: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error de preparación de la consulta: " . $conn->error;
    }
} else {
    echo "Error al subir el archivo.";
}

$conn->close();
header("Location: documents.php");
exit;

