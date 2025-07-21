<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['turno_id'])) {
    $turno_id = $_POST['turno_id'];

    // Cambiar el estado del turno a 'cancelado'
    $stmt = $con->prepare("UPDATE turnos SET estado = 'cancelado' WHERE id = ? AND estado = 'activo'");
    $stmt->bind_param("i", $turno_id);

    if ($stmt->execute()) {
        $_SESSION['mensaje'] = "Turno cancelado correctamente.";
    } else {
        $_SESSION['error'] = "Error al cancelar el turno.";
    }
    $stmt->close();
} else {
    $_SESSION['error'] = "Datos inválidos.";
}

// Redirigir de vuelta al panel admin (ajusta la ruta si es necesario)
header("Location: panel_admin.php");
exit();
?>
