<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

$sql = "SELECT * FROM turnos WHERE usuario_id = ? ORDER BY creado_en DESC";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
<head>
  <meta charset="UTF-8">
  <title>Historial de Turnos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
      <li><a href="ver_turno.php" class="nav-link px-3 text-white">Ver mi Turno</a></li>
      <li><a href="historial.php" class="nav-link px-3 text-success fw-bold">Historial</a></li>
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
  <h2 class="text-white text-center mb-4">Historial de Turnos</h2>

  <?php if ($resultado->num_rows > 0): ?>
    <div class="table-responsive bg-light text-dark p-4 rounded shadow">
      <table class="table table-striped table-bordered">
        <thead class="table-dark">
          <tr>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Servicio</th>
            <th>Barbero</th>
            <th>Estado</th>
            <th>Creado</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $resultado->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['fecha']) ?></td>
              <td><?= htmlspecialchars($row['hora']) ?></td>
              <td><?= htmlspecialchars($row['servicio']) ?></td>
              <td><?= htmlspecialchars($row['barbero']) ?></td>
              <td>
                <?php if ($row['estado'] == 'cancelado'): ?>
                  <span class="badge bg-danger">Cancelado</span>
                <?php else: ?>
                  <span class="badge bg-success">Activo</span>
                <?php endif; ?>
              </td>
              <td><?= htmlspecialchars($row['creado_en']) ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  <?php else: ?>
    <div class="alert alert-info text-center">Aún no tenés turnos registrados.</div>
  <?php endif; ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
