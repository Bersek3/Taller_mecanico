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
                    <li><a href="../recursos/laboratiorios.php">Especialidades</a></li>
                  
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
                <li><a href="../clientes/mostrar.php">Listado de clientes</a></li>
                <li class="divider">></li>
                <li><a href="#" class="active">Historial reparaciones de clientes</a></li>
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
           
            <input type="text" value="<?php echo $d->phon; ?>" name="text" required>
            
            <span class="line"></span>
        </div>
                        
                    </div>

</div>



        <?php endforeach; ?>
  
    <?php else:?>
      <p class="alert alert-warning">No hay datos</p>
    <?php endif; ?>


        </main>
        <!-- MAIN -->
    </section>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <!-- NAVBAR -->
    
    <script src="../../backend/js/script.js"></script>
    <script src="../../backend/js/multistep.js"></script>
    <script src="../../backend/js/vpat.js"></script>
    

    <script type="text/javascript">
    let popUp = document.getElementById("cookiePopup");
//When user clicks the accept button
document.getElementById("acceptCookie").addEventListener("click", () => {
  //Create date object
  let d = new Date();
  //Increment the current time by 1 minute (cookie will expire after 1 minute)
  d.setMinutes(2 + d.getMinutes());
  //Create Cookie withname = myCookieName, value = thisIsMyCookie and expiry time=1 minute
  document.cookie = "myCookieName=thisIsMyCookie; expires = " + d + ";";
  //Hide the popup
  popUp.classList.add("hide");
  popUp.classList.remove("shows");
});
//Check if cookie is already present
const checkCookie = () => {
  //Read the cookie and split on "="
  let input = document.cookie.split("=");
  //Check for our cookie
  if (input[0] == "myCookieName") {
    //Hide the popup
    popUp.classList.add("hide");
    popUp.classList.remove("shows");
  } else {
    //Show the popup
    popUp.classList.add("shows");
    popUp.classList.remove("hide");
  }
};
//Check if cookie exists when page loads
window.onload = () => {
  setTimeout(() => {
    checkCookie();
  }, 2000);
};
    </script>

    <script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include_once '../../backend/modal/md_geog.php' ?>
<?php include_once '../../backend/modal/md_consul.php' ?>
<?php include_once '../../backend/modal/md_trat.php' ?>



<script type="text/javascript">
    $(document).ready(function(){
$("#submit").click(function(){
var gedet = $("#gedet").val();
var geidpa = $("#geidpa").val();
var genopa = $("#genopa").val();

// Returns successful data submission message when the entered information is stored in database.
var dataString = 'det1='+ gedet + '&pa1='+ geidpa + '&nomp1='+ genopa;
if(gedet==''||geidpa==''||genopa=='')
{
alert("Please Fill All Fields");
}
else
{
// AJAX Code To Submit Form.
$.ajax({
type: "POST",
url: "add_ge.php",
data: dataString,
cache: false,
success: function(result){

alert(result);
$('#tbody').html(result);
}
});
}
return false;
});
});


  
</script>

<script type="text/javascript">
    function enviar(){
var consl = document.getElementById('consl').value;
var csidpa = document.getElementById('csidpa').value;
var csnopa = document.getElementById('csnopa').value;



var dataen = 'consl='+consl +'&csidpa='+csidpa +'&csnopa='+csnopa;
//obtenemos el valor de todos los input que te interesan
              $.ajax({
                    type: "POST", //definimos el método de envío
                    url: "add_consut.php", //el archivo al cual se enviaran
                    data:dataen,
                    cache: false,
                    success: function(result){

                    swal(
                            'Agregado correctamente',
                            'Buen trabajo',
                            'success'
                          )
}
                });
};
</script>

<script type="text/javascript">
    function trata(){
       var trat = document.getElementById('trat').value; 
       var tratdpa = document.getElementById('tratdpa').value; 
       var tratnopa = document.getElementById('tratnopa').value;

       var dataens = 'trat='+trat +'&tratdpa='+tratdpa +'&tratnopa='+tratnopa;

       $.ajax({
                    type: "POST", //definimos el método de envío
                    url: "add_trat.php", //el archivo al cual se enviaran
                    data:dataens,
                    cache: false,
                    success: function(result){

                    swal(
                            'Agregado correctamente',
                            'Buen trabajo',
                            'success'
                          )
}
                }); 
    };
</script>



</body>
</html>


