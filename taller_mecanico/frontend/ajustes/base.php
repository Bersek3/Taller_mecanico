<?php
    ob_start();
     session_start();
    
    if(!isset($_SESSION['rol']) || $_SESSION['rol'] != 1){
    header('location: ../login.php');

    $id=$_SESSION['id'];
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../backend/css/admin.css">
    <link rel="icon" type="image/png" sizes="96x96" href="../../backend/img/ico.svg">





    <title>Taller Automotriz</title>
</head>
<body>
    
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="../admin/escritorio.php" class="brand"><i class='bx bxs-heart icon'></i> Taller Automotriz</a>
        <ul class="side-menu">
            <li><a href="../admin/escritorio.php" ><i class='bx bxs-dashboard icon' ></i> Panel administrativo</a></li>
            <li class="divider" data-text="main">Main</li>
            <li>
                <a href="#"><i class='bx bxs-book-alt icon' ></i> Citas <i class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                    <li><a href="../citas/mostrar.php">Todas las citas</a></li>
                    <li><a href="../citas/nuevo.php">Nueva</a></li>
                    <li><a href="../citas/calendario.php">Calendario</a></li>
                   
                </ul>
            </li>

            <li>
                <a href="#"><i class='bx bxs-user icon' ></i> Clientes <i class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                    <li><a href="../clientes/mostrar.php" >Lista de clientes</a></li>
                   
                </ul>
            </li>

            <li>
                <a href="#"><i class='bx bxs-briefcase icon' ></i> Mecanicos <i class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                    <li><a href="../mecanicos/mostrar.php">Lista de mecanicos</a></li>
                    <li><a href="../mecanicos/historial.php">Historial de mecanicos</a></li>
                   
                </ul>
            </li>


            
            <li>
                <a href="#"><i class='bx bxs-user-pin icon' ></i> Areas especializadas<i class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                    <li><a href="../recursos/especialidad.php">Especialidades</a></li>
                  
                </ul>
            </li>




        </ul>
       

    </section>
    <!-- SIDEBAR -->

    <!-- NAVBAR -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu toggle-sidebar' ></i>
            <form action="#">
                <div class="form-group">
                    <input type="text" placeholder="Search...">
                    <i class='bx bx-search icon' ></i>
                </div>
            </form>
            
           
            <span class="divider"></span>
            <div class="profile">
                <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixid=MnwxMjA3fDB8MHxzZWFyY2h8NHx8cGVvcGxlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="">
                <ul class="profile-link">
                    <li><a href="../profile/mostrar.php"><i class='bx bxs-user-circle icon' ></i> Profile</a></li>
                    
                    <li>
                     <a href="../salir.php"><i class='bx bxs-log-out-circle' ></i> Logout</a>
                    </li>
                   
                </ul>
            </div>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            
            <ul class="breadcrumbs">
                <li><a href="../admin/escritorio.php">Home</a></li>
                <li class="divider">></li>
              
                <li><a href="#" class="active">Bases de datos</a></li>
            </ul>
            <br>
            <?php 
require '../../backend/bd/Conexion.php';
 $sentencia = $connect->prepare("SELECT * FROM base;");
 $sentencia->execute();

$data =  array();
if($sentencia){
  while($r = $sentencia->fetchObject()){
    $data[] = $r;
  }
}

 ?>
 <?php  if(count($data)>0):?>

        <?php foreach($data as $e):?> 
        <li class="flex-card-listitem">
            <div class="flex-card">
              <div class="flex-card-image">
                <img src="../../backend/img/sql.png" />
              </div>
              <div class="flex-card-content">
                <a href="../../backend/img/subidas/<?php echo $e->base; ?>" class="flex-card-button" download>Download</a>
              </div>
            </div>
        </li>
<?php endforeach; ?>
  
    <?php else:?>
      <p class="alert alert-warning">No existe ningun documento</p>
    <?php endif; ?>
        </main>
        <!-- MAIN -->
    </section>
    
    <!-- NAVBAR -->
    <script src="../../backend/js/jquery.min.js"></script>
    
    <script src="../../backend/js/script.js"></script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
 <?php include_once '../../backend/php/upd_settin.php' ?>
</body>
</html>

