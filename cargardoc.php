<?php
include "includes/documento.php"; 
require_once "includes/db.php";

$carreraSeleccionada = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $autores = isset($_POST["autores"]) ? $_POST["autores"] : [];
    $categoria = $_POST["categoria"];
    $carreraSeleccionada = $_POST["carrera"];
    $archivoNombre = $_FILES["archivo"]["name"];
    $archivoTemporal = $_FILES["archivo"]["tmp_name"];
    $materia = $_POST["materia"];
    $autorManual = $_POST["autor_manual"];
    $fecha_creacion = date("Y-m-d", strtotime($_POST["fecha_creacion"]));

    $autores = array_merge($autores, [$autorManual]);

    $documento = new Documento(null, $titulo, null, $autores, $categoria, null, $archivoNombre, $materia, $carreraSeleccionada, $fecha_creacion);

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
    <link rel="stylesheet" href="css/cargadoc.css">
    <link rel="icon" type="image/jpg" href="img/favicon.gif"/>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Cargar Documento en el Repositorio</h1>
        <form method="post" action="cargardoc.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" class="form-control" name="titulo" required>
            </div>
            <div class="form-group">
                <label for="autor">Autor(es):</label>
                <select name="autores[]" id="autor" class="form-control" multiple>
                </select>
                <input type="text" class="form-control" name="autor_manual" placeholder="Ingresa el autor manualmente">
                <small class="form-text text-muted">Mantén presionada la tecla Ctrl para seleccionar múltiples autores o ingresa manualmente el autor.</small>
            </div>

            <div class="form-group">
                <label for="categoria">Categoría:</label>
                <select type="text" class="form-control" name="categoria" required>
                    <option value="TP FINAL">Trabajo práctico final</option>
                    <option value="Desarrollo">Desarrollo</option>
                    <option value="Investigacion">Investigación</option>
                </select>
            </div>
            <div class="form-group">
                <label for="carrera">Carrera:</label>
                <select name="carrera" id="carrera" class="form-control" required onchange="actualizarAlumnosPorCarrera()">
                    <option value="DS">Desarrollo de Software</option>
                    <option value="AF">Análisis Funcional de Sistemas</option>
                    <option value="ITI">Infraestructura de Tecnologías de la Información</option>
                </select>
            </div>
            <div class="form-group">
                <label for="anio">Año Cursado:</label>
                <select name="anio" id="anio" class="form-control" onchange="actualizarMaterias()" required>
                    <option value="1er Año">1er Año</option>
                    <option value="2do Año">2do Año</option>
                    <option value="3er Año">3er Año</option>
                </select>
            </div>
            <div class="form-group">
                <label for="materia">Materia:</label>
                <select name="materia" id="materia" class="form-control" required>
                </select>
            </div>
            <div class="form-group">
                <label for="fecha_creacion">Fecha de Creación: </label>
                <input type="date" class="form-control" name="fecha_creacion" required>
            </div>
            <div class="form-group">
                <label for="archivo">Archivo PDF:</label>
                <input type="file" class="form-control-file" name="archivo" accept=".pdf" required>
            </div>
            <button type="submit" class="btn btn-primary">Cargar</button>
        </form>
        <br>
        <a href="documents.php" class="btn btn-secondary">Ver Documentos</a>
        <a href="admin.php" class="btn btn-secondary">Volver a inicio</a>
    </div>

    <script>
        
        function actualizarAlumnosPorCarrera() {
            var carreraSeleccionada = document.getElementById("carrera").value;


            var xhr = new XMLHttpRequest();
            var carreraSeleccionada = document.getElementById("carrera").value;
            var autorSelect = document.getElementById("autor");
            var autorManualInput = document.querySelector('input[name="autor_manual"]');
                if (autorManualInput.value.trim() !== "") {
                    autorSelect.innerHTML = '<option value="' + autorManualInput.value.trim() + '">' + autorManualInput.value.trim() + '</option>';
                } else {
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "alumno.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            var alumnosSelect = document.getElementById("autor");
                            alumnosSelect.innerHTML = "";
                            var alumnos = JSON.parse(xhr.responseText);
                            
                            for (var i = 0; i < alumnos.length; i++) {
                                var alumno = alumnos[i];
                                var option = document.createElement("option");
                                option.text = alumno.nombre + " " + alumno.apellido;
                                option.value = alumno.nombre + " " + alumno.apellido;
                                alumnosSelect.appendChild(option);
                            }
                        }
                    };
                    xhr.send("carrera=" + carreraSeleccionada);
    }
}

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
</body>
</html>