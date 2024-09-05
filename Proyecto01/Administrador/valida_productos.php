<?php
require "funciones/conecta.php";

$con = conecta();

if (!$con) {
    die("Error en la conexión a la base de datos");
}

$codigo = $_POST['codigo']; // Aquí se corrigió de $correo a $codigo

$sql = "SELECT * FROM productos WHERE codigo = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $codigo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo 'si';
} else {
    echo 'no';
}

$stmt->close();
$con->close();
?>