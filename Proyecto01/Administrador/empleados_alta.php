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
    <title>Alta de empleados</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var correoExistente = false; 
        $(document).ready(function() {
            $('#correo').on('blur', function() {
                var correo = $(this).val();
                $.ajax({
                    url: 'validar_correo_ajax.php', 
                    method: 'POST',
                    data: {correo: correo},
                    success: function(response) {
                        if (response === 'si') {
                            correoExistente = true;
                            $('#mensajeCorreoExistente').html('El correo ' + correo + ' ya existe, cambialo para poder darte de alta.').show();
                            setTimeout(function() {
                                $('#mensajeCorreoExistente').hide(); 
                            }, 5000);
                        } else {
                            correoExistente = false; 
                            $('#mensajeCorreoExistente').hide();
                        }
                    }
                });
            });

            $('#Form01').on('submit', function(event) {
                var camposVacios = validar_Cllenos();
                if (camposVacios || correoExistente) {
                    event.preventDefault(); 
                }
            });
        });

        function validar_Cllenos() {
            var nombre = $('#nombre').val();
            var apellidos = $('#apellidos').val();
            var correo = $('#correo').val();
            var pass = $('#pass').val();
            var rol = $('#rol').val();

            if (nombre === '' || apellidos === '' || correo === '' || pass === '' || rol === '0') {
                $('#mensaje').show();
                $('#mensaje').html('Faltan campos por llenar');
                setTimeout(function() {
                    $('#mensaje').html('');
                    $('#mensaje').hide();
                }, 5000);
                return true;
            } else {
                return false;
            }
        }
    </script>

</head>
<body>
    <div style="display: flex; justify-content: space-between;">
        <h2 style="margin: 0;">Alta de empleados</h2> 
        <button style="margin: 0;"><a href="empleados_lista.php" style="background-color: pink;">Regresar al listado</a></button>
    </div><br>

    <form id="Form01" method="post" action="empleados_salva.php" enctype="multipart/form-data">
        <input type="text" id="nombre" name="nombre" placeholder="Escribe tu nombre" /><br>
        <input type="text" id="apellidos" name="apellidos" placeholder="Escribe tus apellidos"/><br>
        <input type="text" id="correo" name="correo" placeholder="Escribe tu correo" /><br>
        <input type="text" id="pass" name="pass" placeholder="Escribe tu password" /><br>

        <select id="rol" name="rol">
            <option value="0">Selecciona</option>
            <option value="1">Gerente</option>
            <option value="2">Ejecutivo</option>
        </select>
        <br>
        <input type="file" id="archivo" name="archivo" ><br><br>
        <input type="submit" style="background-color: pink;" value="Salvar" name="submit">
        
    </form>
    <div id="mensaje" style="display:none;"></div>
    <div id="mensajeCorreoExistente" style="display:none;"></div>

</body>
</html>
