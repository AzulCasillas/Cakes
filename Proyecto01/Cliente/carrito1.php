<?php
session_start();

require "menu_cliente.php";
$id_cliente_actual = $_SESSION['idUser'];

if (!isset($id_cliente_actual) || empty($id_cliente_actual)) {
    die("Error: No se ha encontrado el ID del cliente.");
}

require "../Administrador/funciones/conecta.php";
$conexion = conecta();

$query = "SELECT pp.id AS id_detalle, p.nombre AS nombre_producto, pp.cantidad, p.costo
          FROM pedidos_productos pp
          INNER JOIN productos p ON pp.id_producto = p.id
          INNER JOIN pedidos ped ON pp.id_pedido = ped.id
          WHERE ped.status = 0 AND ped.id_clientes = '$id_cliente_actual'";
$resultado = $conexion->query($query);

if (!$resultado) {
    die("Error en la consulta SQL: " . $conexion->error);
}

$carrito_productos = [];
$total_carrito = 0;

while ($fila = $resultado->fetch_assoc()) {
    $total_producto = $fila['cantidad'] * $fila['costo'];
    $total_carrito += $total_producto;

    $carrito_productos[] = [
        'id_detalle' => $fila['id_detalle'],
        'nombre_producto' => $fila['nombre_producto'],
        'cantidad' => $fila['cantidad'],
        'costo_unitario' => $fila['costo'],
        'total' => $total_producto
    ];
}

$conexion->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Carrito</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            color: #333;
        }

        .contenedor {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        h1 {
            text-align: center;
            color: #c82a54;
        }

        .tabla {
            width: 100%;
            margin-top: 20px;
        }

        .fila, .encabezado {
            display: flex;
            justify-content: space-between;
            padding: 8px;
            border: 1px solid #ddd;
        }

        .encabezado {
            background-color: pink;
            font-weight: bold;
        }

        .fila:nth-child(even) {
            background-color: #ffebef;
        }

        .subtotal {
            font-weight: bold;
            color:#c82a54;
        }

        .celda {
            flex: 1;
            text-align: left;
        }

        .celda.acciones {
            flex: 2;
            text-align: center;
        }

        button {
            background-color: #ff80bf;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 4px 2px;
            cursor: pointer;
        }

        button:hover {
            background-color: #e67399;
        }

        footer {
            margin-top: 20px;
            background-color: #c82a54;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            width: 100%;
            margin-top: 130px; 
        }

        form {
            text-align: center;
            margin-top: 20px;
        }

        .mensaje {
            text-align: center;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <h1>Carrito 1/2</h1>
        <?php if (!empty($carrito_productos)): ?>
            <div class="tabla">
                <div class="encabezado">
                    <div class="celda">Producto</div>
                    <div class="celda">Cantidad</div>
                    <div class="celda">Costo Unitario</div>
                    <div class="celda">Total</div>
                    <div class="celda acciones">Editar</div>
                </div>
                <?php foreach ($carrito_productos as $producto): ?>
                    <div class="fila">
                        <div class="celda"><?php echo htmlspecialchars($producto['nombre_producto']); ?></div>
                        <div class="celda"><?php echo $producto['cantidad']; ?></div>
                        <div class="celda">$<?php echo number_format($producto['costo_unitario'], 2); ?></div>
                        <div class="celda">$<?php echo number_format($producto['total'], 2); ?></div>
                        <div class="celda acciones">
                            <form method="post" action="eliminarcarrito.php">
                                <input type="hidden" name="id_detalle" value="<?php echo $producto['id_detalle']; ?>">
                                <button type="submit">Eliminar</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="fila">
                    <div class="celda subtotal" colspan="3">Total:</div>
                    <div class="celda subtotal">$<?php echo number_format($total_carrito, 2); ?></div>
                    <div class="celda"></div>
                </div>
            </div>
        <?php else: ?>
            <p class="mensaje">Carrito vacio.</p>
        <?php endif; ?>

        <form action="carrito2.php" method="post">
            <input type="hidden" name="dato_ficticio" value="valor_ficticio">
            <button type="submit">Continuar</button>
        </form>
    </div>
    <footer>
        <p> 2024 BRUNO'S. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
