
<?php include "function/gerarcodigobarra.php"?>
<!DOCTYPE html>
	<html lang='pt-br'>
		<head>
 		<meta charset='UTF-8'>
        <link rel='stylesheet' type='text/css' href='css/cracha.css'>
        <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
        <title>Cartao de Entrada - Faculdade FVC </title>

       		</head>
    
        <body>

        <div id="container">
        
        <div class"logo">
            <center>
                 <img src="imagens/logo.png" width="80px">
            </center>
        </div>

        <div class="dados">
        
    
            <center>
                <p>  Congresso de Direito   <br> CAD (Centro Academico de Direito) </p>
                <p>-------------------------------------</p>
            </center>
            
        
        
        <p> <b> Aluno: </b> <?php echo "variavel com o nome" ?> </p> <!-- Colocar as variavel com o nome -->
        <p> <b> CPF: </b> <?php echo "variavel com o CPF" ?> </p> <!-- Colocar a variavel com o CPF -->
        <br>
        <p class="fontmenor" > A entrada no evento e contabilização de horas só sera possível com a apresentação desse cracha que poderar ser feita, tanto online no proprio celular com internet, quanto impressa.

        </div>

        


        <div class="codigo">
            <br><br> 
           
            <center>
                <?php geraCodigoBarra("17805418721") ?> <br> <!-- Aqui tem que colocar a variavel que gera o codigo de barra -->
                <?php echo "00000000000" ?> <!-- Aqui repete a variavel que traz o cpf do candidato -->
            </center>
            <center>
            <button id="btn" > Versao para Impressao </button>
            <button id="voltar" onClick="VoltarPagina()"> Voltar </button>
            </center>
        </div>
    
        </div>
        <script>
        document.getElementById('btn').onclick = function() {
            var conteudo = document.getElementById('container').innerHTML,
                tela_impressao = window.open('about:blank');

            tela_impressao.document.write(conteudo);
            tela_impressao.window.print();
            tela_impressao.window.close();
        };
        </script>

        <script type="text/javascript">
            function VoltarPagina()
                    {
                location.href=" index.html";
                    }
        </script>   

        <body>
        </html>       