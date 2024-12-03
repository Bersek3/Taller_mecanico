<?php
require_once('../../backend/bd/Conexion.php');

if (isset($_POST['delete_mecanico'])) {
    try {
        // Iniciar una transacción
        $connect->beginTransaction();

        // Obtener el ID del mecanicos a eliminar
        $idodc = trim($_POST['idodc']);

        // Eliminar las citas relacionadas en la tabla 'citas'
        $consultaEventos = "DELETE FROM `citas` WHERE `idodc` = :idodc";
        $sqlEventos = $connect->prepare($consultaEventos);
        $sqlEventos->bindParam(':idodc', $idodc, PDO::PARAM_INT);
        $sqlEventos->execute();

        // Ahora eliminar el registro del mecanicos
        $consultamecanicos = "DELETE FROM `mecanicos` WHERE `idodc` = :idodc";
        $sqlmecanicos = $connect->prepare($consultamecanicos);
        $sqlmecanicos->bindParam(':idodc', $idodc, PDO::PARAM_INT);
        $sqlmecanicos->execute();

        // Confirmar la transacción
        $connect->commit();

        if ($sqlmecanicos->rowCount() > 0) {
            echo '<script type="text/javascript">
            swal({
              icon: "success",
              title: "Eliminado",
              text: "Eliminado correctamente!",
            });
            </script>';
        } else {
            echo '<div id="cookiePopup" class="hide">
              <img src="../../backend/img/error.png" />
              <p>
                No se pudo eliminar el registro 
              </p>
              <button id="acceptCookie" type="button">OK</button>
            </div>';
        }
    } catch (Exception $e) {
        // Revertir cambios en caso de error
        $connect->rollBack();
        echo '<div id="cookiePopup" class="hide">
          <img src="../../backend/img/error.png" />
          <p>
            Error al eliminar el registro. Detalles: ' . $e->getMessage() . '
          </p>
          <button id="acceptCookie" type="button">OK</button>
        </div>';
    }
}
?>
