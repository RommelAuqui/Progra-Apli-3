<?php
session_start();
require_once '../conexion/BD.php';
$conn = DB::getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Buscar usuario
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
            $_SESSION['nombre'] = $resultado['Nombre'];
            $_SESSION['apellidos'] = $resultado['Apellido'];
            $_SESSION['correo'] = $resultado['Correo'];
            $_SESSION['celular'] = $resultado['Celular'];
            $_SESSION['rol'] = $resultado['IDRol'];
            $_SESSION['estadoRegistro'] = $resultado['estadoRegistro'];
        } else {
            echo "<script>alert('Usuario no encontrado.'); window.history.back();</script>";
        }
        header('Location: ../páginas/administrador/mantenimiento-usuarios.php');
        exit();
    }

    // Insertar nuevo usuario
    if (isset($_POST['insertar'])) {
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

        if ($stmt->execute()) {
            echo "<script>alert('Usuario insertado correctamente.');</script>";
        } else {
            echo "<script>alert('Error al insertar el usuario: " . $stmt->error . "');</script>";
        }
        $stmt->close();
        header('Location: ../páginas/administrador/mantenimiento-usuarios.php');
        exit();
    }

    // Actualizar usuario
    if (isset($_POST['actualizar'])) {
        $id_usuario = $_POST['id_usuario'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $correo = $_POST['correo'];
        $celular = $_POST['celular'];
        $rol = (int)$_POST['rol'];
        $estadoRegistro = (int)$_POST['estadoRegistro'];

        $sql = "UPDATE usuario SET Nombre = ?, Apellido = ?, Correo = ?, Celular = ?, IDRol = ?, estadoRegistro = ? WHERE IDUsuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssii", $nombre, $apellidos, $correo, $celular, $rol, $estadoRegistro, $id_usuario);

        if ($stmt->execute()) {
            echo "<script>alert('Usuario actualizado correctamente.');</script>";
        } else {
            echo "<script>alert('Error al actualizar el usuario: " . $stmt->error . "');</script>";
        }
        $stmt->close();
        header('Location: ../páginas/administrador/mantenimiento-usuarios.php');
        exit();
    }

 // Eliminar usuario
 if (isset($_POST['eliminar'])) {
    $id_usuario = $_POST['id_usuario'];

    if (!is_numeric($id_usuario)) {
        echo "<script>alert('ID de usuario no válido.'); window.history.back();</script>";
        exit();
    }

    $sql = "DELETE FROM usuario WHERE IDUsuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_usuario);

    if ($stmt->execute()) {
        echo "<script>alert('Usuario eliminado correctamente.');</script>";
    } else {
        echo "<script>alert('Error al eliminar el usuario: " . $stmt->error . "');</script>";
    }
    $stmt->close();
    header('Location: ../páginas/administrador/mantenimiento-usuarios.php');
    exit();
}
}

$conn->close();
?>