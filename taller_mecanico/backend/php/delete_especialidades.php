<?php
    require_once('../../backend/bd/Conexion.php');
if(isset($_POST['delete_especialidades'])){
////////////// Actualizar la tabla /////////
$consulta = "DELETE FROM `especialidades` WHERE `idlab`=:idlab";
$sql = $connect-> prepare($consulta);
$sql -> bindParam(':idlab', $idlab, PDO::PARAM_INT);
$idlab=trim($_POST['idlab']);
$sql->execute();

if($sql->rowCount() > 0)
{
$count = $sql -> rowCount();
echo '<script type="text/javascript">
swal("Eliminado!", "Eliminado correctamente", "success").then(function() {
            window.location = "especialidad.php";
        });
        </script>';
}
else{
    echo '<script type="text/javascript">
swal("Error!", "Error", "error").then(function() {
            window.location = "especialidad.php";
        });
        </script>';

print_r($sql->errorInfo()); 
}
}// Cierra envio de guardado
?>


 

