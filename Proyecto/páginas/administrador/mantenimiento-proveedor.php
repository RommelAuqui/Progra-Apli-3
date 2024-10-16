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
    <title>Mantenimiento de Proveedores</title>
    <link rel="stylesheet" href="../../estilos/mantenimiento.css">
    <script src="../../js/sidebar.js" defer></script>
    <script src="../../js/mantenimiento-proveedor.js" defer></script>
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
                <li class="active"><a href="adm-principal.php">Inicio</a></li>
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
            <div class="logout" onclick="location.href='../../login.php'" style="cursor: pointer;">Cerrar Sesión</div>
        </div>

        <div class="content">
            <h1>Mantenimiento de Proveedores</h1>

            <h2>Buscar Proveedor</h2>
            <form method="POST" action="">
                <div class="form-control">
                    <label for="buscar">ID de Proveedor:</label>
                    <input type="text" id="buscar" name="buscar" placeholder="Ingresa el ID del proveedor" 
                        value="<?php echo isset($_SESSION['buscar']) ? htmlspecialchars($_SESSION['buscar']) : ''; ?>" 
                        onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                    <button type="submit">Buscar</button>
                    <a href="agregarDatos/agregar-proveedor.php">
                        <button type="button" style="margin-left: 10px;">Insertar</button>
                    </a>
                </div>
            </form>

            <h2>Proveedores Registrados</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID Proveedor</th>
                        <th>Nombre</th>
                        <th>RUC</th>
                        <th>Celular</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Inicializar la variable $result
                    $result = null;

                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buscar'])) {
                        $idBuscar = trim($_POST['buscar']);
                        $_SESSION['buscar'] = $idBuscar;

                        if ($idBuscar === '') {
                            $sql = "SELECT * FROM proveedor";
                        } else {
                            $sql = "SELECT * FROM proveedor WHERE IDProv = ?";
                        }
                        
                        // Preparar y ejecutar la consulta
                        $stmt = $conn->prepare($sql);

                        if ($idBuscar !== '') {
                            $stmt->bind_param("i", $idBuscar);
                        }

                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();
                    } 

                    // Si no hay resultado, consulta todos los proveedores
                    if ($result === null) {
                        $sql = "SELECT * FROM proveedor";
                        $result = $conn->query($sql);
                    }

                    // Mostrar los resultados
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($row['IDProv']) . "</td>
                                    <td>" . htmlspecialchars($row['Nombre']) . "</td>
                                    <td>" . htmlspecialchars($row['RUC']) . "</td>
                                    <td>" . htmlspecialchars($row['Celular']) . "</td>
                                    <td>" . htmlspecialchars($row['direccion']) . "</td>
                                    <td>
                                        <a href='actualizarDatos/editar-proveedor.php?id=" . htmlspecialchars($row['IDProv']) . "'>
                                            <button style='background-color: #FFD54F; color: black;'>Actualizar</button>
                                        </a>
                                        <button style='background-color: red;' onclick='confirmDelete(" . $row['IDProv'] . ")'>Eliminar</button>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No hay proveedores registrados</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
