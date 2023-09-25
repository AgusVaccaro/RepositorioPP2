<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "repositorio";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

if (isset($_GET["id"])) {
    $documentoId = $_GET["id"];

    $sql = "DELETE FROM documentos WHERE id = $documentoId";

    if ($conn->query($sql) === TRUE) {
        echo "El documento ha sido eliminado correctamente.";
    } else {
        echo "Error al eliminar el documento: " . $conn->error;
    }
} else {
    echo "ID de documento no proporcionado.";
}

$conn->close();

header("Location: documents.php");
exit;
?>
