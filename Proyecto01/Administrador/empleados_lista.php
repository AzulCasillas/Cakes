<?php
//empleados_lista.php
require "funciones/conecta.php";
session_start();
if(!isset($_SESSION['nombreUser'])) {
    header("Location: index.php");
    exit;
}
$nombre=$_SESSION['nombreUser'];

require "funciones/menu.php";
$con = conecta();
$sql = "SELECT * FROM empleados WHERE status = 1 AND eliminado = 0";
$res = $con->query($sql);
$num = $res->num_rows;
echo "<h2>Listado de empleados ($num)</h2>";
echo '<button style="background-color: pink;"><a href="empleados_alta.php" border>DAR DE ALTA</a></button><br><br>';
echo "<div class='tabla'>";

echo "<div class='fila'>";
echo "<div class='columna'>ID</div>";
echo "<div class='columna'>Nombre completo</div>";
echo "<div class='columna'>Correo</div>";
echo "<div class='columna'>Rol</div>";
echo "<div class='columna'>Ver detalle</div>";
echo "<div class='columna'>Editar</div>";
echo "<div class='columna'>Eliminar</div>";
echo "</div>"; 

while ($row = $res->fetch_array()) {
    $id = $row["id"];
    $nombre = $row["nombre"] . ' ' . $row["apellidos"];
    $correo = $row["correo"];
    $rol = $row["rol"];

    //El 0 lo validaremos en el momento de registar para no sea posible usarlo y solo podamos escoger la opcion 1 o 2
    if ($rol == 1) {
        $rolEtiqueta = "Gerente";
    } else {
        $rolEtiqueta= "Empleado";
    }

    echo "<div class='fila'>";
    echo "<div class='columna'>$id</div>";
    echo "<div class='columna'>$nombre</div>";
    echo "<div class='columna'>$correo</div>";
    echo "<div class='columna'>$rolEtiqueta</div>";
    echo "<div class='columna'><a href=\"empleados_detalles.php?id=$id\">Ver detalle</a></div>";
    echo "<div class='columna'><a href=\"empleados_editar.php?id=$id\">Editar</a></div>";
    echo "<div class='columna'><a href='#' onclick=\"eliminar($id)\">Eliminar</a></div>";

    echo "</div>"; 
}

echo "</div>";
?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="empleados_eliminar_ajax.php"></script>

<!DOCTYPE html>
<html>
<style>
    .tabla {
    display: flex;
    flex-direction: column;
    border: 1px solid #ccc;
    width: 80%;
    }

    .fila {
    display: flex;
    flex-direction: row;
    border-bottom: 1px solid #ccc;
    }   

    .columna {
    flex: 1;
    padding: 10px;
    border-right: 1px solid #ccc;
    text-align: center;
    }

    
    .fila:first-child .columna {
    font-weight: bold;
    background-color: pink;
    }
</style>

<body>
    
</body>
</html>