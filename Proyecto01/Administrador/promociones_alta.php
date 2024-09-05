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
    <title>Alta de promociones</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
    <div style="display: flex; justify-content: space-between;">
        <h2 style="margin: 0;">Alta de promociones</h2> 
        <button style="margin: 0;"><a href="promociones_lista.php" style="background-color: pink;">Regresar al listado</a></button>
    </div><br>

    <form id="Form01" method="post" action="promociones_salva.php" enctype="multipart/form-data">
        <input type="text" id="nombre" name="nombre" placeholder="Escribe la promocion" /><br>
        <input type="file" id="archivo" name="archivo" ><br><br>
        <input type="submit" style="background-color: pink;" value="Salvar" name="submit">
        
    </form>
    <div id="mensaje" style="display:none;"></div>
    <div id="mensajeCorreoExistente" style="display:none;"></div>

</body>
</html>
