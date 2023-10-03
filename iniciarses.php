<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Repositorio Académico</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/pass.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <center>
    <h1>Iniciar Sesión</h1>
    <form method="post" action="login.php">
        <label for="nombreUsuario">Nombre de Usuario:</label>
        <input type="text" name="nombreUsuario" required><br>
        <label for="contrasena">Contraseña:</label>
        <div class="password-container">
            <input type="password" name="contrasena" class="password1" required>
            <i class="far fa-eye show-password password-icon"></i>
        </div>
        <input type="submit" value="Iniciar Sesión"><br><br>
        <a href="index.php">Continuar sin iniciar sesión</a>
    </form>
    </center>
    <script src="js/pass.js"></script>
</body>
</html>
