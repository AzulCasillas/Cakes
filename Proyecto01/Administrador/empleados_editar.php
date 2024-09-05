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
        <button><a href="empleados_lista.php">Regresar al listado</a></button>
    </div>

    <div class="formulario-container">
        <?php
        require "funciones/conecta.php";

        if(isset($_GET['id'])) {
            $id = $_GET['id'];
        
            $con = conecta();
            $sql = "SELECT * FROM empleados WHERE id = $id AND status = 1 AND eliminado = 0";
            $res = $con->query($sql);

            if($res && $res->num_rows > 0) {
                $row = $res->fetch_assoc();
                $nombre = $row['nombre'];
                $apellidos = $row['apellidos'];
                $correo = $row['correo'];
                $pass = $row['pass']; 
                $rol = ($row['rol'] == 1) ? "Gerente" : "Empleado";
                $status = ($row['status'] == 1) ? "Activo" : "Inactivo";
                $foto = 'archivos/' . $row['archivo'];
                $nombreArchivoActual = $row['archivo'];

                echo "<h2>Editar empleado</h2>";
                echo "<div class='foto-container'>";
                echo "<img class='foto' src='$foto' alt='Foto del empleado'>";
                echo "</div>";
                echo "<form action='datos_editados.php' method='POST' enctype='multipart/form-data' onsubmit='return validarFormulario()'>";
                echo "<input type='hidden' name='id' value='$id'>";
                echo "<label for='nombre'>Nombre:</label>";
                echo "<input type='text' id='nombre' name='nombre' value='$nombre'> <br>";
                echo "<label for='apellidos'>Apellidos:</label>";
                echo "<input type='text' id='apellidos' name='apellidos' value='$apellidos'><br>";
                echo "<label for='correo'>Correo:</label>";
                echo "<input type='email' id='correo' name='correo' value='$correo' onblur='validarCorreo()'><br>";
                echo "<div id='mensaje-correo-existente' style='color: pink;'></div>";
                echo "<label for='pass'>Contraseña:</label>"; 
                echo "<input type='password' id='pass' name='pass' value='$pass'><br>"; 
                echo "<label for='rol'>Rol:</label>";
                echo "<select id='rol' name='rol'>";
                echo "<option value='1' ".(($rol == 'Gerente') ? 'selected' : '').">Gerente</option>";
                echo "<option value='2' ".(($rol == 'Empleado') ? 'selected' : '').">Empleado</option>";
                echo "</select><br>";
                echo "<label for='status'>Status:</label>";
                echo "<select id='status' name='status'>";
                echo "<option value='1' ".(($status == 'Activo') ? 'selected' : '').">Activo</option>";
                echo "<option value='0' ".(($status == 'Inactivo') ? 'selected' : '').">Inactivo</option>";
                echo "</select><br>";
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
