<?php
    ob_start(); 
    session_start(); 

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../backend/css/admin.css">
    <link rel="icon" type="image/png" sizes="96x96" href="../../backend/img/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
    <title>Taller Automotriz | Agendar Cita</title>
</head>
<body>
    
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="/index.php" class="brand">Taller Automotriz</a>
        <ul class="side-menu">
            <li><a href="/frontend/login.php"><i class='bx bxs-log-in-circle icon'></i> Iniciar Sesion</a></li>
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- NAVBAR -->
    <section id="content">
        <nav>
            <i class='bx bx-menu toggle-sidebar'></i>
            <form action="#">
                <div class="form-group">
                    <input type="text" placeholder="Buscar...">
                    <i class='bx bx-search icon'></i>
                </div>
            </form>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <ul class="breadcrumbs">
                <li><a href="../admin/escritorio.php">Inicio</a></li>
                <li class="divider">></li>
                <li><a href="../citas/mostrar.php">Listado de las citas</a></li>
                <li class="divider">></li>
                <li><a href="#" class="active">Nueva cita</a></li>
            </ul>
           
            <!-- Formulario de Agendar Cita -->
            <form action="" enctype="multipart/form-data" method="POST" autocomplete="off">
                <div class="containerss">
                    <h1>Nueva cita</h1>
                    <div class="alert-danger">
                        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                        <strong>Importante!</strong> Es importante rellenar los campos con &nbsp;<span class="badge-warning">*</span><br>
                    </div>
                    <hr>
                    <br>
                    
                    <!-- Nombre del Cliente -->
                    <label for="nombre"><b>Nombre Completo</b></label><span class="badge-warning">*</span>
                    <input type="text" name="apppac" id="nombre" placeholder="Ingrese su nombre completo" required>


                    <!-- Tipo de Reparación -->
                    <label for="psw"><b>Tipo de reparación</b></label><span class="badge-warning">*</span>
                    <select required name="nomlab" id="lab">
                        <option>Seleccione</option>
                    </select>

                    <!-- Motivo de la cita -->
                    <label for="email"><b>Motivo de la cita</b></label><span class="badge-warning">*</span>
                    <textarea name="appnam" style="height:100px" placeholder="Escriba el motivo de la cita..."></textarea>
                    
                    <!-- Fecha de la visita -->
                    <label for="email"><b>Fecha visita</b></label><span class="badge-warning">*</span>
                    <input type="datetime-local" name="appini" required="">

                    <!-- Fecha final -->
                    <label for="email"><b>Fecha Final</b></label><span class="badge-warning"></span>
                    <input type="datetime-local" name="appfin">
                    
                    <hr>
                    <button type="submit" name="add_appointment" class="registerbtn">Guardar</button>
                </div>
            </form>
            <!-- Fin del Formulario -->
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <script src="../../backend/js/jquery.min.js"></script>
    <script src="../../backend/js/script.js"></script>
    <script src="../../backend/js/multistep.js"></script>
    <script src="../../backend/js/vpat.js"></script>
    <script src="../../backend/js/cliente.js"></script>
    <script src="../../backend/js/mecanico.js"></script>
    <script src="../../backend/js/especialidad.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <?php include_once '../../backend/php/add_appointment.php' ?>
</body>
</html>
