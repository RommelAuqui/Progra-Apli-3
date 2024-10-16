<?php
session_start();
require_once '../../../conexion/BD.php';
$conn = DB::getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nombre']) && isset($_POST['ruc']) && isset($_POST['celular']) && isset($_POST['direccion'])) {
        $nombre = $_POST['nombre'];
        $ruc = $_POST['ruc'];
        $celular = $_POST['celular'];
        $direccion = $_POST['direccion'];

        $sql = "INSERT INTO proveedor (Nombre, RUC, Celular, direccion) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssss", $nombre, $ruc, $celular, $direccion);
            if ($stmt->execute()) {
                // Redirigir después de la inserción
                header('Location: ../mantenimiento-proveedor.php'); 
                exit();
            } else {
                echo "<script>alert('Error al insertar el proveedor: " . $stmt->error . "');</script>";
            }
            $stmt->close();
        } else {
            echo "<script>alert('Error en la preparación de la consulta: " . $conn->error . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Proveedor</title>
    <link rel="stylesheet" href="../../../estilos/estiloinsertar.css">
</head>
<body>
    
    <div class="title-container">
        <h1>AGREGAR NUEVO PROVEEDOR</h1>
    </div>

    <form method="POST" action="">
        <div class="form-control">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>
        <div class="form-control">
            <label for="ruc">RUC:</label>
            <input type="text" id="ruc" name="ruc" required>
        </div>
        <div class="form-control">
            <label for="celular">Celular:</label>
            <input type="text" id="celular" name="celular" required>
        </div>
        <div class="form-control">
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" required>
        </div>
        <div class="form-control-buttons">
            <button type="submit">Guardar</button>
        </div>
    </form>
</body>
</html>
