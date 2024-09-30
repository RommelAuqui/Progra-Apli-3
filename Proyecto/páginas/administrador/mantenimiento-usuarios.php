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
    <title>Mantenimiento de Usuarios</title>
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
            <h1>Mantenimiento de Usuarios</h1>

            <!-- Formulario para buscar -->
            <h2>Buscar Usuario</h2>
            <form method="POST" action="../../procesos/mant-usuario.php">
                <div class="form-control">
                    <label for="buscar">ID de Usuario:</label>
                    <input type="text" id="buscar" name="buscar" placeholder="Escriba el ID para filtrar" 
                    value="<?php echo isset($_SESSION['buscar']) ? htmlspecialchars($_SESSION['buscar']) : ''; ?>" required>
                    <button type="submit">Buscar</button>
                </div>
            </form>

            <!-- Formulario para insertar/actualizar/eliminar categoría -->
            <form method="POST" action="../../procesos/mant-usuario.php">
                <div class="form-control">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" 
                        value="<?php echo isset($_SESSION['nombre']) ? htmlspecialchars($_SESSION['nombre']) : ''; ?>" required>
                </div>
                <div class="form-control">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" id="apellidos" name="apellidos" 
                        value="<?php echo isset($_SESSION['apellidos']) ? htmlspecialchars($_SESSION['apellidos']) : ''; ?>" required>
                </div>
                <div class="form-control">
                    <label for="correo">Correo:</label>
                    <input type="email" id="correo" name="correo" 
                        value="<?php echo isset($_SESSION['correo']) ? htmlspecialchars($_SESSION['correo']) : ''; ?>" required>
                </div>
                <div class="form-control">
                    <label for="celular">Celular:</label>
                    <input type="text" id="celular" name="celular" 
                        value="<?php echo isset($_SESSION['celular']) ? htmlspecialchars($_SESSION['celular']) : ''; ?>" required>
                </div>
                <div class="form-control">
                    <label for="contraseña">Contraseña:</label>
                    <input type="password" id="contraseña" name="contraseña" required>
                </div>
                <div class="form-control">
                    <label for="rol">Rol:</label>
                    <input type="text" id="rol" name="rol" pattern="^[1-3]$" 
                        title="1 No definido, 2 Vendedor, 3 Administrador" 
                        value="<?php echo isset($_SESSION['rol']) ? htmlspecialchars($_SESSION['rol']) : ''; ?>" required>
                </div>
                <div class="form-control">
                    <label for="estadoRegistro">Estado Registro:</label>
                    <input type="text" id="estadoRegistro" name="estadoRegistro" pattern="^[01]$" 
                        title="0 en Espera, 1 Aceptado" 
                        value="<?php echo isset($_SESSION['estadoRegistro']) ? htmlspecialchars($_SESSION['estadoRegistro']) : ''; ?>" required>
                </div>

                <input type="hidden" name="id_usuario" value="<?php echo isset($_SESSION['buscar']) ? htmlspecialchars($_SESSION['buscar']) : ''; ?>">

                <div class="form-control-buttons">
                    <button type="submit" name="insertar">Insertar</button>
                    <button type="submit" name="actualizar">Actualizar</button>
                    <button type="submit" name="eliminar">Eliminar</button>
                </div>
            </form>


            <h2>Usuarios Registrados</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID Usuario</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Correo</th>
                        <th>Celular</th>
                        <th>Rol</th>
                        <th>Estado Registro</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM usuario";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row['IDUsuario'] . "</td>
                                    <td>" . htmlspecialchars($row['Nombre']) . "</td>
                                    <td>" . htmlspecialchars($row['Apellido']) . "</td>
                                    <td>" . htmlspecialchars($row['Correo']) . "</td>
                                    <td>" . htmlspecialchars($row['Celular']) . "</td>
                                    <td>" . htmlspecialchars($row['IDRol']) . "</td>
                                    <td>" . htmlspecialchars($row['estadoRegistro']) . "</td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No hay usuarios registrados</td></tr>";
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
