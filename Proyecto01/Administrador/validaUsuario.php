<?php
session_start();
require_once("funciones/conecta.php");

function validarUsuario($correo, $pass) {
    $con = conecta();

    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);
    }

    $sql = "SELECT * FROM empleados WHERE correo = ? AND pass = ? AND status = 1 AND eliminado = 0";
    $stmt = $con->prepare($sql);

    $stmt->bind_param("ss", $correo,  $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "success";
        $row = $result->fetch_array();
        $id = $row["id"];
        $nombre = $row["nombre"] . ' ' . $row["apellidos"];
        $correo = $row["correo"];

        $_SESSION['idUser'] = $id;
        $_SESSION['nombreUser'] = $nombre;
        $_SESSION['correoUser'] = $correo;
    } else {
        echo "Nombre de usuario o contraseña incorrectos";
    }

    $stmt->close();
    $con->close();
}

$correo = $_POST['correo'];
$pass = md5($_POST['pass']);

validarUsuario($correo, $pass);
?>
