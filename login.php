<?php
include "includes/db.php";
include "includes/documento.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreUsuario = $_POST["nombreUsuario"];
    $contrasena = $_POST["contrasena"];


    if (autenticarUsuario($nombreUsuario, $contrasena)) {
        $_SESSION["nombreUsuario"] = $nombreUsuario;
        header("Location: index.php"); 
        exit();
    } else {
        
        echo "Nombre de usuario o contraseña incorrectos.";
    }
}

function autenticarUsuario($nombreUsuario, $contrasena) {
    if ($nombreUsuario == "admin" && $contrasena == "Urquiza49") {
        session_start();
        $_SESSION["nombreUsuario"] = $nombreUsuario;
        header("Location: admin.php"); 
        exit();
    } else {

        echo "Nombre de usuario o contraseña incorrectos.";
    }

    return false; 
}




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreUsuario = $_POST["nombreUsuario"];
    $contrasena = $_POST["contrasena"];

}
?>
