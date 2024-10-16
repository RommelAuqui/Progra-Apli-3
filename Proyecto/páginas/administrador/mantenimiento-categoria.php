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
    <script src="../../js/mantenimiento-categoria.js" defer></script>
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
            <h1>MANTENIMIENTO DE CATEGORÍA</h1>
            <h2>Buscar Categoría:</h2>
            <br>
            <form method="POST" action="">
                <div class="form-control">
                    <label for="buscar">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspID de Categoría:</label>
                    <input type="text" id="buscar" name="buscar" placeholder="Ingresa el ID de la categoría" 
                        value="<?php echo isset($_SESSION['buscar']) ? htmlspecialchars($_SESSION['buscar']) : ''; ?>" 
                        onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                    <button type="submit">Buscar</button>
                    
                    <a href="agregarDatos/agregar-categoria.php">
                        <button type="button" style="margin-left: 10px;">Insertar</button>
                    </a>
                </div>
            </form>
            <br>
            <h2>Categorías Registradas:</h2>
            <br>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $idBuscar = trim($_POST['buscar']);
                        $_SESSION['buscar'] = $idBuscar;

                        if ($idBuscar === '') {
                            $sql = "SELECT * FROM categoria";
                            $result = $conn->query($sql);
                        } else {
                            $sql = "SELECT * FROM categoria WHERE IDCat = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("i", $idBuscar);
                            $stmt->execute();
                            $resultado = $stmt->get_result();

                            if ($resultado->num_rows > 0) {
                                $result = $resultado;
                            } else {
                                echo "<script>alert('No hay registro en nuestra BD, intenta otro código');</script>";
                                $sql = "SELECT * FROM categoria";
                                $result = $conn->query($sql);
                            }

                            $stmt->close();
                        }
                    } else {
                        $sql = "SELECT * FROM categoria";
                        $result = $conn->query($sql);
                    }

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($row['IDCat']) . "</td>
                                    <td>" . htmlspecialchars($row['Nombre']) . "</td>
                                    <td>" . htmlspecialchars($row['Descripcion']) . "</td>
                                    <td>
                                        <a href='actualizarDatos/editar-categoria.php?id=" . htmlspecialchars($row['IDCat']) . "'>
                                            <button style='background-color: #FFD54F; color: black;'>Actualizar</button>
                                        </a>
                                        <button style='background-color: red;' onclick='confirmDelete(" . $row['IDCat'] . ")'>Eliminar</button>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No hay categorías registradas</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
