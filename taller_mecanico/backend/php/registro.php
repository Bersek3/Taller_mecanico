<?php
require '../backend/bd/Conexion.php';

if(isset($_POST['register'])) {
    $errMsg = '';

    // Obtener datos del formulario
    $username = trim($_POST['username']);
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm_password']);
    $rol = 2; // Por defecto, asigna rol 2 (usuario normal). Puedes modificar esto.

    // Validaciones básicas
    if($username == '') $errMsg = 'Digite su nombre de usuario.';
    if($name == '') $errMsg = 'Digite su nombre.';
    if($email == '') $errMsg = 'Digite su correo electrónico.';
    if($password == '') $errMsg = 'Digite su contraseña.';
    if($confirmPassword == '') $errMsg = 'Confirme su contraseña.';
    if($password !== $confirmPassword) $errMsg = 'Las contraseñas no coinciden.';

    // Validar si ya existe el usuario o correo electrónico
    if($errMsg == '') {
        try {
            $sql = "SELECT COUNT(*) FROM users WHERE username = :username OR email = :email";
            $stmt = $connect->prepare($sql);
            $stmt->execute([':username' => $username, ':email' => $email]);
            $userExists = $stmt->fetchColumn();

            if($userExists > 0) {
                $errMsg = 'El nombre de usuario o correo electrónico ya está en uso.';
            } else {
                // Insertar nuevo usuario en la base de datos
                $sql = "INSERT INTO users (username, name, email, password, rol) VALUES (:username, :name, :email, :password, :rol)";
                $stmt = $connect->prepare($sql);
                $stmt->execute([
                    ':username' => $username,
                    ':name' => $name,
                    ':email' => $email,
                    ':password' => MD5($password), // Hash de contraseña
                    ':rol' => $rol
                ]);

                echo '<p>Registro exitoso. Ahora puede iniciar sesión.</p>';
                // Redirigir al login
                header('Location: login.php');
                exit;
            }
        } catch(PDOException $e) {
            $errMsg = 'Error en la base de datos: ' . $e->getMessage();
        }
    }

    if($errMsg != '') {
        echo '<p style="color: red;">' . $errMsg . '</p>';
    }
}
?>
