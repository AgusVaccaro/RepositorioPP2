<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repositorio Académico</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
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
    }
    ?> 
    </div>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container d-flex justify-content-between">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="documentos.php">Ver Documentos</a>
            </li>
        </ul>
        <a class="nav-link" href="#">Volver a página principal</a>
    </div>                                                       
    </nav>
    
    <div class="container">
    <a href="iniciarses.php">Iniciar Sesión</a> 

    <div class="container">
    <div class="row">
        <div class="col">
            <img src="img/af.jpg" alt="Imagen 1" class="img-fluid">
        </div>
        <div class="col">
            <img src="img/ds.jpg" alt="Imagen 2" class="img-fluid">
        </div>
        <div class="col">
            <img src="img/iti.jpg" alt="Imagen 3" class="img-fluid">
        </div>
    </div>
</div>

</body>
</html>

      
    </div>
</body>
</html>
                               