<?php
session_start();
require "funciones/conecta.php";

require "funciones/menu.php";
// Verificar si se proporcionó un ID de pedido en la URL
if(isset($_GET['id'])) {
    // Obtener el ID del pedido desde la URL
    $id_pedido = $_GET['id'];

    $con = conecta(); // Cambiado $con por $conn

    // Verificar la conexión
    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);
    }

    // Consulta SQL para obtener los detalles del pedido (con sentencia preparada para protección contra inyección SQL)
    $sql_pedido = "SELECT * FROM pedidos WHERE id = ?";
    $stmt_pedido = $con->prepare($sql_pedido);
    $stmt_pedido->bind_param("i", $id_pedido);
    $stmt_pedido->execute();
    $result_pedido = $stmt_pedido->get_result();

    if ($result_pedido->num_rows > 0) {
        $pedido = $result_pedido->fetch_assoc();

        // Verificar si id_cliente existe en el resultado
        $id_cliente = isset($pedido['id_cliente']) ? $pedido['id_cliente'] : null;

        // Consulta SQL para obtener la lista de productos asociados al pedido
        $sql_productos = "SELECT p.nombre AS producto, pp.cantidad, pp.precio, (pp.cantidad * pp.precio) AS subtotal
                            FROM pedidos_productos pp
                            JOIN productos p ON pp.id_producto = p.id
                            WHERE pp.id_pedido = ?";   
        $stmt_productos = $con->prepare($sql_productos);
        $stmt_productos->bind_param("i", $id_pedido);
        $stmt_productos->execute();
        $result_productos = $stmt_productos->get_result();

        // Almacenar los datos de los productos en un array
        $productos = array();
        if ($result_productos->num_rows > 0) {
            while($producto = $result_productos->fetch_assoc()) {
                $productos[] = $producto;
            }
        }

        // Si id_cliente está disponible, obtener el nombre del cliente (opcional)
        if ($id_cliente !== null) {
            $sql_cliente = "SELECT nombre FROM clientes WHERE id_cliente = ?";
            $stmt_cliente = $con->prepare($sql_cliente);
            $stmt_cliente->bind_param("i", $id_cliente);
            $stmt_cliente->execute();
            $result_cliente = $stmt_cliente->get_result();
            if ($result_cliente->num_rows > 0) {
                $cliente = $result_cliente->fetch_assoc();
                $nombre_cliente = $cliente['nombre'];
            }
        }
    } else {
        echo "No se encontró el pedido.";
    }

    // Cerrar conexión a la base de datos
    $con->close();
} else {
    echo "No se proporcionó un ID de pedido.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Pedido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffe6f2; /* Fondo rosita claro */
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff0f5; /* Fondo rosita más claro */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #cc3366; /* Título rosita oscuro */
        }

        p {
            margin: 0;
            color: #cc6699; /* Texto rosita */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ffb3d9; /* Borde rosita claro */
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #ffb3d9; /* Fondo de encabezado rosita */
        }

        .total {
            margin-top: 20px;
            font-weight: bold;
            color: #cc3366; /* Total rosita oscuro */
        }

        .btn-regresar {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #cc3366; /* Fondo botón rosita oscuro */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }

        .btn-regresar:hover {
            background-color: #b3245e; /* Fondo botón rosita más oscuro al pasar el ratón */
        }
    </style>
</head>
<body>

<div class="container">

<?php if(isset($pedido)) { ?>
    <h2>Detalle del Pedido</h2>
    <p>ID del Pedido: <?php echo $pedido['id']; ?></p>
    <p>Fecha del Pedido: <?php echo $pedido['fecha']; ?></p>
    <?php if(isset($nombre_cliente)) { ?>
        <p>Nombre del Cliente: <?php echo $nombre_cliente; ?></p>
    <?php } ?>

    <h3>Lista de Productos</h3>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $gran_total = 0; // Inicializar el gran total
            foreach ($productos as $producto) {
                echo "<tr>";
                echo "<td>" . $producto["producto"] . "</td>";
                echo "<td>" . $producto["cantidad"] . "</td>";
                echo "<td>" . $producto["precio"] . "</td>";
                echo "<td>" . $producto["subtotal"] . "</td>";
                echo "</tr>";
                $gran_total += $producto["subtotal"]; // Sumar al gran total
            }
            ?>
        </tbody>
    </table>

    <p class="total">Total del Pedido: <?php echo $gran_total; ?></p>
<?php } ?>

    <a href="pedidos_lista.php" class="btn-regresar">Regresar al listado</a>

</div>

</body>
</html>