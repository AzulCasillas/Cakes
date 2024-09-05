<?php
   
    require "funciones/menu.php"; 
    session_start();
    if(!isset($_SESSION['nombreUser'])) {
        header("Location: index.php");
        exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <style>
        .boton-container {
            position: absolute; 
            top: 20px; 
            right: 20px;
            padding: 15px;
            border: none;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
        }

        button {
            background-color: pink;
        }

        .foto-container {
            margin-bottom: 20px;
        }

        .foto {
            max-width: 200px;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="boton-container">
        <button><a href="promociones_lista.php">Regresar al listado de promociones</a></button>
    </div>

    <div class="formulario-container">
        <?php
        require "funciones/conecta.php";

        if(isset($_GET['id'])) {
            $id = $_GET['id'];
        
            $con = conecta();
            $sql = "SELECT * FROM promociones WHERE id = $id AND status = 1 AND eliminado = 0";
            $res = $con->query($sql);

            if($res && $res->num_rows > 0) {
                $row = $res->fetch_assoc();
                $nombre = $row['nombre'];
                $foto = 'fotosPromociones/' . $row['archivo'];
                $nombreArchivoActual = $row['archivo'];

                echo "<h2>Editar promociones</h2>";
                echo "<div class='foto-container'>";
                echo "<img class='foto' src='$foto' alt='Foto de la promocion'>";
                echo "</div>";
                echo "<form action='promociones_editados.php' method='POST' enctype='multipart/form-data' onsubmit='return validarFormulario()'>";
                echo "<input type='hidden' name='id' value='$id'>";
                echo "<label for='nombre'>Nombre:</label>";
                echo "<input type='text' id='nombre' name='nombre' value='$nombre'> <br>";
                echo "<label for='archivo'>Foto:</label>";
                echo "<input type='file' id='archivo' name='archivo'><br>";
                echo "<input type='hidden' name='archivo_n' value='$nombreArchivoActual'>";
                echo "<input type='submit' value='Guardar cambios'>";
                echo "</form>";
            } else {
                echo "No se encontró ningúna promocion con el ID proporcionado.";
            }

            $con->close();
        } else {
            echo "No se proporcionó un ID de una promocion.";
        }
        ?>
    </div>
</body>
</html>
