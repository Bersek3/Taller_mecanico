<?php
// Incluir el archivo de conexión a la base de datos
include_once '../../backend/bd/Conexion.php';

// Realizar la consulta para obtener las marcas
$query = "SELECT marcas FROM marcas_modelos";
$stmt = $pdo->query($query);

// Obtener todos los resultados
$marcas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Marcas</title>
</head>
<body>

    <h1>Selecciona una Marca</h1>

    <form action="" method="POST">
        <label for="lab">Tipo de reparación</label>
        <select required name="applab" id="lab">
            <option>Seleccione</option>
            <?php
            // Iterar sobre las marcas y generar las opciones
            foreach ($marcas as $marca) {
                echo "<option value='" . htmlspecialchars($marca['marcas']) . "'>" . htmlspecialchars($marca['marcas']) . "</option>";
            }
            ?>
        </select>

        <button type="submit" name="submit">Guardar</button>
    </form>

</body>
</html>
