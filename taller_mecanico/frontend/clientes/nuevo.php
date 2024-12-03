<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 1) {
    header('Location: ../login.php');
    exit();
}

$id = $_SESSION['id']; // No es necesario aquí ya que no se utiliza
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
        <a href="../admin/escritorio.php" class="brand">Taller Automotriz</a>
        <ul class="side-menu">
            <li><a href="../admin/escritorio.php"><i class='bx bxs-dashboard icon'></i> Panel administrativo</a></li>
            <li class="divider" data-text="main">Main</li>
            <li>
                <a href="#"><i class='bx bxs-book-alt icon'></i> Citas <i class='bx bx-chevron-right icon-right'></i></a>
                <ul class="side-dropdown">
                    <li><a href="../citas/mostrar.php">Todas las citas</a></li>
                    <li><a href="../citas/nuevo.php">Nueva</a></li>
                    <li><a href="../citas/calendario.php">Calendario</a></li>
                </ul>
            </li>

            <li>
                <a href="#"><i class='bx bxs-user icon'></i> Clientes <i class='bx bx-chevron-right icon-right'></i></a>
                <ul class="side-dropdown">
                    <li><a href="../clientes/mostrar.php">Lista de clientes</a></li>
                </ul>
            </li>

            <li>
                <a href="#"><i class='bx bxs-briefcase icon'></i> Mecanicos <i class='bx bx-chevron-right icon-right'></i></a>
                <ul class="side-dropdown">
                    <li><a href="../mecanicos/mostrar.php">Lista de mecanicos</a></li>
                    <li><a href="../mecanicos/historial.php">Historial de mecanicos</a></li>
                </ul>
            </li>

            <li>
                <a href="#"><i class='bx bxs-user-pin icon'></i> Áreas especializadas <i class='bx bx-chevron-right icon-right'></i></a>
                <ul class="side-dropdown">
                    <li><a href="../recursos/especialidad.php">Especialidades</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- NAVBAR -->
    <section id="content">

        <nav>
            <i class='bx bx-menu toggle-sidebar'></i>
            <form action="#">
                <div class="form-group">
                    <input type="text" placeholder="Search...">
                    <i class='bx bx-search icon'></i>
                </div>
            </form>

            <span class="divider"></span>
            <div class="profile">
                <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixid=MnwxMjA3fDB8MHxzZWFyY2h8NHx8cGVvcGxlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="">
                <ul class="profile-link">
                    <li><a href="../profile/mostrar.php"><i class='bx bxs-user-circle icon'></i> Profile</a></li>
                    <li><a href="../salir.php"><i class='bx bxs-log-out-circle'></i> Logout</a></li>
                </ul>
            </div>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <ul class="breadcrumbs">
                <li><a href="../admin/escritorio.php">Inicio</a></li>
                <li class="divider">></li>
                <li><a href="../clientes/mostrar.php">Listado de clientes</a></li>
                <li class="divider">></li>
                <li><a href="#" class="active">Nuevo cliente</a></li>
            </ul>

            <!-- Formulario multistep -->
            <form action="" enctype="multipart/form-data" method="POST" autocomplete="off" onsubmit="return validacion()">
                <div class="containerss">
                    <h1>Nuevo cliente</h1>
                    <div class="alert-danger">
                        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                        <strong>Importante!</strong> Es importante rellenar los campos con <span class="badge-warning">*</span>
                    </div>
                    <hr>

                    <label for="email"><b>Rut del cliente</b></label><span class="badge-warning">*</span>
                    <input type="text" placeholder="ejm: 12546432-1" name="nhi" maxlength="10" required>

                    <label for="psw"><b>Nombre del cliente</b></label><span class="badge-warning">*</span>
                    <input type="text" placeholder="ejm: Juan Raul" name="namp" required>

                    <label for="psw"><b>Apellido del cliente</b></label><span class="badge-warning">*</span>
                    <input type="text" placeholder="ejm: Ramirez Requena" name="apep" required>

                    <label for="psw"><b>Dirección del cliente</b></label><span class="badge-warning">*</span>
                    <input type="text" placeholder="ejm: calle los medanos" name="dip" required>

                    <label for="psw"><b>Ciudad</b></label><span class="badge-warning">*</span>
                    <select required name="grp" id="grp">
                        <option>Seleccione</option>
                        <option value="Osorno">Osorno</option>
                        <option value="Valdivia">Valdivia</option>
                        <option value="Pto Montt">Pto Montt</option>
                    </select>

                    <label for="psw"><b>Género del cliente</b></label><span class="badge-warning">*</span>
                    <select required name="gep" id="gep">
                        <option>Seleccione</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                    </select>

                    <label for="psw"><b>Teléfono del cliente</b></label><span class="badge-warning">*</span>
                    <input type="text" maxlength="13" placeholder="ejm: +569 13245654" name="telp" required>

                    <label for="psw"><b>Fecha de nacimiento del cliente</b></label><span class="badge-warning">*</span>
                    <input type="date" name="cump" required>

                    <hr>
                    <button type="submit" name="add_clientes" class="registerbtn">Guardar</button>
                </div>
            </form>
        </main>
        <!-- MAIN -->
    </section>
    <!-- NAVBAR -->

    <script src="../../backend/js/jquery.min.js"></script>
    <?php include_once '../../backend/php/add_clientes.php'; ?>

    <script src="../../backend/js/script.js"></script>
    <script src="../../backend/js/multistep.js"></script>
    <script src="../../backend/js/vpat.js"></script>

    <script type="text/javascript">
        let popUp = document.getElementById("cookiePopup");

        document.getElementById("acceptCookie").addEventListener("click", () => {
            let d = new Date();
            d.setMinutes(2 + d.getMinutes());
            document.cookie = "myCookieName=thisIsMyCookie; expires=" + d + ";";
            popUp.classList.add("hide");
            popUp.classList.remove("shows");
        });

        const checkCookie = () => {
            let input = document.cookie.split("=");
            if (input[0] == "myCookieName") {
                popUp.classList.add("hide");
                popUp.classList.remove("shows");
            } else {
                popUp.classList.add("shows");
                popUp.classList.remove("hide");
            }
        };

        window.onload = () => {
            setTimeout(() => {
                checkCookie();
            }, 2000);
        };
    </script>
</body>

</html>
