<?php
session_start();
require_once '../../../conexion/BD.php'; // Asegúrate de que esta ruta sea correcta
$conn = DB::getConnection();

$id_categoria = $_GET['id'];
$sql = "SELECT IDProv, Nombre, RUC, logo, Celular, direccion FROM proveedor WHERE IDProv = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_categoria);
$stmt->execute();
$resultado = $stmt->get_result()->fetch_assoc();

if (!$resultado) {
    echo "Proveedor no encontrada.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoría</title>
    <link rel="stylesheet" href="../../../estilos/estiloactuali.css">
</head>
<body>
    <div class="title-container">
        <h1>EDITAR PROVEEDOR</h1>
    </div>

    <form method="POST" action="../../../procesos/mant-proveedores.php">
        <input type="hidden" name="id_prov" value="<?php echo htmlspecialchars($resultado['IDProv']); ?>">
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($resultado['Nombre']); ?>" required>
        </div>
        <div>
            <label for="descripcion">RUC:</label>
            <input type="text" id="ruc" name="ruc" value="<?php echo htmlspecialchars($resultado['RUC']); ?>">
        </div>
        <div>
            <label for="celular">Celular:</label>
            <input type="text" id="celular" name="celular" value="<?php echo htmlspecialchars($resultado['Celular']); ?>">
        </div>
        <div>
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" value="<?php echo htmlspecialchars($resultado['direccion']); ?>">
        </div>
        <button type="submit" name="actualizar">Guardar</button>
    </form>
</body>
</html>
