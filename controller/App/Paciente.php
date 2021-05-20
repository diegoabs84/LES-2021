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
        $result_exame = "SELECT * FROM Exames WHERE cpf_exame = '$cpf_paciente'";
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
                $valor = array("crm_exame"=>$row_exame['crm_exame'], "status"=>$row_exame['status']);
                array_push($array_exames, $valor);
            }

            $elementCount = count($array_exames);

            while($row_medico = $resultado_medico->fetch_assoc()){
                for($i = 0; $i < $elementCount; $i++){
                    if($array_exames[$i]['crm_exame'] === $row_medico['crm']){
                        $valoresAdicionais = array("nome"=>$row_medico['nome'], "crm"=>$array_exames[$i]['crm_exame'], "status"=>$array_exames[$i]['status']);
                        array_push($valores, $valoresAdicionais);
                    }
                }
            }
            return json_encode($valores);
        }
    }

    public function prontuario($cpf_paciente){
        $database = new database;
        $db = $database->connect();

        $result_paciente = "SELECT * FROM Pacientes WHERE cpf = '$cpf_paciente'";
        $result_exame = "SELECT * FROM Exames WHERE cpf_exame = '$cpf_paciente'";
        $result_diagnostico = "SELECT * FROM Diagnosticos WHERE cpf_diagnostico = '$cpf_paciente'";
        $result_laudo = "SELECT * FROM Laudos WHERE cpf_laudo = '$cpf_paciente'";
        $result_medico = "SELECT * FROM Medicos";

        $resultado_paciente = $db->query($result_paciente);
        $resultado_exame = $db->query($result_exame);
        $resultado_diagnostico = $db->query($result_diagnostico);
        $resultado_laudo = $db->query($result_laudo);
        $resultado_medico = $db->query($result_medico);

        if ($resultado_paciente->num_rows <= 0){
            echo"<script language='javascript' type='text/javascript'>alert('Não existe esse Paciente');</script>";
            die();
        }
        else{
            $valores = array();
            $array_exames = array();
            $array_diagnosticos = array();
            $array_laudos = array();
            $array_medicos = array();
            
            $row_paciente = $resultado_paciente->fetch_assoc();
            $valores = array("nome"=>$row_paciente['nome'], "sobrenome"=>$row_paciente['sobrenome'], "data_nasc"=>$row_paciente['data_nasc'], "cpf"=>$row_paciente['cpf'],
            "cor"=>$row_paciente['cor'], "sexo"=>$row_paciente['sexo'], "cep"=>$row_paciente['cep'], "rua"=>$row_paciente['rua'], "bairro"=>$row_paciente['bairro'],
            "numero"=>$row_paciente['numero'], "complemento"=>$row_paciente['complemento'], "cidade"=>$row_paciente['cidade'], "uf"=>$row_paciente['uf'],
            "telefone"=>$row_paciente['telefone'], "email"=>$row_paciente['email']);

            while($row_exame = $resultado_exame->fetch_assoc()){
                $valor = array("id_exame"=>$row_exame['id_exame'], "data_exame"=>$row_exame['data_exame'], "nome_exame"=>$row_exame['nome_exame'], 
                "crm_exame"=>$row_exame['crm_exame'], "status"=>$row_exame['status'], "recomendacao"=>$row_exame['recomendacao']);
                array_push($array_exames, $valor);
            }
            array_push($valores, $array_exames);

            while($row_diagnostico = $resultado_diagnostico->fetch_assoc()){
                $valor = array("id_diagnostico"=>$row_diagnostico['id_diagnostico'], "crm_diagnostico"=>$row_diagnostico['crm_diagnostico'], 
                "id_exame"=>$row_diagnostico['id_exame'], "diagnostico"=>$row_diagnostico['diagnostico'], "imagem"=>$row_diagnostico['imagem']);
                array_push($array_diagnosticos, $valor);
            }
            array_push($valores, $array_diagnosticos);

            while($row_laudo = $resultado_laudo->fetch_assoc()){
                $valor = array("id_laudo"=>$row_laudo['id_laudo'], "laudo"=>$row_laudo['laudo'], "crm_laudo"=>$row_laudo['crm_laudo']);
                array_push($array_laudos, $valor);
            }
            array_push($valores, $array_laudos);

            while($row_medico = $resultado_medico->fetch_assoc()){
                $valor = array("nome"=>$row_medico['nome'], "crm"=>$row_medico['crm'], "tipo_medico"=>$row_medico['tipo_medico'], "titulacao"=>$row_medico['titulacao'],
                "ano_residencia"=>$row_medico['ano_residencia']);
                array_push($array_medicos, $valor);
            }
            array_push($valores, $array_medicos);
        }
        
        return json_encode($valores);
    }
}