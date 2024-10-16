<?php
session_start();
require_once '../conexion/BD.php';
$conn = DB::getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['insertar'])) {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];

        $sql = "INSERT INTO categoria (Nombre, Descripcion) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $nombre, $descripcion);
        $stmt->execute();
        $stmt->close();

    } elseif (isset($_POST['actualizar'])) {
        $id_categoria = $_POST['id_categoria'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
    
        $sql = "UPDATE categoria SET Nombre = ?, Descripcion = ? WHERE IDCat = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $nombre, $descripcion, $id_categoria);
        $stmt->execute();
        $stmt->close();
    
        header('Location: ../páginas/administrador/mantenimiento-categoria.php');
        exit();
        
    } elseif (isset($_POST['eliminar'])) {
        $id_categoria = $_POST['id_categoria'];
        $sql = "DELETE FROM categoria WHERE IDCat = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_categoria);
        $stmt->execute();
        $stmt->close();
    
        echo json_encode(['success' => true]);
        exit();

    } 
}

$conn->close();
header('Location: ../páginas/administrador/mantenimiento-categoria.php');
exit();
?>
