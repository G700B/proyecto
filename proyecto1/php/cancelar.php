<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$id_turno = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id_turno <= 0) {
    die("ID de turno no válido.");
}


$sql = "UPDATE turnos SET estado = 'cancelado' WHERE id = ? AND usuario_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("ii", $id_turno, $usuario_id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    header("Location: ver_turno.php?msg=cancelado");
} else {
    echo "No se pudo cancelar el turno o ya fue cancelado.";
}
$stmt->close();
$con->close();
