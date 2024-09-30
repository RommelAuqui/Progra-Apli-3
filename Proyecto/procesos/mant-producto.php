<?php
session_start();
require_once '../conexion/BD.php';
$conn = DB::getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['buscar'])) {
        $idBuscar = $_POST['buscar'];
        $_SESSION['buscar'] = $idBuscar; 
        
        if (!is_numeric($idBuscar)) {
            echo "<script>alert('Por favor, ingrese un ID válido.'); window.history.back();</script>";
            exit();
        }

        $sql = "SELECT Nombre, Descripcion, Stock, PrecioVenta, FechaVencimiento, IDProv, IDCat FROM producto WHERE IDProducto = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idBuscar); 
        $stmt->execute();

        $resultado = $stmt->get_result()->fetch_assoc();

        if ($resultado) {
            // Guardar los datos en la sesión
            $_SESSION['nombre'] = $resultado['Nombre'];
            $_SESSION['descripcion'] = $resultado['Descripcion'];
            $_SESSION['stock'] = $resultado['Stock'];
            $_SESSION['precio_venta'] = $resultado['PrecioVenta'];
            $_SESSION['f_vencimiento'] = $resultado['FechaVencimiento'];
            $_SESSION['id_proveedor'] = $resultado['IDProv'];
            $_SESSION['id_categoria'] = $resultado['IDCat'];

            header('Location: ../páginas/administrador/mantenimiento-producto.php');
            exit();
        } else {
            echo "<script>alert('Producto no encontrado.'); window.history.back();</script>";
        }

    } elseif (isset($_POST['insertar'])) {
        // Lógica para insertar un nuevo producto
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $stock = (int)$_POST['stock'];
        $precio_venta = (float)$_POST['precio_venta'];
        $fecha_vencimiento = $_POST['f_vencimiento'];
        $id_categoria = $_POST['categoria'];
        $id_proveedor = $_POST['proveedor'];

        // Manejo de la imagen
        $imagen = null;
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
            $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
        }

        $sql = "INSERT INTO producto (Nombre, Descripcion, Stock, PrecioVenta, Imagen, FechaVencimiento, IDProv, IDCat) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssidsbii", $nombre, $descripcion, $stock, $precio_venta, $imagen, $fecha_vencimiento, $id_proveedor, $id_categoria);
        $stmt->execute();
        $stmt->close();

    } elseif (isset($_POST['eliminar'])) {
        // Lógica para eliminar un producto
        $id_producto = $_POST['id_producto'];

        $sql = "DELETE FROM producto WHERE IDProducto = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_producto);
        $stmt->execute();
        $stmt->close();
    }
}

$conn->close();
header('Location: ../páginas/administrador/mantenimiento-producto.php');
exit();
?>
