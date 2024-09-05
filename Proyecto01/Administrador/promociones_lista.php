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
$sql = "SELECT * FROM promociones WHERE status = 1 AND eliminado = 0";
$res = $con->query($sql);
$num = $res->num_rows;
echo "<h2>Listado de empleados ($num)</h2>";
echo '<button style="background-color: pink;"><a href="promociones_alta.php" border>DAR DE ALTA PROMOCIONES</a></button><br><br>';
echo "<div class='tabla'>";

echo "<div class='fila'>";
echo "<div class='columna'>ID</div>";
echo "<div class='columna'>Nombre</div>";
echo "<div class='columna'>Ver detalle</div>";
echo "<div class='columna'>Editar</div>";
echo "<div class='columna'>Eliminar</div>";
echo "</div>"; 

while ($row = $res->fetch_array()) {
    $id = $row["id"];
    $nombre = $row["nombre"];

    echo "<div class='fila'>";
    echo "<div class='columna'>$id</div>";
    echo "<div class='columna'>$nombre</div>";
    echo "<div class='columna'><a href=\"promociones_detalles.php?id=$id\">Ver detalle</a></div>";
    echo "<div class='columna'><a href=\"promociones_editar.php?id=$id\">Editar</a></div>";
    echo "<div class='columna'><a href='#' onclick=\"eliminarPromociones($id)\">Eliminar</a></div>";
    echo "</div>"; 
}

echo "</div>";
?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="promociones_eliminar_ajax.php"></script>

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