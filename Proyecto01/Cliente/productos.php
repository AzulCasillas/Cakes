<?php
require "menu_cliente.php";
require_once "../Administrador/funciones/conecta.php";
require "productos2.php"; 

$con = conecta();

$con->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Productos</title>
    <style>
        nav {
            background-color: #444;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f8f9fa;
        }

        #banner {
            max-width: 600px;
            margin-top: 20px;
            text-align: center;
        }

        #banner img {
            width: 100%;
            height: auto;
            max-height: 400px;
            object-fit: cover; 
            display: block;
        }

        #banner p {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
            color: #333;
        }

        #productos {
            max-width: 800px;
            margin-top: 20px;
            text-align: center;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            padding: 10px;
        }

        .producto {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
        }

        .producto img {
            width: 250px;
            height: 400px; 
            object-fit: cover; 
            border-bottom: 1px solid #ddd;
            margin-bottom: 10px;
        }

        .producto p {
            margin: 5px 0;
        }

        .producto form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        footer {
            margin-top: 20px;
            background-color: #c82a54;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            width: 100%;
        }
    </style>
</head>
<body>

    <div id="productos">
        <?php if (!empty($productosAleatorios)): ?>
            <?php foreach ($productosAleatorios as $producto): ?>
                <div class="producto">
                    <img src="../Administrador/archivos/<?php echo htmlspecialchars($producto['archivo']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                    <p><?php echo htmlspecialchars($producto['nombre']); ?></p>
                    <p>Costo: $<?php echo number_format($producto['costo'], 2); ?></p>
                    <form method="post" action="producto_bd.php">
                        <input type="hidden" name="producto_id" value="<?php echo $producto['id']; ?>">
                        <label for="cantidad_<?php echo $producto['id']; ?>">Cantidad:</label>
                        <input type="number" id="cantidad_<?php echo $producto['id']; ?>" name="cantidad" min="1" value="1">
                        <button type="submit" style="color:#c82a54;">Agregar al carrito</button>
                    </form>
                    <button><a style="color:#c82a54;"href="productodetalle.php?id=<?php echo $producto['id']; ?>">Detalles</a></button>

                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay productos disponibles.</p>
        <?php endif; ?>
    </div>
    <footer>
        <p> 2024 BRUNO'S. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
