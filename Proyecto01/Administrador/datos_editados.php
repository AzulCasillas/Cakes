<?php
require "funciones/conecta.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id'], $_POST['nombre'], $_POST['apellidos'], $_POST['correo'], $_POST['rol'], $_POST['status'], $_POST['pass'])) {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $correo = $_POST['correo'];
        $rol = $_POST['rol'];
        $status = $_POST['status'];
        $pass = $_POST['pass'];

        $passEnc = md5($pass);  

        $con = conecta();
        $sql = "UPDATE empleados SET nombre='$nombre', apellidos='$apellidos', correo='$correo', rol='$rol', status='$status', pass='$passEnc' WHERE id=$id";
        if ($con->query($sql) === TRUE) {
            if (isset($_FILES['archivo']) && $_FILES['archivo']['size'] > 0) {
                $archivo = $_FILES['archivo']['name'];
                $archivo_tmp = $_FILES['archivo']['tmp_name'];
                $archivo_n = md5(uniqid(rand(), true)) . "-" . basename($archivo); 
                move_uploaded_file($archivo_tmp, "archivos/" . $archivo_n);
                
                $sql_update_foto = "UPDATE empleados SET archivo='$archivo_n' WHERE id=$id";
                $con->query($sql_update_foto);
            }
            
            header("Location: empleados_lista.php");
        } else {
            echo "Error al guardar los cambios: " . $con->error;
        }

        $con->close();
    } else {
        echo "No se proporcionaron todos los datos necesarios.";
    }
} else {
    echo "Acceso denegado.";
}
?>
