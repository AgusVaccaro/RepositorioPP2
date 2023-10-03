<?php
require_once "includes/db.php";

$carreraSeleccionada = $_POST["carrera"];

$conn = conexionDB();

$consultaAlumnos = "SELECT nombre, apellido FROM alumnos WHERE carrera = ?";
$stmt = $conn->prepare($consultaAlumnos);
$stmt->bind_param("s", $carreraSeleccionada);
$stmt->execute();
$resultadoAlumnos = $stmt->get_result();

$alumnos = array();

while ($filaAlumno = $resultadoAlumnos->fetch_assoc()) {
    $nombreAlumno = $filaAlumno["nombre"];
    $apellidoAlumno = $filaAlumno["apellido"];
    $nombreCompleto = $nombreAlumno . ' ' . $apellidoAlumno;
    $alumnos[] = array('nombre' => $nombreAlumno, 'apellido' => $apellidoAlumno);
}

$stmt->close();
$conn->close();

echo json_encode($alumnos);
?>