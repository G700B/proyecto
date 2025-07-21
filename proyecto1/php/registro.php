<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro - Barbería Estilo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <script src="../js/validar_r.js"></script>

</head>
<body>

  <header class="p-3 border-bottom bg-dark fixed-top">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-between">
        <a href="index.html" class="d-flex align-items-center text-white text-decoration-none">
          <i class="fa-solid fa-scissors fa-2x me-2"></i>
          <span class="fs-4">Barbería Estilo</span>
        </a>

        <ul class="nav col-12 col-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="index.html#inicio" class="nav-link px-3 text-white">Inicio</a></li>
          <li><a href="index.html#servicios" class="nav-link px-3 text-white">Servicios</a></li>
          <li><a href="index.html#precios" class="nav-link px-3 text-white">Precios</a></li>
          <li><a href="index.html#nosotros" class="nav-link px-3 text-white">Nosotros</a></li>
        </ul>

        <div class="text-end">
          <a href="login.php"><button type="button" class="btn btn-outline-primary me-2">Login</button></a>
          <a href="registro.php"><button type="button" class="btn btn-primary">Registrarse</button></a>
        </div>
      </div>
    </div>
  </header>


  <main class="d-flex align-items-center justify-content-center mt-5 pt-5" style="min-height: 100vh;">
    <div class="container d-flex flex-column flex-md-row align-items-center justify-content-center gap-5">

 
      <div class="text-white benefits">
        <div class="d-flex align-items-center mb-4 logo">
          <i class="fa-solid fa-scissors fa-2x"></i>
          <span>Barbería Estilo</span>
        </div>
        <ul class="list-unstyled fs-5">
          <li><i class="fa-solid fa-check-circle me-2"></i>Registrate en segundos.</li>
          <li><i class="fa-solid fa-check-circle me-2"></i>Reservá turnos desde tu cuenta.</li>
          <li><i class="fa-solid fa-check-circle me-2"></i>Historial y soporte personalizado.</li>
          <li><i class="fa-solid fa-check-circle me-2"></i>10 años de experiencia.</li>
        </ul>
      </div>


      <div class="card-login shadow">
        <h4 class="text-center mb-3">Crear cuenta</h4>
        <form action="registros.php" method="POST">
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Juan" required>
          </div>
          <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Pérez" required>
          </div>
          <div class="mb-3">
  <label for="fecha_nac" class="form-label">Fecha de nacimiento</label>
  <input type="date" class="form-control" id="fecha_nac" name="fecha_nac" required>
</div>
          <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="11 2345-6789" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="correo@mail.com" required>
          </div>
          <div class="mb-4">
            <label for="clave" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="clave" name="clave" placeholder="••••••••" required>
          </div>
          <button type="submit" class="btn btn-success w-100">Registrarme</button>
        </form>
        <p class="mt-3 text-center">¿Ya tenés cuenta? <a href="login.php">Iniciá sesión</a></p>
      </div>

    </div>
  </main>

  <footer class="bg-dark text-center text-white py-4 border-top">
    <div class="container">
      <p>&copy; 2025 Barbería Estilo. Todos los derechos reservados.</p>
      <p>
        <i class="fa-brands fa-instagram me-2"></i>
        <i class="fa-brands fa-facebook me-2"></i>
        <i class="fa-brands fa-whatsapp"></i>
      </p>
    </div>
  </footer>
<script src="../js/validar_r.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
