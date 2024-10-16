<?php
session_start();
require_once '../conexion/BD.php';
$conn = DB::getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['insertar'])) {
        $nombre = $_POST['nombre'];
        $ruc = $_POST['ruc'];
        $celular = $_POST['celular'];
        $direccion = $_POST['direccion'];

        $sql = "INSERT INTO proveedor (Nombre, RUC, Celular, Direccion) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $nombre, $ruc, $celular, $direccion);

        if ($stmt->execute()) {
            echo "<script>alert('Proveedor insertado correctamente.');</script>";
        } else {
            echo "<script>alert('Error al insertar el proveedor: " . $stmt->error . "');</script>";
        }
        $stmt->close();
        header('Location: ../páginas/administrador/mantenimiento-proveedor.php');
        exit();
    }

    elseif (isset($_POST['actualizar'])) {
        $id_proveedor = $_POST['id_prov'];
        $nombre = $_POST['nombre'];
        $RUC = $_POST['ruc'];
        $celular = $_POST['celular'];
        $direccion = $_POST['direccion'];
    
        $sql = "UPDATE proveedor SET Nombre = ?, RUC = ?, Celular = ?, direccion = ? WHERE IDProv = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("siisi", $nombre, $RUC, $celular, $direccion, $id_proveedor);
        $stmt->execute();
        $stmt->close();
    
        header('Location: ../páginas/administrador/mantenimiento-proveedor.php');
        exit();
    }

    // Eliminar proveedor
    elseif (isset($_POST['eliminar'])) {
        $id_proveedor = $_POST['id_proveedor']; // Asegúrate de que sea 'id_proveedor'
        
        if (!is_numeric($id_proveedor)) {
            echo json_encode(['success' => false, 'message' => 'ID de proveedor no válido.']);
            exit();
        }
        
        $sql = "DELETE FROM proveedor WHERE IDProv = ?";
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            $stmt->bind_param("i", $id_proveedor);
            
            if ($stmt->execute()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al eliminar el proveedor: ' . $stmt->error]);
            }
            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'Error en la consulta: ' . $conn->error]);
        }
        exit();
    }
}

$conn->close();
?>
