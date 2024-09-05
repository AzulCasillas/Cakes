<?php
session_start();
    require "funciones/menu.php"; 
    if(!isset($_SESSION['nombreUser'])) {
        header("Location: index.php");
        exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <style>
        .tabla {
            display: flex;
            flex-direction: column;
            border: 2px solid #c82a54;
            width: 20%;
        }

        .fila {
            flex-direction: row;
            border-bottom: 2px solid #c82a54;
            font-weight: bold;
            background-color: pink;
        }   

        .columna {
            flex: 1;
            padding: 10px;
            background-color: white;
        }

        .boton-container {
            position: absolute; 
            top: 20px; 
            right: 20px;
            padding: 15px;
            border: none;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
        }

        button {
            background-color: pink;
        }

        .foto-container {
            float: left;
            margin-right: 20px; /* Espacio entre la imagen y la tabla */
        }

        .foto {
            width: 300px; 
            height: 300px; 
        }

    </style>
</head>
<body>
    <?php
    require "funciones/conecta.php";
    echo '<div class="boton-container">';
        echo '<button><a href="productos_lista.php">Regresar al listado</a></button><br><br>';
    echo '</div>';
        
    if($_GET) {
        $id = $_GET['id'];
    } else {
        echo "NO";
    }

    if($id !== null) {
        detalles($id); 
    } else {
        echo "No se ha proporcionado un ID de empleado.";
    }

    function detalles($id){
        $con = conecta();
        
        $sql = "SELECT * FROM productos WHERE id = $id AND status = 1 AND eliminado = 0";
        $res = $con->query($sql);

        if($res) {
            $num = $res->num_rows;

            if($num > 0) {
                echo "<h2>Detalles del productos</h2>";
                while($row = $res->fetch_assoc()) {
                    $nombre = $row["nombre"];
                    $codigo = $row["codigo"];
                    $descripcion = $row["descripcion"];
                    $costo = $row["costo"];
                    $stock=$row["stock"];

                    echo "<div class='foto-container'>";
                    echo "<img class='foto' src='archivos/" . $row['archivo'] . "' alt='Fotografia'>";
                    echo "</div>";

                    echo "<div class='tabla'>";
            
                    echo "<div class='fila'>Id:";
                    echo "<div class='columna'>$id</div>";
                    echo "</div>";

                    echo "<div class='fila'>Nombre:";
                    echo "<div class='columna'> $nombre </div>";
                    echo "</div>";
                    
                    echo "<div class='fila'>Codigo:";
                    echo "<div class='columna'> $codigo</div>";
                    echo "</div>";

                    echo "<div class='fila'>Descripcion:";
                    echo "<div class='columna'> $descripcion</div>";
                    echo "</div>";

                    echo "<div class='fila'>Costo:";
                    echo "<div class='columna'> $costo</div>";
                    echo "</div>";

                    echo "<div class='fila'>Stock:";
                    echo "<div class='columna'> $stock</div>";
                    echo "</div>";

                    echo "</div>";
                    

                }
            } else {
                echo "No se encontró ningún empleado con el ID.";
            }
        } else {
            echo "Error al ejecutar la consulta.";
        }

        $con->close();
    }
    ?>
</body>
</html>
