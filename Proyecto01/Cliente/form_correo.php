<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Contacto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('reportes.jpg');
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        header {
            width: 100%;
            padding: 0px 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        form {
            background-color: #c71585;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            margin-top: 70px; 
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: white;
        }
        textarea, input[type="text"] {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ffc0cb;
            border-radius: 5px;
            resize: none;
        }
        input[type="submit"] {
            background-color: #ffc0cb;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            display: inline-block;
        }
        input[type="submit"]:hover {
            background-color: white;
            color: #c71585;
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
    </style>
</head>
<body>
    <header>
        <?php require "menu_cliente.php"; ?>
    </header>
    <form action="enviar_correo.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>
        <label for="message">Mensaje:</label>
        <textarea id="message" name="message" rows="6" required></textarea><br><br>
        <input type="submit" value="Enviar">
    </form>

    <footer>
        <p> 2024 BRUNO'S. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
