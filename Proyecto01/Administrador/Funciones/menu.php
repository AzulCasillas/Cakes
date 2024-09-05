<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }
        ul {
            list-style-type: none;
            padding: 0;
            background-color: #ff689d;
        }
        li {
            display: inline;
            margin-right: 90px;
        }
        li#nombreUser {
            color: white;
            font-size: 20px;
            font-weight: bold;
            margin-right: 10px;
        }
        li a {
            text-decoration: none;
            color: white;
            padding: 15px 15px; 
            transition: background-color 0.3s;
            font-size: 20px;
        }
        li a:hover {
            background-color: #c82a54;
        }
    </style>
</head>
<body>
    <ul>
        <li id="nombreUser">Bienvenido <?php echo $_SESSION['nombreUser']; ?></li>
        <li><a href="empleados_lista.php">Empleados</a></li>
        <li><a href="promociones_alta.php">Promociones</a></li>
        <li><a href="productos_lista.php">Productos</a></li>
        <li><a href="pedidos_lista.php">Pedidos</a></li>
        <li><a href="bienvenido.php">Inicio</a></li>
        <li><a href="cerrar_sesion.php">Salir</a></li>
    </ul>
</body>
</html>
