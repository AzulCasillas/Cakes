<html>

<head>
    <title>Ajax / Jquery</title>
    <style>
        #mensaje{
            color:#F00;
            font-size:16px;
            line-height:20px;
            text-align:center;
            width:150px;
            height:20px;
            padding:5px;
            background:#CCC;
            border-radius:4px;
            margin-top:10px;
            display:none;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>

ValidarNumero();
    function ValidarNumero(){
        var numero = $('#numero').val();

        if(numero>0 && numero){
            /*$('#mensaje').show();
            $('#mensaje').html('Campo lleno');
            setTimeout("$('#mensaje').html(''); $('#mensaje').hide();",5000);*/
            $.ajax({
                url : 'respuesta.php',
                type : 'post',
                dataType : 'text',
                data : 'numero='+numero,
                success : function(res){
                    console.log(res);
                    $('#mensaje').show();
                    if(res==1){
                        $('#mensaje').html('SI APROBASTE EL CURSO');
                    }else{
                        $('#mensaje').html('NO APROBASTE EL CURSO'); 
                    }
                    setTimeout("$('#mensaje').html(''); $('#mensaje').hide();", 5000);
                },error : function(){
                    alert('Error archivo no encontrado...');
                }
            });
        }else{
            $('#mensaje').show();
            $('#mensaje').html('Completa el campo');
            setTimeout("$('#mensaje').html(''); $('#mensaje').hide();", 5000);
        }
    }
    </script>
</head>

<body>
    <input type="text" name="numero" id="numero" placeholder="Escribe la calificacion" /><br>
    <a href="javascript:void(0);" onClick="ValidarNumero();">
        Validar
    </a><br>
    <div id="mensaje"></div>
</body>
</html>