<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantenimiento de Categoría</title>
    <link rel="stylesheet" href="../../estilos/mantenimiento.css">
    <script src="../../js/sidebar.js" defer></script>
</head>
<body>
    <header>
        <div class="menu-icon" onclick="toggleSidebar()">☰</div>
        <img src="../../img/icono.png" class="img-header">
        <h1>Corporación Ivaja SAC</h1>
    </header>

    <div class="container">
        <div class="sidebar" id="sidebar">
            <ul>
                <li class="active">
                    <a href="adm-principal.php">Inicio</a>
                </li>
                <li onclick="toggleMenu()">Mantenimiento</li>
                <ul id="mantenimiento-submenu" class="submenu">
                    <li><a href="mantenimiento-categoria.php">Categoría</a></li>
                    <li><a href="mantenimiento-producto.php">Producto</a></li>
                    <li><a href="mantenimiento-proveedor.php">Proveedor</a></li>
                    <li><a href="mantenimiento-vendedor.php">Vendedor</a></li>
                    <li><a href="mantenimiento-usuarios.php">Usuarios</a></li>
                </ul>
                <li><a href="compras.php">Compras</a></li>
                <li><a href="ventas.php">Ventas</a></li>
            </ul>
            <div class="logout" onclick="location.href='../../login.php'" style="cursor: pointer;">
                Cerrar Sesión
            </div>
        </div>

        <div class="content">
            
        </div>
    </div>
</body>
</html>
