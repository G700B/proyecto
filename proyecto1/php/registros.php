<?php
include("conexion.php");

if (isset($_POST['email'])) {
    $nombre     = $_POST['nombre'];
    $apellido   = $_POST['apellido'];
    $fecha_nac  = $_POST['fecha_nac'];
    $telefono   = $_POST['telefono'];
    $email      = $_POST['email'];
    $clave      = $_POST['clave'];

    $stmt = $con->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>alert('Este correo ya está registrado'); window.history.back();</script>";
        $stmt->close();
        exit;
    }
    $stmt->close();

    $clave_encriptada = password_hash($clave, PASSWORD_DEFAULT);

    $stmt = $con->prepare("INSERT INTO usuarios (nombre, apellido, fecha, telefono, email, pass) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nombre, $apellido, $fecha_nac, $telefono, $email, $clave_encriptada);

    if ($stmt->execute()) {
        echo "<script>alert('Registro exitoso'); window.location.href = 'login.php';</script>";
    } else {
        echo "<script>alert('Error al registrar.'); window.history.back();</script>";
    }

    $stmt->close();

} else {
    echo "<script>alert('Acceso no permitido'); window.location.href = 'registro.php';</script>";
}
?>
