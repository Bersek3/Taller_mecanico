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
        <a href="../admin/escritorio.php" class="brand">Taller Automotriz</a>
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

            <li>
                <a href="#"><i class='bx bxs-diamond icon' ></i> Actividades financieras<i class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                    <li><a href="../actividades/mostrar.php">Pagos</a></li>
                    <li><a href="../actividades/nuevo.php">Nuevo pago</a></li>
                   
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
                <li><a href="../admin/escritorio.php">Inicio</a></li>
                <li class="divider">></li>
                <li><a href="../actividades/mostrar.php">Listado de clientes</a></li>
                <li class="divider">></li>
                <li><a href="#" class="active">Historial de los pagos de los clientes</a></li>
            </ul>
           <br>

           <?php 
require '../../backend/bd/Conexion.php';
 $id = $_GET['id'];
 $sentencia = $connect->prepare("SELECT * FROM clientes  WHERE idpa= '$id';");
 $sentencia->execute();

$data =  array();
if($sentencia){
  while($r = $sentencia->fetchObject()){
    $data[] = $r;
  }
}
   ?>
   <?php if(count($data)>0):?>
        <?php foreach($data as $d):?>
<div class="input-block">

                    <div class="wrap-line">

                                <!-- Inputs -->
        <div class="brise-input">
            
            <input type="text" value="<?php echo $d->numhs; ?>" name="text" required>
            
            <span class="line"></span>
        </div>
        <div class="brise-input">
            
            <input type="text" value="<?php echo $d->nompa; ?>" name="text" required>
           
            <span class="line"></span>
        </div>

                <!-- Inputs -->
        <div class="brise-input">
            
            <input type="text" value="<?php echo $d->apepa; ?>" name="text" required>
            
            <span class="line"></span>
        </div>
        <div class="brise-input">
           
            <input type="text" value="<?php echo $d->direc; ?>" name="text" required>
            
            <span class="line"></span>
        </div>

        <div class="brise-input">
          
            <input type="text" value="<?php echo $d->cump; ?>" name="text" required>
            
            <span class="line"></span>
        </div>


        <div class="brise-input">
          
            <input type="text" value="<?php echo $d->sex; ?>" name="text" required>
            
            <span class="line"></span>
        </div>

                <div class="brise-input">
            
            <input type="text" value="<?php echo $d->grup; ?>" name="text" required>
            
            <span class="line"></span>
        </div>

        <div class="brise-input">
           
            <input type="text" value="<?php echo $d->phon; ?>" name="text" required>
            
            <span class="line"></span>
        </div>
                        
                    </div>

</div>




        <?php endforeach; ?>
  
    <?php else:?>
      <p class="alert alert-warning">No hay datos</p>
    <?php endif; ?>

        <div class="data">
            <div class="content-data">
                <h1>Mis pagos</h1>
                <div class="table-responsive" style="overflow-x:auto;">
                     <?php 

$id = $_GET['id'];
$sentencia = $connect->prepare("SELECT citas.id, citas.title, clientes.idpa, clientes.numhs,clientes.nompa, clientes.apepa, mecanicos.idodc, mecanicos.ceddoc, mecanicos.nodoc,mecanicos.nomesp, mecanicos.apdoc, laboratory.idlab, laboratory.nomlab, citas.start, citas.end, citas.color, citas.state,citas.chec,citas.monto,citas.fere FROM citas INNER JOIN clientes ON citas.idpa = clientes.idpa INNER JOIN mecanicos ON citas.idodc = mecanicos.idodc INNER JOIN laboratory ON citas.idlab = laboratory.idlab  WHERE clientes.idpa= '$id';");
 $sentencia->execute();
$data =  array();
if($sentencia){
  while($r = $sentencia->fetchObject()){
    $data[] = $r;
  }
}
     ?>
     <?php if(count($data)>0):?>
                    <table id="example" class="responsive-table">
                        <thead>
                            <tr>
                                <th scope="col">Fecha</th>
                                <th scope="col">Monto</th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php foreach($data as $d):?>
                            <tr>
                                <th scope="row"><?php echo $d->fere; ?></th>
                                <td data-title="Monto">S/.<?php echo $d->monto; ?></td>
                            </tr>
                             <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php else:?>
  
    <div class="alert">
      <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
      <strong>Danger!</strong> No hay datos.
    </div>
    <?php endif; ?>
                </div>
            </div>
        </div>
</main>
        <!-- MAIN -->
    </section>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <!-- NAVBAR -->
    
    <script src="../../backend/js/script.js"></script>
    <script src="../../backend/js/multistep.js"></script>
    <script src="../../backend/js/vpat.js"></script>
    

  

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>




</body>
</html>


