<?php
require "funciones/conecta.php";
$id = $_POST['id'];

$con = conecta();

$sql = "UPDATE empleados SET eliminado = 1 WHERE id = $id";
$res = $con->query($sql);

echo $res ? "success" : "error";
?>
