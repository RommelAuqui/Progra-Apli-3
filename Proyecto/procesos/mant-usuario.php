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

        $sql = "SELECT Nombre, Apellido, Correo, Celular, IDRol, estadoRegistro FROM usuario WHERE IDUsuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idBuscar); 
        $stmt->execute();

        $resultado = $stmt->get_result()->fetch_assoc();

        if ($resultado) {
            // Guardar los datos en la sesión
            $_SESSION['nombre'] = $resultado['Nombre'];
            $_SESSION['apellidos'] = $resultado['Apellido'];
            $_SESSION['correo'] = $resultado['Correo'];
            $_SESSION['celular'] = $resultado['Celular'];
            $_SESSION['rol'] = $resultado['IDRol'];
            $_SESSION['estadoRegistro'] = $resultado['estadoRegistro'];

            header('Location: ../páginas/administrador/mantenimiento-usuarios.php');
            exit();
        } else {
            echo "<script>alert('Usuario no encontrado.'); window.history.back();</script>";
        }

    } elseif (isset($_POST['insertar'])) {
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $correo = $_POST['correo'];
        $celular = $_POST['celular'];
        $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);
        $rol = (int)$_POST['rol']; 
        $estadoRegistro = (int)$_POST['estadoRegistro']; 
        
        $sql = "INSERT INTO usuario (Nombre, Apellido, Correo, Celular, Contraseña, IDRol, estadoRegistro) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssii", $nombre, $apellidos, $correo, $celular, $contraseña, $rol, $estadoRegistro);
        $stmt->execute();
        $stmt->close();

    } elseif (isset($_POST['actualizar'])) {
        // Lógica para actualizar
        $id_usuario = $_POST['id_usuario']; // Obtener el ID del usuario a actualizar
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $correo = $_POST['correo'];
        $celular = $_POST['celular'];
        $rol = (int)$_POST['rol']; 
        $estadoRegistro = (int)$_POST['estadoRegistro']; 

        $sql = "UPDATE usuario SET Nombre = ?, Apellido = ?, Correo = ?, Celular = ?, IDRol = ?, estadoRegistro = ? WHERE IDUsuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssii", $nombre, $apellidos, $correo, $celular, $rol, $estadoRegistro, $id_usuario);
        $stmt->execute();
        $stmt->close();

    } elseif (isset($_POST['eliminar'])) {
        $id_usuario = $_POST['id_usuario']; // Obtener el ID del usuario a eliminar

        $sql = "DELETE FROM usuario WHERE IDUsuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $stmt->close();
    }
}

$conn->close();
header('Location: ../páginas/administrador/mantenimiento-usuarios.php');
exit();
?>
