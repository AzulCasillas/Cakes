<?php
require "funciones/conecta.php";
$con = conecta();

$nombre = $con->real_escape_string($_POST['nombre']);

if(isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
    $archivo_nombre = $_FILES['archivo']['name'];
    $archivo_temp = $_FILES['archivo']['tmp_name'];

    $nombre_encriptado = md5(uniqid($nombre, true));
    $ruta_archivo = "fotosPromociones/" . $nombre_encriptado;

    if(move_uploaded_file($archivo_temp, $ruta_archivo)) {
        $sql = "INSERT INTO promociones (nombre, archivo) 
                VALUES ('$nombre', '$nombre_encriptado')";
        $res = $con->query($sql);

        if($res) {
            header("Location: bienvenido.php");
        } else {
            echo "Error al insertar en la base de datos.";
        }
    } else {
        echo "Error al subir el archivo.";
    }
} else {
    echo "No se ha subido ningún archivo.";
}

$con->close();
?>
