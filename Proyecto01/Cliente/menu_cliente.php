
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
            margin: 0;
            background-color: #ff689d;
            display: flex;
            align-items: center;
            justify-content: space-around; /* Distribuye los elementos a lo largo del ancho */
            width: 100%; /* Asegura que el <ul> ocupe el ancho completo */
        }
        li {
            margin: 0; /* Elimina el margen para una distribución uniforme */
        }
        li#nombreUser {
            display: flex;
            align-items: center;
            color: white;
            font-size: 40px; /* Tamaño de fuente unificado */
            font-weight: bold;
        }
        li#nombreUser img {
            margin-right: 30px;
            width: 60px; /* Ajusta el tamaño de la imagen según sea necesario */
            height: auto;
        }
        li a {
            text-decoration: none;
            color: white;
            padding: 15px; 
            transition: background-color 0.3s;
            font-size: 25px; /* Tamaño de fuente unificado */
        }
        li a:hover {
            background-color: #c82a54;
        }
    </style>
</head>
<body>
    <ul>
        <li id="nombreUser">
            <img src="icono.jpg" alt="Imagen de Bienvenido">
            Bienvenido
        </li>
        <li><a href="bienvenido.php">Home</a></li>
        <li><a href="productos.php">Productos</a></li>
        <li><a href="form_correo.php">Contacto</a></li>
        <li><a href="carrito1.php">Carrito</a></li>
        <li><a href="salirC.php">Salir</a></li>
    </ul>
    
</body>
</html>
