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
    <title>Mantenimiento de Productos</title>
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
            <h1>Mantenimiento de Productos</h1>

            <!-- Formulario para buscar -->
            <h2>Buscar Producto</h2>
            <form method="POST" action="../../procesos/mant-producto.php">
                <div class="form-control">
                    <label for="buscar">ID de Producto:</label>
                    <input type="text" id="buscar" name="buscar" placeholder="Escriba el ID para filtrar" 
                    value="<?php echo isset($_SESSION['buscar']) ? htmlspecialchars($_SESSION['buscar']) : ''; ?>" required>
                    <button type="submit">Buscar</button>
                </div>
            </form>

            <!-- Formulario para insertar/actualizar/eliminar producto -->
            <form method="POST" action="../../procesos/mant-producto.php" enctype="multipart/form-data">
                <div class="form-control">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" 
                        value="<?php echo isset($_SESSION['nombre']) ? htmlspecialchars($_SESSION['nombre']) : ''; ?>" required>
                </div>
                <div class="form-control">
                    <label for="descripcion">Descripción:</label>
                    <input type="text" id="descripcion" name="descripcion" 
                        value="<?php echo isset($_SESSION['descripcion']) ? htmlspecialchars($_SESSION['descripcion']) : ''; ?>" required>
                </div>
                <div class="form-control">
                    <label for="stock">Stock:</label>
                    <input type="number" id="stock" name="stock" 
                        value="<?php echo isset($_SESSION['stock']) ? htmlspecialchars($_SESSION['stock']) : ''; ?>" required>
                </div>
                <div class="form-control">
                    <label for="precio_venta">Precio Venta:</label>
                    <input type="number" step="0.01" id="precio_venta" name="precio_venta" 
                        value="<?php echo isset($_SESSION['precio_venta']) ? htmlspecialchars($_SESSION['precio_venta']) : ''; ?>" required>
                </div>
                <div class="form-control">
                    <label for="imagen">Imagen:</label>
                    <input type="file" id="imagen" name="imagen" accept="image/*">
                </div>
                <div class="form-control">
                    <label for="f_vencimiento">F. Vencimiento:</label>
                    <input type="date" id="f_vencimiento" name="f_vencimiento" 
                        value="<?php echo isset($_SESSION['f_vencimiento']) ? htmlspecialchars($_SESSION['f_vencimiento']) : ''; ?>" >
                </div>
                <div class="form-control">
                    <label for="categoria">Categoría:</label>
                    <select id="categoria" name="categoria">
                        <option value="">Seleccione una categoría</option>
                        <?php
                        $catSql = "SELECT * FROM categoria";
                        $catResult = $conn->query($catSql);
                        while ($catRow = $catResult->fetch_assoc()) {
                            echo "<option value='" . $catRow['IDCat'] . "'>" . htmlspecialchars($catRow['Nombre']) . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-control">
                    <label for="proveedor">Proveedor:</label>
                    <select id="proveedor" name="proveedor">
                        <option value="">Seleccione un proveedor</option>
                        <?php
                        $provSql = "SELECT * FROM proveedor";
                        $provResult = $conn->query($provSql);
                        while ($provRow = $provResult->fetch_assoc()) {
                            echo "<option value='" . $provRow['IDProv'] . "'>" . htmlspecialchars($provRow['Nombre']) . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <input type="hidden" name="id_producto" value="<?php echo isset($_SESSION['buscar']) ? htmlspecialchars($_SESSION['buscar']) : ''; ?>">

                <div class="form-control-buttons">
                    <button type="submit" name="insertar">Insertar</button>
                    <button type="submit" name="eliminar">Eliminar</button>
                </div>
            </form>

            <h2>Productos Registrados</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID Producto</th>
                        <th>Nombre</th>
                        <th>Stock</th>
                        <th>Precio Venta</th>
                        <th>F. Vencimiento</th>
                        <th>ID Proveedor</th>
                        <th>ID Categoría</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT IDProducto, Nombre, Stock, PrecioVenta, FechaVencimiento, IDProv, IDCat FROM producto";
                    $result = $conn->query($sql);
             
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($row['IDProducto']) . "</td>
                                    <td>" . htmlspecialchars($row['Nombre']) . "</td>
                                    <td>" . htmlspecialchars($row['Stock']) . "</td>
                                    <td>" . htmlspecialchars($row['PrecioVenta']) . "</td>
                                    <td>" . htmlspecialchars($row['FechaVencimiento']) . "</td>
                                    <td>" . htmlspecialchars($row['IDProv']) . "</td>
                                    <td>" . htmlspecialchars($row['IDCat']) . "</td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No hay productos registrados</td></tr>";
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
    unset($_SESSION['stock']);
    unset($_SESSION['precio_venta']);
    unset($_SESSION['f_vencimiento']);
    ?>
</body>
</html>
