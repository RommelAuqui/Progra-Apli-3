<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../estilos/estiloRegistro.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="js/validarForm.js" defer></script>
</head>
<body>
    <div class="container">
        <div class="left">
            <div class="header-container">
                <img src="../img/icono.png" class="corner-icon" alt="Icono" />
                <h3 class="corporation-name">CORPORACION IVAJA S.A.C.</h3>
            </div>
            <h2>Registro</h2>
            <form action="../procesos/proc-registro.php" method="POST" onsubmit="return validarFormulario()">
                <div class="input-container">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Ingresa tu nombre" name="nombres" required>
                </div>
                <div class="input-container" style="margin-top: 20px;">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Ingresa tus apellidos" name="apellidos" required>
                </div>
                <div class="input-container" style="margin-top: 20px;">
                    <i class="fas fa-envelope"></i>
                    <input type="email" placeholder="Ingresa tu correo" name="correo" required>
                </div>
                <div class="input-container" style="margin-top: 20px;">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Ingresa tu contraseña" name="password" required>
                </div>
                <div class="input-container" style="margin-top: 20px;">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Confirma tu contraseña" name="confirm-password" required>
                </div>
                <div class="input-container" style="margin-top: 20px;">
                    <i class="fas fa-phone"></i>
                    <input type="tel" placeholder="Ingresa tu teléfono" name="telefono" required>
                </div>
                <div class="input-container" style="margin-top: 20px;">
                    <i class="fas fa-home"></i>
                    <input type="text" placeholder="Ingresa tu dirección" name="direccion" required>
                </div>
                <button class="register-btn">Registrar</button>
            </form>
            <div class="signup">
                Ya tienes una cuenta? <a href="../login.php">Inicia Sesión</a>
            </div>
        </div>
        <div class="right">
            <img src="../img/logo1.jpg" class="logo-img" alt="Logo">
        </div>
    </div>
</body>
</html>
