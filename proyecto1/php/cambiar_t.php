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
    die("Turno no válido.");
}

$sql = "SELECT * FROM turnos WHERE id = ? AND usuario_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("ii", $id_turno, $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    die("No se encontró el turno o no te pertenece.");
}

$turno = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>Editar Turno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<header class="p-3 border-bottom bg-dark fixed-top">
  <div class="container d-flex justify-content-between align-items-center">
     <img src="../img/T.O.png" alt="Logo" style="height: 60px;">
    <a href="../index.php" class="text-white text-decoration-none d-flex align-items-center">
      <i class="fa-solid fa-scissors fa-2x me-2"></i>
      <span class="fs-4">Barbería Estilo</span>
    </a>
    <ul class="nav mb-0">
      <li><a href="index2.php" class="nav-link px-3 text-white">Inicio</a></li>
      <li><a href="index2.php#turno" class="nav-link px-3 text-white">Reservar Turno</a></li>
      <li><a href="ver_turno.php" class="nav-link px-3 text-success fw-bold">Ver mi Turno</a></li>
      <li><a href="historial.php" class="nav-link px-3 text-white">Historial</a></li>

    </ul>
    <div class="text-end">
      <?php if (isset($_SESSION['usuario_nombre'])): ?>
        <div class="dropdown">
          <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
            <i class="fa-solid fa-user"></i> <?= htmlspecialchars($_SESSION['usuario_nombre']) ?>
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="cerrar_sesion.php">Cerrar sesión</a></li>
          </ul>
        </div>
      <?php endif; ?>
    </div>
  </div>
</header>


 <main class="container pt-5 mt-5">
    <h2 class="mb-4 text-center text-white">Editar Turno</h2>
    <form action="actualizar_turno.php" method="POST" class="bg-light text-dark p-4 rounded shadow mx-auto" style="max-width: 600px;">
        <input type="hidden" name="turno_id" value="<?= $turno['id'] ?>">

        <div class="mb-3">
            <label class="form-label">Fecha:</label>
            <input type="date" name="fecha" class="form-control" value="<?= $turno['fecha'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Hora:</label>
            <input type="time" name="hora" class="form-control" value="<?= $turno['hora'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Servicio:</label>
            <input type="text" name="servicio" class="form-control" value="<?= $turno['servicio'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción:</label>
            <textarea name="descripcion" class="form-control" rows="3"><?= $turno['descripcion'] ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Barbero:</label>
            <input type="text" name="barbero" class="form-control" value="<?= $turno['barbero'] ?>">
        </div>

        <div class="form-check mb-4">
            <input type="checkbox" class="form-check-input" name="whatsapp" value="1" <?= $turno['whatsapp'] ? 'checked' : '' ?>>
            <label class="form-check-label">Confirmación por WhatsApp</label>
        </div>

        <div class="d-flex justify-content-between">
            <a href="ver_turno.php" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </div>
    </form>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
