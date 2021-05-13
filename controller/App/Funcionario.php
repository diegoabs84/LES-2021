<?php

include_once(__DIR__ . '/../database.php');

//use database;

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

        $query_select = "SELECT nome, crm FROM Medicos";
        $select = $db->query($query_select);

        if($crm == "" || $crm == null){
            header("Location:/funcionario/cadastrar_medico");
        }

        if ($select->num_rows >= 0){
            while ($rowMedico = $select->fetch_assoc()){
                if($rowMedico['crm'] == $crm){
                    header("Location:/funcionario/cadastrar_medico");
                    die();
                }
            }
            $query = "INSERT INTO Medicos (nome, senha, crm, tipo_medico, titulacao, ano_residencia) 
            VALUES ('$nome','$senha','$crm','$tipo_medico','$titulacao','$ano_residente')";
            $cadastrarMedico = $db->query($query);

            if($cadastrarMedico) {
                header("Location:/login_medicos");
            }else{
                header("Location:/funcionario/cadastro_medico");
            }
        }
    }

}