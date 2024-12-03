<?php
require_once('../../backend/bd/Conexion.php');

if (isset($_POST['add_clientes'])) {
    // Get form data
    $numhs = trim($_POST['nhi']);
    $nompa = trim($_POST['namp']);
    $apepa = trim($_POST['apep']);
    $direc = trim($_POST['dip']);
    $ciu = trim($_POST['gep']);
    $grup = trim($_POST['grp']);
    $phon = trim($_POST['telp']);
    $cump = trim($_POST['cump']);
    
    // Validate inputs
    if (empty($numhs)) {
        $errMSG = "Please enter number.";
    } elseif (empty($nompa)) {
        $errMSG = "Please enter your name.";
    }

    // If there are no validation errors, check if the record exists
    if (!isset($errMSG)) {
        // Check if the client already exists
        $sqlCheck = "SELECT COUNT(*) FROM clientes WHERE numhs = :numhs";
        $stmt = $connect->prepare($sqlCheck);
        $stmt->bindParam(':numhs', $numhs, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->fetchColumn() > 0) {
            // If the record exists, show an error
            echo '<div id="cookiePopup" class="hide">
                  <img src="../../backend/img/error.png" />
                  <p>Ya existe el registro a agregar!</p>
                  <button id="acceptCookie" type="button">OK</button>
                  </div>';
        } else {
            // If no record exists, proceed with inserting the new client
            try {
                $insertSql = "INSERT INTO clientes (numhs, nompa, apepa, direc, ciu, grup, phon, cump, state) 
                              VALUES (:numhs, :nompa, :apepa, :direc, :ciu, :grup, :phon, :cump, '1')";
                $stmt = $connect->prepare($insertSql);
                
                // Bind parameters
                $stmt->bindParam(':numhs', $numhs, PDO::PARAM_STR);
                $stmt->bindParam(':nompa', $nompa, PDO::PARAM_STR);
                $stmt->bindParam(':apepa', $apepa, PDO::PARAM_STR);
                $stmt->bindParam(':direc', $direc, PDO::PARAM_STR);
                $stmt->bindParam(':ciu', $ciu, PDO::PARAM_STR);
                $stmt->bindParam(':grup', $grup, PDO::PARAM_STR);
                $stmt->bindParam(':phon', $phon, PDO::PARAM_STR);
                $stmt->bindParam(':cump', $cump, PDO::PARAM_STR);

                // Execute the query
                if ($stmt->execute()) {
                    echo '<div id="cookiePopup" class="hide">
                          <img src="../../backend/img/404-tick.png" />
                          <p>Agregado correctamente</p>
                          <button id="acceptCookie" type="button">OK</button>
                          </div>';
                } else {
                    throw new Exception("Error while inserting data.");
                }
            } catch (Exception $e) {
                echo '<div id="cookiePopup" class="hide">
                      <img src="../../backend/img/error.png" />
                      <p>' . $e->getMessage() . '</p>
                      <button id="acceptCookie" type="button">OK</button>
                      </div>';
            }
        }
    } else {
        echo '<div id="cookiePopup" class="hide">
              <img src="../../backend/img/error.png" />
              <p>' . $errMSG . '</p>
              <button id="acceptCookie" type="button">OK</button>
              </div>';
    }
}
?>
