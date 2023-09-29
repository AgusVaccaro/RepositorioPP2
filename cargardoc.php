<?php
include "includes/documento.php"; 
require_once "includes/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $autor = $_POST["autor"];
    $categoria = $_POST["categoria"];
    $carrera = $_POST["carrera"];
    $archivoNombre = $_FILES["archivo"]["name"];
    $archivoTemporal = $_FILES["archivo"]["tmp_name"];
    $materia = $_POST["materia"];

    $documento = new Documento(null, $titulo, null, $autor, $categoria, null, $archivoNombre, $materia, $carrera);

    $resultado = $documento->cargarDocumento($archivoTemporal);
    
    echo $resultado;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargar Documento - Repositorio Académico</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <script>
        function actualizarMaterias() {
            var carrera = document.getElementById("carrera").value;
            var anio = document.getElementById("anio").value;
            var materiasDS = {
                "1er Año": ["Adminstración", "Comunicación", "Ing. de Software", "Inglés Técnico", "Matemáticas", "LED", "Sistemas Operativos", "Técnicas de la Información", "UDI"],
                "2do Año": ["Bases de Datos", "Estadistica", "Ing. de Software II", "Inglés Técnico II", "Innovación y Desarrollo Emprendedor", "Práctica Profesionalizante", "Problemática Sociocontemporánea", "Programación", "UDI II" ],
                "3er Año": ["Bases de Datos II", "Derecho", "Ética", "Gestión de Proyectos", "Práctica Profesionalizante II", "Programación II", "Redes y Comunicación"]
            };
            var materiasAF = {
                "1er Año": ["Comunicación", "UDI", "Matemática", "Inglés Técnico", "Psicosociología de las Organizaciones", "Modelos de Negocios", "Arquitectura de las Computadoras", "Gestión de Software", "Análisis de Sistemas Organizacionales"],
                "2do Año": ["Problemáticas Sociocontemporáneas", "UDI II", "Inglés Técnico II", "Estadística", "Innovación y Desarrollo Emprendedor", "Gestión de Software II", "Estrategias de Negocios", "Desarrollo de Sistemas", "Practica Profesionalizante"],
                "3er Año": ["Ética y Responsabilidad Social", "Derecho y Legislación Laboral", "Redes y Comunicaciones", "Seguridad de los Sistemas", "Bases de Datos", "Sistema de Información Organizacional", "Desarrollo de Sistemas Web", "Práctica Profesionalizante II"]
            };
            var materiasITI = {
                "1er Año": ["Administración", "Comunicación", "UDI", "Matemáticas", "Fisica Aplicada a las Tec. de la Inf.", "Inglés Técnico", "Arquitectura de las computadoras", "Lógica y Programación", "Infraestructura de Redes"],
                "2do Año": ["Problemáticas Sociocontemporáneas", "UDI II", "Estadística", "Innovación y Desarrollo Emprendedor", "Sistemas Operativos", "Algoritmos y Estructura de Datos", "Bases de Datos", "Infraestructura de Redes II", "Práctica Profesionalizante"],
                "3er Año": ["Ética", "Derecho", "Administración de Bases de Datos", "Seguridad de los Sistemas", "Integridad y Migración de Datos", "Administración de Sistemas Operativos", "Práctica Profesionalizante II"]
            }
            var materiaSelect = document.getElementById("materia");

            while (materiaSelect.options.length > 0) {
                materiaSelect.remove(0);
            }

            var materias;

            if (carrera === "DS") {
                materias = materiasDS[anio];
            } else if (carrera === "AF") {
                materias = materiasAF[anio];
            } else if (carrera === "ITI") {
                materias = materiasITI[anio];
            }

            if (materias && materias.length > 0) {
                for (var i = 0; i < materias.length; i++) {
                    var option = document.createElement("option");
                    option.text = materias[i];
                    option.value = materias[i];
                    materiaSelect.appendChild(option);
                }
            } else {
                var option = document.createElement("option");
                option.text = "Seleccione un año válido";
                option.value = "";
                materiaSelect.appendChild(option);
            }
        }
    </script>
</head>
<body>
    <center>
    <h1>Cargar Documento en el Repositorio</h1>
    <form method="post" action="cargardoc.php" enctype="multipart/form-data">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" required><br>
        <label for="autor">Autor:</label>
        <select name="autor" required>
            <?php
            $consultaAlumnos = "SELECT nombre, apellido FROM alumnos";
            $resultadoAlumnos = $conn->query($consultaAlumnos);

            while ($filaAlumno = $resultadoAlumnos->fetch_assoc()) {
                $nombreAlumno = $filaAlumno["nombre"];
                $apellidoAlumno = $filaAlumno["apellido"];
                $nombreCompleto = $nombreAlumno . ' ' . $apellidoAlumno;
                echo '<option value="' . $nombreCompleto . '">' . $nombreCompleto . '</option>';
            }
            ?>
        </select><br>
        <label for="categoria">Categoría:</label>
        <input type="text" name="categoria" required><br>
        <label for="carrera">Carrera:</label>
        <select name="carrera" id="carrera" required onchange="actualizarMaterias()">
            <option value="DS">Desarrollo de Software</option>
            <option value="AF">Analisis Funcional de Sistemas</option>
            <option value="ITI">Infraestructura de Tecnologías de la Información</option>
        </select><br>

        <!-- Campo de selección para el año cursado -->
        <label for="anio">Año Cursado:</label>
        <select name="anio" id="anio" onchange="actualizarMaterias()" required>
            <option value="1er Año">1er Año</option>
            <option value="2do Año">2do Año</option>
            <option value="3er Año">3er Año</option>
        </select><br>

        <label for="materia">Materia:</label>
        <select name="materia" id="materia" required>
            <!-- Las opciones de materia se generarán dinámicamente usando JavaScript -->
        </select><br>

        <label for="archivo">Archivo PDF:</label>
        <input type="file" name="archivo" accept=".pdf" required><br>
        <input type="submit" value="Cargar">
    </form>

    <br><a href="documents.php">Ver Documentos</a>
    <br><a href="admin.php">Volver a inicio</a>
    </center>
</body>
</html>
