<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreUsuario = $_POST["nombreUsuario"];
    $contrasena = $_POST["contrasena"];

    // Realiza la autenticación en la base de datos, compara con las credenciales almacenadas
    // Si la autenticación es exitosa, redirige a la página principal
    if (autenticarUsuario($nombreUsuario, $contrasena)) {
        $_SESSION["nombreUsuario"] = $nombreUsuario;
        header("Location: index.php"); // Redirige a la página principal después del inicio de sesión exitoso
        exit();
    } else {
        // Autenticación fallida, muestra un mensaje de error o realiza acciones necesarias
        echo "Nombre de usuario o contraseña incorrectos.";
    }
}

function autenticarUsuario($nombreUsuario, $contrasena) {
    if ($nombreUsuario == "admin" && $contrasena == "Urquiza49") {
        // Autenticación exitosa, establece una sesión o cookies según tus preferencias
        session_start();
        $_SESSION["nombreUsuario"] = $nombreUsuario;
        header("Location: main.php"); // Redirige a la página principal
        exit();
    } else {
        // Autenticación fallida, muestra un mensaje de error o realiza acciones necesarias
        echo "Nombre de usuario o contraseña incorrectos.";
    }

    return false; // Debes implementar esta función de autenticación correctamente
}
?>

<?php
// Procesar el inicio de sesión aquí
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreUsuario = $_POST["nombreUsuario"];
    $contrasena = $_POST["contrasena"];

    // Realiza la autenticación en la base de datos, compara con las credenciales almacenadas
    // Si la autenticación es exitosa, redirige a la página principal
   
}
?>
