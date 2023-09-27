<?php
include "includes/db.php";
include "requires/documento.php"; 

if (isset($_GET["id"])) {
    $documentoID = $_GET["id"];

    $documento = new Documento($documentoID, null, null, null, null, null, null, null, null);


    $resultado = $documento->eliminarDocumento();
    
    echo $resultado;
}
?>


