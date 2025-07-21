<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id  = $_SESSION['usuario_id'];
$fecha       = $_POST['fecha_turno'] ?? null;
$hora        = $_POST['hora_turno'] ?? null;
$servicio    = $_POST['servicio'] ?? null;
$descripcion = trim($_POST['descripcion'] ?? '');
$barbero     = $_POST['barbero'] ?? null;
$whatsapp    = isset($_POST['whatsapp_confirm']) ? 1 : 0;
$creado_en   = date("Y-m-d H:i:s");

$barbero = $barbero === '' ? null : $barbero;

if (!$fecha || !$hora || !$servicio || empty($descripcion)) {
    echo "Faltan datos obligatorios.";
    exit();
}

$stmt = $con->prepare("INSERT INTO turnos (usuario_id, fecha, hora, servicio, descripcion, barbero, whatsapp, creado_en)
                       VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $con->error);
}

$stmt->bind_param("isssisds", $usuario_id, $fecha, $hora, $servicio, $descripcion, $barbero, $whatsapp, $creado_en);

if ($stmt->execute()) {
    echo "<script>
            alert('Turno registrado con éxito');
            window.location.href = 'index2.php';
          </script>";
    exit();
} else {
    echo "Error al guardar el turno: " . $stmt->error;
}

$stmt->close();
$con->close();
?>
