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
    <title>Alta de productos</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var codigoExistente = false; 
        $(document).ready(function() {
            $('#codigo').on('blur', function() {
                var codigo = $(this).val();
                $.ajax({
                    url: 'valida_productos.php', 
                    method: 'POST',
                    data: {codigo: codigo},
                    success: function(response) {
                        if (response === 'si') {
                            codigoExistente = true;
                            $('#mensajeCodigoExistente').html('El codigo ' + codigo + ' ya existe, cambialo para poder dar de alta el producto.').show();
                            setTimeout(function() {
                                $('#mensajeCodigoExistente').hide(); 
                            }, 5000);
                        } else {
                            codigoExistente = false; 
                            $('#mensajeCodigoExistente').hide();
                        }
                    }
                });
            });

            $('#Form01').on('submit', function(event) {
                var camposVacios = validar_Cllenos();
                if (camposVacios || codigoExistente) {
                    event.preventDefault(); 
                }
            });
        });

        function validar_Cllenos() {
            var nombre = $('#nombre').val();
            var codigo = $('#codigo').val();
            var descripcion = $('#descripcion').val();
            var costo = $('#costo').val();
            var stock = $('#stock').val();

            if (nombre === '' || codigo === '' || descripcion === '' || costo === '' || stock === '') {
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
        <h2 style="margin: 0;">Alta de productos</h2> 
        <button style="margin: 0;"><a href="productos_lista.php" style="background-color: pink;">Regresar al listado</a></button>
    </div><br>

    <form id="Form01" method="post" action="productos_salva.php" enctype="multipart/form-data">
        <input type="text" id="nombre" name="nombre" placeholder="Escribe el nombre" /><br>
        <input type="text" id="codigo" name="codigo" placeholder="Escribe el codigo"/><br>
        <input type="text" id="descripcion" name="descripcion" placeholder="Escribe la descripcion" /><br>
        <input type="text" id="costo" name="costo" placeholder="Escribe el costo" /><br>
        <input type="text" id="stock" name="stock" placeholder="Escribe el stock" /><br>

        <br>
        <input type="file" id="archivo" name="archivo" ><br><br>
        <input type="submit" style="background-color: pink;" value="Salvar" name="submit">
        
    </form>
    <div id="mensaje" style="display:none;"></div>
    <div id="mensajeCodigoExistente" style="display:none;"></div>

</body>
</html>
