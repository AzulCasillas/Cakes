<?php
require "funciones/conecta.php";

$con = conecta();

if (!$con) {
    die("Error en la conexión a la base de datos");
}

$correo = $_POST['correo'];

$sql = "SELECT * FROM empleados WHERE correo = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // El correo electrónico ya existe en la base de datos
    echo 'si';
} else {
    echo 'no';
}

$stmt->close();
$con->close();
?>