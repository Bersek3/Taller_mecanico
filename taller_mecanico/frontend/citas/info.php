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
    <link rel="icon" type="image/png" sizes="96x96" href="../../backend/img/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">



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
                    <li><a href="../clientes/pagos.php">Pagos</a></li>
                    <li><a href="../clientes/historial.php">Historial de clientes</a></li>
                    <li><a href="../clientes/documentos.php">Documentos</a></li>
                   
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
                <li><a href="../admin/escritorio.php">Inicio</a></li>
                <li class="divider">></li>
                <li><a href="../citas/mostrar.php">Listado de las citas</a></li>
                <li class="divider">></li>
                <li><a href="#" class="active">Información de la cita</a></li>
            </ul>
           
           <!-- multistep form -->
<?php 
require '../../backend/bd/Conexion.php';
 $id = $_GET['id'];
 $sentencia = $connect->prepare("SELECT citas.id, citas.title, clientes.idpa, clientes.numhs,clientes.nompa, clientes.apepa, mecanicos.idodc, mecanicos.ceddoc, mecanicos.nodoc,mecanicos.nomesp, mecanicos.apdoc, especialidades.idlab, especialidades.nomlab, citas.start, citas.end, citas.color, citas.state,citas.chec,citas.monto FROM citas INNER JOIN clientes ON citas.idpa = clientes.idpa INNER JOIN mecanicos ON citas.idodc = mecanicos.idodc INNER JOIN especialidades ON citas.idlab = especialidades.idlab WHERE id= '$id';");
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
<form action="" enctype="multipart/form-data" method="POST"  autocomplete="off">
  <div class="containerss">

<br>
    <label for="email"><b>Motivo de la cita</b></label><span class="badge-warning">*</span>
    <textarea name="appnam" style="height:200px" readonly placeholder="Write something.."><?php echo $d->title; ?> </textarea>
  
    <label for="psw"><b>Nombre del cliente</b></label><span class="badge-warning">*</span>
    <select readonly required name="apppac" id="pati">
        <option><?php echo $d->nompa; ?>&nbsp; <?php echo $d->apepa; ?></option>
    </select>

    <label for="psw"><b>Nombre del mecanico</b></label><span class="badge-warning">*</span>
    <select readonly required name="" id="doc">
        <option><?php echo $d->nodoc; ?>&nbsp; <?php echo $d->apdoc; ?></option>
    </select>

    <label for="email"><b>Especialidad del mecanico</b></label><span class="badge-warning">*</span>

     <select readonly id="spe">
        <option><?php echo $d->nomesp; ?></option>
    </select>


    <label for="psw"><b>Marca del Vehiculo</b></label><span class="badge-warning">*</span>
    <select required name="" id="lab" readonly>
        <option><?php echo $d->nomlab; ?></option>
    </select>

    <label for="psw"><b>Color del Vehiculo</b></label><span class="badge-warning">*</span>
    <select required name="appco" id="gep">
        <option style="color:#CD5C5C;" value="#CD5C5C"><?php echo $d->color; ?></option>
        
        
          
    </select>

    <label for="email"><b>Fecha inicial</b></label><span class="badge-warning">*</span>
    <input readonly type="datetime-local" value="<?php echo $d->start; ?>" name="appini"required="">

    <label for="email"><b>Fecha final</b></label><span class="badge-warning">*</span>
    <input readonly type="datetime-local" value="<?php echo $d->end; ?>"  name="appfin"required="">

     <label for="email"><b>Monto a pagar</b></label><span class="badge-warning">*</span>
    <input type="text" readonly placeholder="S/. 0.00"  value="<?php echo $d->monto; ?>" name="appmont" required="" value="0.00">

     <label for="email"><b>Realiza pago</b></label><span class="badge-warning">*</span>
     <label>SI</label>
    <input type="checkbox" id="<?=$d->id?>" value="<?=$d->chec ?>" <?=$d->chec == '1' ? 'checked' : '' ;?> name="appreal"   value="1">


    <hr>
   
    
  </div>
  
</form>
<?php endforeach; ?>
  
    <?php else:?>
      <p class="alert alert-warning">No hay datos</p>
    <?php endif; ?>

        </main>
        <!-- MAIN -->
    </section>
    <script src="../../backend/js/jquery.min.js"></script>


    <!-- NAVBAR -->
    
    <script src="../../backend/js/script.js"></script>
    <script src="../../backend/js/multistep.js"></script>
    <script src="../../backend/js/vpat.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  
   
</body>
</html>

