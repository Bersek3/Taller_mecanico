<?php
    include_once '../../backend/php/db_connection.php';

    if (isset($_GET['marca_id'])) {
        $marca_id = $_GET['marca_id'];
        
        // Obtener los modelos correspondientes a la marca seleccionada
        $query_modelos = "SELECT * FROM modelos WHERE marca_id = '$marca_id'";
        $result_modelos = mysqli_query($conn, $query_modelos);

        // Mostrar los modelos en el select
        echo "<option value=''>Seleccione un modelo</option>";
        while($row = mysqli_fetch_assoc($result_modelos)){
            echo "<option value='".$row['id']."'>".$row['nombre']."</option>";
        }
    }
?>
