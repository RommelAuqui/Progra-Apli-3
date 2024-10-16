<?php
session_start();
require_once '../../../conexion/BD.php'; // Asegúrate de que esta ruta sea correcta
$conn = DB::getConnection();

$id_categoria = $_GET['id'];
$sql = "SELECT IDCat, Nombre, Descripcion FROM categoria WHERE IDCat = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_categoria);
$stmt->execute();
$resultado = $stmt->get_result()->fetch_assoc();

if (!$resultado) {
    echo "Categoría no encontrada.";
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
        <h1>EDITAR CATEGORIA</h1>
    </div>

    <form method="POST" action="../../../procesos/mant-cat.php">
        <input type="hidden" name="id_categoria" value="<?php echo htmlspecialchars($resultado['IDCat']); ?>">
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($resultado['Nombre']); ?>" required>
        </div>
        <div>
            <label for="descripcion">Descripción:</label>
            <input type="text" id="descripcion" name="descripcion" value="<?php echo htmlspecialchars($resultado['Descripcion']); ?>">
        </div>
        <button type="submit" name="actualizar">Guardar</button>
    </form>
</body>
</html>
