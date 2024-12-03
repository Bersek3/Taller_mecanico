<?php
require_once('../../backend/bd/Conexion.php'); 

if (isset($_POST['add_especialidades'])) {
    $nomlab = trim($_POST['labname']); // Recuperamos el nombre de la especialidad
    
    // Validación de campos vacíos
    if (empty($nomlab)) {
        echo '<script type="text/javascript">
        swal("Error!", "Por favor ingrese el nombre de la especialidad.", "error").then(function() {
            window.location = "especialidad_nuevo.php";
        });
        </script>';
        exit;
    }

    try {
        // Validar si ya existe el registro
        $sql = "SELECT COUNT(*) FROM especialidades WHERE nomlab = :nomlab";
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(':nomlab', $nomlab);
        $stmt->execute();

        if ($stmt->fetchColumn() > 0) {
            // Si ya existe, mostramos un mensaje de error
            echo '<script type="text/javascript">
            swal("Error!", "La especialidad ya está agregada.", "error").then(function() {
                window.location = "especialidad_nuevo.php";
            });
            </script>';
            exit;
        }

        // Insertar la nueva especialidad
        $sql = "INSERT INTO especialidades (nomlab, state) VALUES (:nomlab, '1')";
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(':nomlab', $nomlab);

        if ($stmt->execute()) {
            // Mensaje de éxito
            echo '<script type="text/javascript">
            swal("Agregado!", "Especialidad agregada correctamente.", "success").then(function() {
                window.location = "especialidad.php";
            });
            </script>';
        } else {
            // Mensaje de error en la inserción
            echo '<script type="text/javascript">
            swal("Error!", "Hubo un problema al agregar la especialidad.", "error").then(function() {
                window.location = "especialidad_nuevo.php";
            });
            </script>';
        }
    } catch (PDOException $e) {
        // Manejo de errores de base de datos
        echo '<script type="text/javascript">
        swal("Error!", "Error de base de datos: ' . $e->getMessage() . '", "error").then(function() {
            window.location = "especialidad_nuevo.php";
        });
        </script>';
    }
}
?>
