<?php
session_start();
if(!isset($_SESSION['nombreUser'])) {
    header("Location: index.php");
    exit;
}
require "menu_cliente.php";
require "../Administrador/funciones/conecta.php";
$con = conecta();

function obtenerPromociones($con) {
    $sql = "SELECT nombre, archivo FROM promociones";
    $resultados = $con->query($sql);

    $promociones = [];
    while ($row = $resultados->fetch_assoc()) {
        $promociones[] = $row;
    }

    return $promociones;
}

function seleccionarPromocionAleatoria($promociones) {
    if (count($promociones) > 0) {
        return $promociones[array_rand($promociones)];
    } else {
        return null;
    }
}

$promociones = obtenerPromociones($con);
$promocion_aleatoria = seleccionarPromocionAleatoria($promociones);

$con->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Promociones y Productos</title>
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
            height: 400px; /* Ajustar la altura fija de la imagen */
            object-fit: cover; /* Asegurarse de que la imagen cubra el contenedor */
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
            width: 100%;
            height: 400px; /* Ajustar la altura fija de la imagen */
            object-fit: cover; /* Asegurarse de que la imagen cubra el contenedor */
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
    <div id="banner">
        <?php if ($promocion_aleatoria): ?>
            <img src="../Administrador/fotosPromociones/<?php echo htmlspecialchars($promocion_aleatoria['archivo']); ?>" alt="Promoción">
            <p><?php echo htmlspecialchars($promocion_aleatoria['nombre']); ?></p>
        <?php else: ?>
            <p>No hay promociones disponibles.</p>
        <?php endif; ?>
    </div>
    <div id="productos">
        <!-- Aquí iría el código para mostrar los productos -->
    </div>
    <footer>
        <p> 2024 BRUNO'S. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
