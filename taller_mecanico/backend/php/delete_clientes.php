<?php
require_once('../../backend/bd/Conexion.php');

if (isset($_POST['delete_clientes'])) {
    try {
        // Establecer conexión
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Obtener el ID del paciente
        $idpa = trim($_POST['idpa']);

        // Iniciar una transacción
        $connect->beginTransaction();

        // Eliminar registros relacionados en la tabla 'citas'
        $consultacitas = "DELETE FROM `citas` WHERE `idpa` = :idpa";
        $sqlcitas = $connect->prepare($consultacitas);
        $sqlcitas->bindParam(':idpa', $idpa, PDO::PARAM_INT);
        $sqlcitas->execute();

        // Eliminar registro en la tabla 'clientes'
        $consultaclientes = "DELETE FROM `clientes` WHERE `idpa` = :idpa";
        $sqlclientes = $connect->prepare($consultaclientes);
        $sqlclientes->bindParam(':idpa', $idpa, PDO::PARAM_INT);
        $sqlclientes->execute();

        // Confirmar la transacción
        $connect->commit();

        // Comprobar si se eliminó el paciente
        if ($sqlclientes->rowCount() > 0) {
            echo '<div id="cookiePopup" class="hide">
                  <img src="../../backend/img/404-tick.png" />
                  <p>Eliminado correctamente</p>
                  <button id="acceptCookie" type="button">OK</button>
                  </div>';
        } else {
            throw new Exception("No se pudo eliminar el registro.");
        }
    } catch (Exception $e) {
        // Verificar si la transacción está activa antes de intentar hacer un rollback
        if ($connect->inTransaction()) {
            $connect->rollBack();
        }

        // Mostrar mensaje de error
        echo '<div id="cookiePopup" class="hide">
              <img src="../../backend/img/error.png" />
              <p>No se pudo eliminar el registro</p>
              <button id="acceptCookie" type="button">OK</button>
              </div>';
        echo "Error: " . $e->getMessage();
    }
}
?>
