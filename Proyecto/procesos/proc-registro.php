<?php
require_once '../conexion/BD.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = DB::getConnection();

    if ($conn === null) {
        die("Conexión fallida.");
    }

    // Escapar los valores del formulario
    $nombres = mysqli_real_escape_string($conn, $_POST['nombres']);
    $apellidos = mysqli_real_escape_string($conn, $_POST['apellidos']);
    $correo = mysqli_real_escape_string($conn, $_POST['correo']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm-password']);
    $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
    $direccion = mysqli_real_escape_string($conn, $_POST['direccion']);

    // Verificar si las contraseñas coinciden
    if ($password !== $confirm_password) {
        die("Las contraseñas no coinciden.");
    }

    // Asignar el rol de usuario (ajustar según necesidad)
    $rolUs = 1;
    
    // Hashear la contraseña
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insertar datos en la base de datos
    $sql = "INSERT INTO usuario (Nombre, Apellido, Celular, Correo, Contraseña, IDRol) 
            VALUES ('$nombres', '$apellidos', '$telefono', '$correo', '$hashed_password', $rolUs)";

    if ($conn->query($sql) === TRUE) {
        // Mandar el estado exitoso en la redirección
        header("Location: ../login.php?status=registroexitoso");
        exit();
    } else {
        // En caso de error, redirigir con un mensaje de error
        header("Location: ../registro.php?status=registroerroneo&mensaje=" . urlencode($conn->error));
        exit();
    }

    // Cerrar la conexión
    $conn->close();
}
?>
