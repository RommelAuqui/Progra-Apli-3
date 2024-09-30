<?php
    session_start();
    require_once '../../conexion/BD.php';
    $conn = DB::getConnection();
?>
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
            <h1>Mantenimiento de Categoría</h1>

            <!-- Formulario de búsqueda -->
            <h2>Buscar Categoría</h2>
            <form method="POST" action="../../procesos/mant-cat.php">
                <div class="form-control">
                    <label for="buscar">ID de Categoría:</label>
                    <input type="text" id="buscar" name="buscar" placeholder="Escriba el ID para filtrar" 
                    value="<?php echo isset($_SESSION['buscar']) ? htmlspecialchars($_SESSION['buscar']) : ''; ?>" required>
                    <button type="submit">Buscar</button>
                </div>
            </form>

            <!-- Formulario para insertar/actualizar/eliminar categoría -->
            <form method="POST" action="../../procesos/mant-cat.php">
            <div class="form-control">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo isset($_SESSION['nombre']) ? htmlspecialchars($_SESSION['nombre']) : ''; ?>" >
            </div>
            <div class="form-control">
                <label for="descripcion">Descripción:</label>
                <input type="text" id="descripcion" name="descripcion" value="<?php echo isset($_SESSION['descripcion']) ? htmlspecialchars($_SESSION['descripcion']) : ''; ?>" >
            </div>
            <input type="hidden" name="id_categoria" value="<?php echo isset($_SESSION['buscar']) ? htmlspecialchars($_SESSION['buscar']) : ''; ?>">

            <!-- Botones alineados en fila -->
            <div class="form-control-buttons">
                <button type="submit" name="insertar">Insertar</button>
                <button type="submit" name="actualizar">Actualizar</button>
                <button type="submit" name="eliminar">Eliminar</button>
            </div>
            </form>

            <h2>Categorías Registradas</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM categoria";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row['IDCat'] . "</td>
                                    <td>" . $row['Nombre'] . "</td>
                                    <td>" . $row['Descripcion'] . "</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No hay categorías registradas</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php
    unset($_SESSION['nombre']);
    unset($_SESSION['descripcion']);
    ?>
</body>
</html>
