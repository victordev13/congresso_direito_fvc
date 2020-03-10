<?php

$nome = "Victor de Carvalho Silva";
$categoria = "Estudante/1°Período";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>
    <link type='text/css' href='src/pdf.css' rel='stylesheet'/>
    <style>
    @page{}
        body{

            font-family: Arial, Helvetica, sans-serif;
        }
        div.cracha{
            background: url('model.png');
            background-size: cover;
            width: 316px;
            height: 443px;
        }
        div.campos{
            margin-top: 100px;
        }
        
        div.codigoBarra{
        
        }


    </style>
</head>
<body>
    <div class='cracha'>
        <div class="campos">
            <div class='label'><?php echo $nome ?></div>
            <div class='label'><?php echo $categoria ?></div>
            <div class='codigoDeBarra'>
        </div>
        </div>
    </div>
</body>
</html>

