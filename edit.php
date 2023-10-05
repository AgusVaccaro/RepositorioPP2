<?php
require_once "includes/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];
    $nuevo_titulo = $_POST["nuevo_titulo"];
    $nuevo_autor = $_POST["nuevo_autor"];
    $nueva_categoria = $_POST["nueva_categoria"];
    $nueva_materia = $_POST["nueva_materia"];
    $nueva_carrera = $_POST["nueva_carrera"];
    $nueva_fecha_creacion = $_POST["nueva_fecha_creacion"];



    $sql = "UPDATE documentos SET titulo = ?, autor = ?, categoria = ?,  materia = ?, carrera = ?, fecha_creacion = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $nuevo_titulo, $nuevo_autor, $nueva_categoria, $nueva_materia, $nueva_carrera, $nueva_fecha_creacion, $id);

    if ($stmt->execute()) {

        header("Location: documents.php");
        exit();
    } else {
        $error = "Error al actualizar el documento: " . $stmt->error;
    }
} else {

    $id = $_GET["id"];
    $sql = "SELECT * FROM documentos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
    } else {
        $error = "Documento no encontrado.";
    }
}


$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Documento</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" type="image/jpg" href="img/favicon.gif"/>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center">Editar Documento</h1>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error; ?>
                            </div>
                        <?php } ?>
                        <form method="post" action="edit.php">
                            <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
                            <div class="form-group">
                                <label for="nuevo_titulo">Nuevo Título:</label>
                                <input type="text" class="form-control" name="nuevo_titulo" value="<?php echo $row["titulo"]; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="nuevo_autor">Nuevo Autor:</label>
                                <input type="text" class="form-control" name="nuevo_autor" value="<?php echo $row["autor"]; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="nueva_categoria">Nueva Categoría:</label>
                                <input type="text" class="form-control" name="nueva_categoria" value="<?php echo $row["categoria"]; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="nueva_materia">Nueva Materia:</label>
                                <input type="text" class="form-control" name="nueva_materia" value="<?php echo $row["materia"]; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="nueva_carrera">Nueva Carrera:</label>
                                <select class="form-control" name="nueva_carrera" id="nueva_carrera" required onchange="actualizarMaterias()">
                                    <option value="DS">Desarrollo de Software</option>
                                    <option value="AF">Analisis Funcional de Sistemas</option>
                                    <option value="ITI">Infraestructura de Tecnologías de la Información</option>
                                </select>
                            </div>
                            <div>
                                <label for="nueva_fecha_creacion">Modificar fecha de creación:</label>
                                <input type="date" class="form-control" name="nueva_fecha_creacion" value="<?php echo $row["fecha_creacion"]; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="anio">Año Cursado:</label>
                                <select class="form-control" name="anio" id="anio" onchange="actualizarMaterias()" required>
                                    <option value="1er Año">1er Año</option>
                                    <option value="2do Año">2do Año</option>
                                    <option value="3er Año">3er Año</option>
                                </select>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <a href="documents.php" class="btn btn-secondary">Volver a la Lista de Documentos</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
