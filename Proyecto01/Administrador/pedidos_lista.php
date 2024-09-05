<?php
require "funciones/conecta.php";
session_start();
if(!isset($_SESSION['nombreUser'])) {
    header("Location: index.php");
    exit;
}
$nombre=$_SESSION['nombreUser'];

require "funciones/menu.php";
$con = conecta();
$sql = "SELECT * FROM pedidos WHERE status = 1"; //1 es pedido cerrado
$res = $con->query($sql);
$num = $res->num_rows;
echo "<h2>Listado de pedidos cerrados ($num)</h2>";
echo "<div class='tabla'>";

echo "<div class='fila'>";
echo "<div class='columna'>ID</div>";
echo "<div class='columna'>Ver detalle</div>";
echo "</div>"; 

while ($row = $res->fetch_array()) {
    $id = $row["id"];

    echo "<div class='fila'>";
    echo "<div class='columna'>$id</div>";
    echo "<div class='columna'><a href=\"pedidos_detalles.php?id=$id\">Ver detalle</a></div>";

    echo "</div>"; 
}

echo "</div>";
?>

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