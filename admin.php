<?
//include "includes/db.php";
include "includes/documento.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repositorio Académico</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" type="image/jpg" href="img/favicon.gif"/>
</head>
<body>
    
    <div class="header">
        <h1>Repositorio Académico</h1>
        <h3>Instituto Superior de Comercio N°49 Cap. Gral. J. J. de Urquiza</h3>
        <?php
            session_start();
            if (isset($_SESSION["nombreUsuario"])) {
                $nombreUsuario = $_SESSION["nombreUsuario"];
                echo "Bienvenido/a " . $nombreUsuario;
            }
        ?> 
    </div>
    <!-- Menú de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container d-flex justify-content-between">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="documents.php">Ver Documentos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cargardoc.php">Cargar Documento</a>
            </li>
        </ul>
        <a class="nav-link" href="#">Volver a página principal</a>
    </div>                                                       
</nav>

<div class="container mt-2">
    <a class="btn btn-danger float-right" href="logout.php">Cerrar Sesión</a>
</div>

<!-- Imágenes -->
<div class="container">
    <div class="row">
        <div class="col">
            <img src="img/af.jpg" alt="Imagen 1" class="img-fluid">
        </div>>
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
