<?php  
if(isset($_POST['upd_especialidades']))
{
    $idlab = $_POST['labid'];
    $nomlab = $_POST['labname'];

    
    try {

        $query = "UPDATE especialidades SET nomlab=:nomlab WHERE idlab=:idlab LIMIT 1";
        $statement = $connect->prepare($query);

        $data = [
            ':nomlab' => $nomlab,
            
            ':idlab' => $idlab
        ];
        $query_execute = $statement->execute($data);

        if($query_execute)
        {
            echo '<script type="text/javascript">
swal("Actualizado!", "Actualizado correctamente", "success").then(function() {
            window.location = "especialidad.php";
        });
        </script>';
            exit(0);
        }
        else
        {
           echo '<script type="text/javascript">
swal("Error!", "Error", "success").then(function() {
            window.location = "especialidad.php";
        });
        </script>';
            exit(0);
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>



