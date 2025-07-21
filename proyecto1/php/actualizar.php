<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$id_turno = isset($_POST['turno_id']) ? intval($_POST['turno_id']) : 0;

if ($id_turno <= 0) {
    die("Turno no válido.");
}

$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$servicio = $_POST['servicio'];
$descripcion = $_POST['descripcion'];
$barbero = $_POST['barbero'];
$whatsapp = isset($_POST['whatsapp']) ? 1 : 0;


$sql = "UPDATE turnos SET fecha = ?, hora = ?, servicio = ?, descripcion = ?, barbero = ?, whatsapp = ? WHERE id = ? AND usuario_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("sssssiis", $fecha, $hora, $servicio, $descripcion, $barbero, $whatsapp, $id_turno, $usuario_id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    header("Location: ver_turno.php?msg=editado");
} else {
    echo "No se pudo actualizar el turno o no hubo cambios.";
}
$stmt->close();
$con->close();
