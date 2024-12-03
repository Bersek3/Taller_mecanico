<?php
require '../../backend/bd/Conexion.php';

if (isset($_POST['add_profile'])) {
    // Recibir datos del formulario
    $idpa = $_POST['pid'];     
    $correo = trim($_POST['correo']);  
    $usuario = trim($_POST['usp']);
    $contraseña = trim($_POST['pwdp']); 
    $rol = $_POST['rlp'];         

    // Validación básica
    if (empty($correo) || empty($usuario) || empty($contraseña)) {
        echo "Todos los campos son obligatorios.";
    } else {
        // Asegúrate de que la contraseña esté correctamente encriptada
        $contraseña = password_hash($contraseña, PASSWORD_DEFAULT);

        try {
            // Verificar si el correo o usuario ya existen
            $checkQuery = "SELECT COUNT(*) FROM usuarios WHERE correo = :correo OR usuario = :usuario";
            $stmt = $connect->prepare($checkQuery);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->execute();

            if ($stmt->fetchColumn() > 0) {
                echo "correo o usuario ya existe.";
            } else {
                // Insertar los datos en la tabla de usuarios
                $insertQuery = "INSERT INTO usuarios (idpa, correo, usuario, contraseña, rol) 
                                VALUES (:idpa, :correo, :usuario, :contraseña, :rol)";
                $stmt = $connect->prepare($insertQuery);
                $stmt->bindParam(':idpa', $idpa, PDO::PARAM_INT);
                $stmt->bindParam(':correo', $correo);
                $stmt->bindParam(':usuario', $usuario);
                $stmt->bindParam(':contraseña', $contraseña);
                $stmt->bindParam(':rol', $rol, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    echo "Perfil creado correctamente.";
                } else {
                    echo "Hubo un error al crear el perfil.";
                }
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
