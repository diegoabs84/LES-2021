<?php

include_once(__DIR__ . '/../database.php');

//use database;

class Paciente{

    public function loginPaciente(){
        $database = new database;
        $db = $database->connect();

        $cpf = $_POST['cpf'];
        $senha = MD5($_POST['senha']);

        $sql = "SELECT * FROM Pacientes WHERE cpf ='$cpf' AND senha='$senha'";
        $stmt = $db->query($sql);

        if ($stmt->num_rows <= 0){
    		echo"<script language='javascript' type='text/javascript'>alert('CPF e/ou senha incorretos');window.location.href='/paciente/login';</script>";
            die();
	    }else{
            setcookie("cpf", $cpf, time()+10000, '/');
            header("Location:/paciente/dashboard");
        }
    }

    public function cadastrarPaciente(){
        $database = new database;
        $db = $database->connect();

        $nome = $_POST['nome'];
        $senha = MD5($_POST['senha']);
        $cpf = $_POST['cpf'];
        $data_nasc = $_POST['data'];
        $sexo = $_POST['sexo'];
        $cor = $_POST['cor'];

        $query_select = "SELECT nome FROM Pacientes WHERE nome = '$nome'";
        $select = $db->query($query_select);

        if($cpf == "" || $cpf == null){
            header("Location:/paciente/cadastro");
        }

        if ($select->num_rows >= 0){
            while ($rowPaciente = $select->fetch_assoc()){
                if($rowPaciente['cpf'] == $cpf){
                    header("Location:/paciente/cadastro");
                    die();
                }
            }
            $query = "INSERT INTO Pacientes (nome, senha, cpf, data_nasc, sexo, cor) 
            VALUES ('$nome','$senha','$cpf','$data_nasc','$sexo','$cor')";
            $cadastrarPaciente = $db->query($query);

            if($cadastrarPaciente) {
                header("Location:/paciente/login");
            }else{
                echo"<script language='javascript' type='text/javascript'>alert('Erro no cadastro');</script>";
                die();
                //header("Location:/paciente/cadastro");
            }
        }
    }

    public function atualizarPaciente(){
        $database = new database;
        $db = $database->connect();

        $nome = $_POST['nome'];
        $senha = MD5($_POST['senha']);
        $cpf = $_COOKIE['cpf'];
        $data = $_POST['data'];
        $sexo = $_POST['sexo'];
        $cor = $_POST['cor'];
        $rua = $_POST['rua'];
        $cep = $_POST['cep'];
        $bairro = $_POST['bairro'];
        $numero = $_POST['numero'];
        $complemento = $_POST['complemento'];
        $cidade = $_POST['cidade'];
        $uf = $_POST['uf'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];

        $query_select = "SELECT nome FROM Pacientes WHERE cpf = '$cpf'";
        $select = $db->query($query_select);

        $query = "UPDATE  Pacientes SET nome = '$nome', senha = '$senha', data_nasc = '$data', sexo = '$sexo', cor = '$cor', rua = '$rua', cep = '$cep', bairro = '$bairro',
        cidade = '$cidade', uf = '$uf', telefone = '$telefone', email = '$email', numero = '$numero', complemento = '$complemento' WHERE cpf = '$cpf'";
        $modificarPaciente = $db->query($query);

        if ($select->num_rows > 0) {
            while ($row = $select->fetch_assoc()) {
                if($modificarPaciente) {
                    echo"<script language='javascript' type='text/javascript'>alert('Usuário atualizado com sucesso!');
                    window.location.href='/paciente/dashboard'</script>";
                }else{
                    echo"<script language='javascript' type='text/javascript'>alert('Não foi possível atualizar esse usuário');
                    window.location.href='/paciente/dashboard'</script>";
                }
            }
        }
    }

    public function retornaDados(){
        $database = new database;
        $db = $database->connect();

        $cpf_paciente = $_COOKIE['cpf'];

        $result_paciente = "SELECT * FROM Pacientes WHERE cpf = '$cpf_paciente'";
        $result_exame = "SELECT * FROM Exames WHERE cpf_paciente = '$cpf_paciente'";
        $result_medico = "SELECT * FROM Medicos";

        $resultado_paciente = $db->query($result_paciente);
        $resultado_exame = $db->query($result_exame);
        $resultado_medico = $db->query($result_medico);

        if ($resultado_paciente->num_rows <= 0){
            echo"<script language='javascript' type='text/javascript'>alert('Não existe esse Paciente');</script>";
            die();
        }else{
            $valores = array();
            $array_exames = array();
            
            $row_paciente = $resultado_paciente->fetch_assoc();
            $valores = array("nome"=>$row_paciente['nome'], "cpf"=>$row_paciente['cpf']);

            while($row_exame = $resultado_exame->fetch_assoc()){
                $valor = array("crm_solicitador"=>$row_exame['crm_solicitador'], "status"=>$row_exame['status']);
                array_push($array_exames, $valor);
            }

            $elementCount = count($array_exames);

            while($row_medico = $resultado_medico->fetch_assoc()){
                for($i = 0; $i < $elementCount; $i++){
                    if($array_exames[$i]['crm_solicitador'] === $row_medico['crm']){
                        $valoresAdicionais = array("nome"=>$row_medico['nome'], "crm"=>$array_exames[$i]['crm_solicitador'], "status"=>$array_exames[$i]['status']);
                        array_push($valores, $valoresAdicionais);
                    }
                }
            }
            return json_encode($valores);
        }
    }
}