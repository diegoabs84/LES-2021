<?php

include_once(__DIR__ . '/../database.php');

class Funcionario{

    public function loginFuncionario(){
        $database = new database;
        $db = $database->connect();

        $login = $_POST['login'];
        $entrar = $_POST['entrar'];
        $senha = md5($_POST['senha']);

        $query = "SELECT * FROM Funcionarios WHERE login ='$login' AND senha = '$senha'";
        $verifica = $db->query($query);
        if ($verifica->num_rows <= 0){
            echo"<script language='javascript' type='text/javascript'>alert('LOGIN e/ou senha incorretos');window.location.href='/funcionario/login';</script>";
            die();
        }else{
            setcookie("login",$login);
            header("Location:/funcionario/dashboard"); 
        }
    }

    public function cadastrarMedico(){
        $database = new database;
        $db = $database->connect();

        $nome = $_POST['nome'];
        $senha = MD5($_POST['senha']);
        $crm = $_POST['crm'];
        $tipo_medico = $_POST['tipo_medico'];
        $titulacao = $_POST['titulacao'];
        $ano_residente = $_POST['ano_residente'];

        $result_medico = "SELECT * FROM Medicos";
        $resultado_medico = $db->query($result_medico);

         // filtro de inserção
        if($crm == "" || $crm == null){
            echo"<script language='javascript' type='text/javascript'>alert('Insira o CRM');
            window.location.href='/funcionario/cadastro_medico'</script>";
            die();
        }else if($senha == "d41d8cd98f00b204e9800998ecf8427e" || $senha == null){
            echo"<script language='javascript' type='text/javascript'>alert('Insira a Senha');
            window.location.href='/funcionario/cadastro_medico'</script>";
            die();
        }else if($nome == "" || $nome == null){
            echo"<script language='javascript' type='text/javascript'>alert('Insira o Nome');
            window.location.href='/funcionario/cadastro_medico'</script>";
            die();
        }

        // filtro de validação
        if(!filter_var($crm, FILTER_VALIDATE_INT)){
            echo"<script language='javascript' type='text/javascript'>alert('CRM inválido');
            window.location.href='/funcionario/cadastro_medico'</script>";
            die();
        }else if(strlen($crm) != 5){
            echo"<script language='javascript' type='text/javascript'>alert('CRM inválido');
            window.location.href='/funcionario/cadastro_medico'</script>";
            die();
        }

        if ($resultado_medico->num_rows >= 0){
            while ($rowMedico = $resultado_medico->fetch_assoc()){
                // filtro de existência
                if($rowMedico['crm'] == $crm){
                    echo"<script language='javascript' type='text/javascript'>alert('CRM já cadastrado');
                    window.location.href='/funcionario/cadastro_medico'</script>";
                    die();
                }
            }
            $cadastro_medico = "INSERT INTO Medicos (nome, senha, crm, tipo_medico, titulacao, ano_residencia) 
            VALUES ('$nome','$senha','$crm','$tipo_medico','$titulacao','$ano_residente')";
            $medico_cadastrado = $db->query($cadastro_medico);

            if($medico_cadastrado) {
                echo"<script language='javascript' type='text/javascript'>alert('Cadastro com Sucesso');
                window.location.href='/funcionario/dashboard'</script>";
                die();
            }else{
                echo"<script language='javascript' type='text/javascript'>alert('Erro no Cadastro');
                window.location.href='/funcionario/cadastro_medico'</script>";
                die();
            }
        }
    }

}