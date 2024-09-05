<?php
require "funciones/conecta.php";
$con = conecta();

$nombre = $_POST['nombre'];
$codigo = $_POST['codigo'];
$descripcion = $_POST['descripcion'];
$costo = $_POST['costo'];
$stock = $_POST['stock'];

if(isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
    $archivo_nombre = $_FILES['archivo']['name'];
    $archivo_temp = $_FILES['archivo']['tmp_name'];

    $nombre_encriptado = md5(uniqid($nombre, true));
    $ruta_archivo = "archivos/" . $nombre_encriptado;

    if(move_uploaded_file($archivo_temp, $ruta_archivo)) {
        $sql = "INSERT INTO productos (nombre, codigo, descripcion, costo, stock, archivo_n, archivo) 
                VALUES ('$nombre', '$codigo', '$descripcion', '$costo', '$stock', '$archivo_nombre', '$nombre_encriptado')";
        $res = $con->query($sql);

        if($res) {
            header("Location: productos_lista.php");
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
