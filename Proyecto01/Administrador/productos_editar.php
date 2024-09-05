<?php
   session_start();
    require "funciones/menu.php"; 
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
        <button><a href="productos_lista.php">Regresar al listado</a></button>
    </div>

    <div class="formulario-container">
        <?php
        require "funciones/conecta.php";

        if(isset($_GET['id'])) {
            $id = $_GET['id'];
        
            $con = conecta();
            $sql = "SELECT * FROM productos WHERE id = $id AND status = 1 AND eliminado = 0";
            $res = $con->query($sql);

            if($res && $res->num_rows > 0) {
                $row = $res->fetch_assoc();
                $nombre = $row['nombre'];
                $codigo = $row['codigo'];
                $descripcion = $row['descripcion'];
                $costo = $row['costo']; 
                $stock = ($row['stock']);
                $foto = 'archivos/' . $row['archivo'];
                $nombreArchivoActual = $row['archivo'];

                echo "<h2>Editar productos</h2>";
                echo "<div class='foto-container'>";
                echo "<img class='foto' src='$foto' alt='Foto del empleado'>";
                echo "</div>";
                echo "<form action='datos_editados_prod.php' method='POST' enctype='multipart/form-data' onsubmit='return validarFormulario()'>";
                echo "<input type='hidden' name='id' value='$id'>";
                echo "<label for='nombre'>Nombre:</label>";
                echo "<input type='text' id='nombre' name='nombre' value='$nombre'> <br>";

                echo "<label for='codigo'>Codigo:</label>";
                echo "<input type='text' id='codigo' name='codigo' value='$codigo' onblur='validarCodigo()'><br>";
                echo "<div id='mensaje-codigo-existente' style='color: pink;'></div>";

                echo "<label for='descripcion'>Descripcion:</label>";
                echo "<input type='text' id='descripcion' name='descripcion' value='$descripcion' ><br>";

                echo "<label for='costo'>costo:</label>"; 
                echo "<input type='text' id='costo' name='costo' value='$costo'><br>"; 

                echo "<label for='stock'>stock:</label>"; 
                echo "<input type='text' id='stock' name='stock' value='$stock'><br>"; 

            
                echo "<label for='archivo'>Foto:</label>";
                echo "<input type='file' id='archivo' name='archivo'><br>";
                echo "<input type='hidden' name='archivo_n' value='$nombreArchivoActual'>";
                echo "<input type='submit' value='Guardar cambios'>";
                echo "</form>";
            } else {
                echo "No se encontró ningún empleado con el ID proporcionado.";
            }

            $con->close();
        } else {
            echo "No se proporcionó un ID de empleado.";
        }
        ?>
    </div>
    <div id="mensaje-error" style="color: red;"></div>
</body>
</html>
