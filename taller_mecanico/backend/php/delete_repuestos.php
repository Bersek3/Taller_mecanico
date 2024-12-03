<?php
require_once('../../backend/bd/Conexion.php');

if (isset($_POST['delete_repuestos'])) {
    $idcat = trim($_POST['idcat']);

    // Actualizar los productos relacionados para poner idcat a NULL
    $updateProductSql = "UPDATE `product` SET `idcat` = NULL WHERE `idcat` = :idcat";
    $updateProductStmt = $connect->prepare($updateProductSql);
    $updateProductStmt->bindParam(':idcat', $idcat, PDO::PARAM_INT);
    $updateProductStmt->execute();

    // Eliminar la categoría de repuestos
    $deleteRepuestoSql = "DELETE FROM `repuestos` WHERE `idcat` = :idcat";
    $deleteRepuestoStmt = $connect->prepare($deleteRepuestoSql);
    $deleteRepuestoStmt->bindParam(':idcat', $idcat, PDO::PARAM_INT);
    $deleteRepuestoStmt->execute();

    if ($deleteRepuestoStmt->rowCount() > 0) {
        echo '<script type="text/javascript">
            swal("Eliminado!", "Eliminado correctamente", "success").then(function() {
                window.location = "categoria.php";
            });
        </script>';
    } else {
        echo '<script type="text/javascript">
            swal("Error!", "Error", "error").then(function() {
                window.location = "categoria.php";
            });
        </script>';
    }
}
?>
