<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="estilos/estiloLogin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="left">
            <div class="header-container">
                <img src="img/icono.png" class="corner-icon" alt="Icono" />
                <h3 class="corporation-name">CORPORACION IVAJA S.A.C.</h3>
            </div>
            <h2>Iniciar Sesión</h2>
            <form action="procesos/proc-logeo.php" method="POST">
                <div class="input-container">
                    <i class="fas fa-envelope"></i>
                    <label for="correo" style="display:none;">Correo:</label>
                    <input type="email" id="correo" name="correo" placeholder="Ingresa tu Correo Electrónico" required>
                </div>
                <div class="input-container" style="margin-top: 20px;">
                    <i class="fas fa-lock"></i>
                    <label for="password" style="display:none;">Contraseña:</label>
                    <input type="password" id="password" name="password" placeholder="Ingrese su contraseña" required>
                </div>
                <a href="#" class="forgot-password">Forgot password?</a>
                <button class="login-btn" type="submit">Iniciar Sesión</button>
            </form>
            <div class="signup">
                No tienes una cuenta? <a href="páginas/registro.php">Regístrate</a>
            </div>
        </div>
        <div class="right">
            <img src="img/logo2.jpg" class="logo-img" alt="Logo">
        </div>
    </div>
</body>
</html>