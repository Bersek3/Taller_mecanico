<?php
    // No es necesario manejar sesión o roles aquí porque no estamos autenticando a los usuarios
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../backend/css/admin.css">
    <link rel="icon" type="image/png" sizes="96x96" href="../../backend/img/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
    <title>Taller Automotriz</title>
</head>
<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">Taller Automotriz</a>
        <ul class="side-menu">
            <li><a href="#" class="active"><i class='bx bxs-dashboard icon'></i> Bienvenido</a></li>
            <li><a href="/frontend/login.php"><i class='bx bxs-log-in-circle icon'></i> Iniciar Sesion</a></li>
            <li class="divider" data-text="main">Main</li>
            <li>
                <a href="/frontend/citas/cita_login.php"><i class='bx bxs-book-alt icon'></i> Agendar Cita</a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- NAVBAR -->
    <section id="content">
        <nav>
            <i class='bx bx-menu toggle-sidebar'></i>
            <span class="divider"></span>
            <div class="profile">
                <ul class="profile-link">
                    <li><a href="../salir.php"><i class='bx bxs-log-out-circle'></i> Salir</a></li>
                </ul>
            </div>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>

        </main>
        <!-- MAIN -->
    </section>

    <script src="../../backend/js/jquery.min.js"></script>
    <script src="../../backend/js/script.js"></script>
    <script src="../../backend/js/multistep.js"></script>
    <script src="../../backend/js/vpat.js"></script>
    <script src="../../backend/js/cliente.js"></script>
    <script src="../../backend/js/mecanico.js"></script>
    <script src="../../backend/js/especialidad.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</body>
</html>
