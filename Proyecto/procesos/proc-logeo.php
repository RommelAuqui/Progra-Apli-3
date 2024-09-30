<?php
require_once '../conexion/BD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = DB::getConnection();

    if ($conn === null) {
        die("Conexión fallida.");
    }

    $correo = $_POST['correo'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT Contraseña, IDUsuario, IDRol, estadoRegistro FROM usuario WHERE Correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password, $idUsuario, $idRol, $estadoRegistro);
        $stmt->fetch();

        if ($estadoRegistro == 0) {
            echo "El registro no ha sido confirmado.";
        } else {
            if (password_verify($password, $hashed_password)) {
                session_start();
                $_SESSION['IDUsuario'] = $idUsuario;

                if ($idRol == 3) { 
                    header("Location: ../páginas/administrador/adm-principal.php");
                    exit();
                } else if ($idRol == 2) {
                    header("Location: ../páginas/vendedor/vend-principal.php");
                } else {
                    echo "Rol no definido";
                }
            } else {
                echo "Contraseña incorrecta.";
            }
        }
    } else {
        echo "Correo no encontrado.";
    }

    $stmt->close();
    $conn->close();
}
?>
