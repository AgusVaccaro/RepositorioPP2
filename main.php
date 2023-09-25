<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repositorio Académico</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    
    <div class="header">
        <h1>Repositorio acádemico</h1>
        <h3>Instituto Superior de Comercio N°49 Cap. Gral. J. J. de Urquiza</h3>
        <?php
    session_start();
    if (isset($_SESSION["nombreUsuario"])) {
        $nombreUsuario = $_SESSION["nombreUsuario"];
        echo "Bienvenido/a " . $nombreUsuario;
    } else {
        // El usuario no ha iniciado sesión, puedes mostrar un mensaje o redirigirlo al inicio de sesión
    }
    ?> 
    </div>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="documents.php">Ver Documentos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cargardoc.php">Cargar Documento</a>
                </li>
            </ul>
        </div>                                                       
    </nav>
    
    <div class="container">
    <a href="logout.php">Cerrar Sesión</a> 
      
    </div>
</body>
</html>
                               
