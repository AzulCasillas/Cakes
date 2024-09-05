<?php
require "funciones/conecta.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id'], $_POST['nombre'], $_POST['codigo'], $_POST['descripcion'], $_POST['costo'], $_POST['stock'])) {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $codigo = $_POST['codigo'];
        $descripcion= $_POST['descripcion'];
        $costo = $_POST['costo'];
        $stock = $_POST['stock']; 

        $con = conecta();
        $sql = "UPDATE productos SET nombre='$nombre', codigo='$codigo', descripcion='$descripcion', costo='$costo', stock='$stock' WHERE id=$id";
        if ($con->query($sql) === TRUE) {
            if (isset($_FILES['archivo']) && $_FILES['archivo']['size'] > 0) {
                $archivo = $_FILES['archivo']['name'];
                $archivo_tmp = $_FILES['archivo']['tmp_name'];
                $archivo_n = md5(uniqid(rand(), true)) . "-" . basename($archivo); 
                move_uploaded_file($archivo_tmp, "archivos/" . $archivo_n);
                
                $sql_update_foto = "UPDATE productos SET archivo='$archivo_n' WHERE id=$id";
                $con->query($sql_update_foto);
            }
            
            header("Location: productos_lista.php");
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
