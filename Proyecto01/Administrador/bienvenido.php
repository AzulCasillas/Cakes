<?php
session_start();
require_once "funciones/menu.php";

if(!isset($_SESSION['nombreUser'])) {
    header("Location: index.php"); 
    exit;
}

$nombre = $_SESSION['nombreUser'];

require "funciones/conecta.php";
$con = conecta();

// Función para obtener todas las promociones de la base de datos
function obtenerPromociones($con) {
    $sql = "SELECT nombre, archivo FROM promociones";
    $resultados = $con->query($sql);

    $promociones = [];
    while ($row = $resultados->fetch_assoc()) {
        $promociones[] = $row;
    }

    return $promociones;
}

// Función para seleccionar una promoción al azar de un arreglo
function seleccionarPromocionAleatoria($promociones) {
    if (count($promociones) > 0) {
        return $promociones[array_rand($promociones)];
    } else {
        return null;
    }
}

// Obtener todas las promociones
$promociones = obtenerPromociones($con);

// Seleccionar una promoción al azar
$promocion_aleatoria = seleccionarPromocionAleatoria($promociones);

// Cerrar la conexión
$con->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Promociones</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 80vh;
            background-color: #f8f9fa;
        }

        #promocion {
            max-width: 400px;
            margin-top: 20px; /* Separar el banner del menú */
            text-align: center;
        }

        #promocion img {
            width: 80%;
            height: auto;
            display: block;
        }
    </style>
</head>
<body>
    <div id="promocion">
        <?php if ($promocion_aleatoria): ?>
            <img src="fotosPromociones/<?php echo htmlspecialchars($promocion_aleatoria['archivo']); ?>" alt="Promoción">
            <?php echo($promocion_aleatoria['nombre']); ?>
        <?php else: ?>
            <script> echo "No hay promociones disponibles en este momento"</script>
        <?php endif; ?>
    </div>
</body>
</html>



<html>
<head>
    <title>Bienvenido</title>
</head>
</html>
