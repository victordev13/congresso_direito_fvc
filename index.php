<?php 
    require_once 'includes/header.php';
    require_once 'functions.php';
    require_once 'classes/participante.class.php';

    $erro = "";
    $mensagem = "";
    
    if(isset($_POST['inscrever'])){
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $cpf = formatarCPF($_POST['cpf']);
            $periodo = addslashes($_POST['periodo']);
            $turno = "";

            if($periodo=0){
                $categoria = "visitante";
            }else{
                $categoria = "aluno";
            }
            if(!$turno == ""){
                $turno = addslashes($_POST['turno']);
            }
            $erro = "Erro ao realizar Inscrição!";
            $retorno = Participante::cadastrar($nome, $email, $cpf, $categoria, $periodo, $turno);
            if($retorno){

            }else{
                $erro = "Erro ao realizar Inscrição!";
            }
        }
        
    
?>
    <div class="container">
        <div class="card border-success mt-4 mx-auto mb-5 center" id="form_inscricao"    >
        <div class="card-header bg-fvc text-light">Inscrição para o Congresso de Direito da FVC</div>
        <div class="card-body">
        <?php  
            if(!$erro == ""){
                echo "<div class='alert alert-danger alerta-sm' role='alert'>";
                echo $erro;
                echo "</div>";
                }
            if(!$mensagem == ""){
                echo "<div class='alert alert-warning alerta-sm' role='alert'>";
                    
                echo "</div>";
            }
        ?>
            <form id="inscricao" class="pl-5 pr-5" method="POST">
            <div class="form-group">
                <label for="nome">Nome Completo</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>                                                                
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="cpd">CPF</label>
                <input type="text" class="form-control" id="cpf" class="cpf" name="cpf" required>
            </div>
            <div class="form-group">
                <label for="periodo">Período/Visitante</label>
                <select class="custom-select" id="periodo" required name="periodo">
                    <option selected disabled value="">Selecione...</option>
                    <option value="1">Primeiro </option>
                    <option value="2">Segundo </option>
                    <option value="3">Terceiro </option>
                    <option value="4">Quarto </option>
                    <option value="5">Quinto </option>
                    <option value="6">Sexto </option>
                    <option value="7">Sétimo </option>
                    <option value="8">Oitavo </option>
                    <option value="9">Nono </option>
                    <option value="10">Décimo </option>
                    <option value="0">Visitante </option>
                </select>                             
            </div>
            <div class="form-group" style="display:none">
                <label for="turno">Turno</label>
                <select class="custom-select" id="turno" required name="turno">
                    <option selected disabled>Selecione...</option>
                    <option value="matutino">Matutino</option>
                    <option value="noturno">Noturno</option>
                </select>
            </div>
            
            <input type="submit" class="btn btn-default btn-fvc" value="Realizar Inscrição" name="inscrever">
            </form>
        </div>
        </div>
    </div>
    
</main>
<?php 

    require_once 'includes/footer.php';
?>