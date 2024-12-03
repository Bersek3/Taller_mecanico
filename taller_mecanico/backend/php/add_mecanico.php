<?php 
require_once('../../backend/bd/Conexion.php'); 

if(isset($_POST['add_mecanico'])) {
    // Capturar los datos del formulario
    $ceddoc = trim($_POST['cem']);
    $nodoc = trim($_POST['named']);
    $apdoc = trim($_POST['apeme']);
    $nomesp = trim($_POST['espm']);
    $direcd = trim($_POST['dime']);
    $sexd = trim($_POST['geme']);
    $phd = trim($_POST['telme']);
    $nacd = trim($_POST['cumme']);

    // Validar que los campos no estén vacíos
    if(empty($ceddoc)) {
        $errMSG = "Por favor ingrese la cédula.";
    } elseif(empty($nodoc)) {
        $errMSG = "Por favor ingrese el nombre.";
    } else {
        // Verificar si la cédula ya existe en la base de datos
        $sql = "SELECT * FROM mecanicos WHERE ceddoc = :ceddoc";
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(':ceddoc', $ceddoc, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Si ya existe, mostrar un mensaje de error
            $errMSG = "¡El registro ya existe!";
        } else {
            // Si no existe, insertar el nuevo registro
            $insertSql = "INSERT INTO mecanicos (ceddoc, nodoc, apdoc, nomesp, direcd, sexd, phd, nacd, state) 
                          VALUES (:ceddoc, :nodoc, :apdoc, :nomesp, :direcd, :sexd, :phd, :nacd, '1')";
            $stmt = $connect->prepare($insertSql);

            // Vincular los parámetros
            $stmt->bindParam(':ceddoc', $ceddoc);
            $stmt->bindParam(':nodoc', $nodoc);
            $stmt->bindParam(':apdoc', $apdoc);
            $stmt->bindParam(':nomesp', $nomesp);
            $stmt->bindParam(':direcd', $direcd);
            $stmt->bindParam(':sexd', $sexd);
            $stmt->bindParam(':phd', $phd);
            $stmt->bindParam(':nacd', $nacd);

            // Ejecutar la inserción
            if($stmt->execute()) {
                $successMSG = "Agregado correctamente";
            } else {
                $errMSG = "Error al insertar el registro.";
            }
        }
    }

    // Mostrar el mensaje de error o éxito
    $message = isset($errMSG) ? $errMSG : (isset($successMSG) ? $successMSG : ''); 
    echo '<div id="cookiePopup" class="hide">
            <img src="../../backend/img/' . (isset($errMSG) ? 'error.png' : '404-tick.png') . '" />
            <p>' . $message . '</p>
            <button id="acceptCookie" type="button">OK</button>
          </div>';
}
?>
