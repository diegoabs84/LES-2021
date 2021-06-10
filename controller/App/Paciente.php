<?php

include_once(__DIR__ . '/../database.php');

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

        $result_paciente = "SELECT * FROM Pacientes";
        $resultado_paciente = $db->query($result_paciente);

        // filtro de inserção
        if($cpf == "" || $cpf == null){
            echo"<script language='javascript' type='text/javascript'>alert('Insira o CPF');
            window.location.href='/paciente/cadastro'</script>";
            die();
        }else if($senha == "d41d8cd98f00b204e9800998ecf8427e" || $senha == null){
            echo"<script language='javascript' type='text/javascript'>alert('Insira a Senha');
            window.location.href='/paciente/cadastro'</script>";
            die();
        }else if($nome == "" || $nome == null){
            echo"<script language='javascript' type='text/javascript'>alert('Insira o Nome');
            window.location.href='/paciente/cadastro'</script>";
            die();
        }else if($cor == "" || $cor == null){
            echo"<script language='javascript' type='text/javascript'>alert('Insira a Cor');
            window.location.href='/paciente/cadastro'</script>";
            die();
        }else if($sexo == "" || $sexo == null){
            echo"<script language='javascript' type='text/javascript'>alert('Insira o Sexo');
            window.location.href='/paciente/cadastro'</script>";
            die();
        }

        // filtro de validação
        if(!filter_var($cpf, FILTER_VALIDATE_INT)){
            echo"<script language='javascript' type='text/javascript'>alert('CPF inválido');
            window.location.href='/paciente/cadastro'</script>";
            die();
        }else if(strlen($cpf) != 11){
            echo"<script language='javascript' type='text/javascript'>alert('CPF inválido');
            window.location.href='/paciente/cadastro'</script>";
            die();
        }

        
        if ($resultado_paciente->num_rows >= 0){
            while ($rowPaciente = $resultado_paciente->fetch_assoc()){
                // filtro de existência
                if($rowPaciente['cpf'] == $cpf){
                    echo"<script language='javascript' type='text/javascript'>alert('CPF já cadastrado');
                    window.location.href='/paciente/cadastro'</script>";
                    die();
                }
            }

            $cadastro_paciente = "INSERT INTO Pacientes (nome, senha, cpf, data_nasc, sexo, cor) 
            VALUES ('$nome','$senha','$cpf','$data_nasc','$sexo','$cor')";
            $paciente_cadastrado = $db->query($cadastro_paciente);

            if($paciente_cadastrado) {
                header("Location:/paciente/login");
            }else{
                echo"<script language='javascript' type='text/javascript'>alert('Erro no cadastro');
                window.location.href='/paciente/cadastro'</script>";
                die();
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

        $all_dados = array($rua, $cep, $bairro, $numero, $complemento, $telefone, $email); //está sem UF e Cidade por falta de dados

        $result_paciente = "SELECT nome FROM Pacientes WHERE cpf = '$cpf'";
        $resultado_paciente = $db->query($result_paciente);

        while($row_paciente = $resultado_paciente->fetch_assoc()){
            if($senha == "d41d8cd98f00b204e9800998ecf8427e" || $senha == null){
                if($row_paciente['senha'] == "d41d8cd98f00b204e9800998ecf8427e"){
                    echo"<script language='javascript' type='text/javascript'>alert('Insira a Senha');
                    window.location.href='/paciente/dashboard'</script>";
                    die();
                }else{
                    $senha = $row_paciente['senha'];
                }
            }else if($nome == "" || $nome == null){
                if($row_paciente['nome'] == null){
                    echo"<script language='javascript' type='text/javascript'>alert('Insira o Nome');
                    window.location.href='/paciente/dashboard'</script>";
                    die();
                }else{
                    $nome = $row_paciente['nome'];
                }
            }else if($cor == "" || $cor == null){
                if($row_paciente['cor'] == null){
                    echo"<script language='javascript' type='text/javascript'>alert('Insira a Cor');
                    window.location.href='/paciente/dashboard'</script>";
                    die();
                }else{
                    $cor = $row_paciente['cor'];
                }
            }else if($sexo == "" || $sexo == null){
                if($row_paciente['sexo'] == null){
                    echo"<script language='javascript' type='text/javascript'>alert('Insira o Sexo');
                    window.location.href='/paciente/dashboard'</script>";
                    die();
                }else{
                    $sexo = $row_paciente['sexo'];
                }
            }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                echo"<script language='javascript' type='text/javascript'>alert('Insira um Email válido');
                    window.location.href='/paciente/dashboard'</script>";
                    die();
            }
        }

        for($i = 0; $i < count($all_dados); $i++){
            if($all_dados[$i] == "" || $all_dados[$i] == null){
                echo"<script language='javascript' type='text/javascript'>alert('Há campo(s) faltando preenchimento');
                window.location.href='/paciente/dashboard'</script>";
                die();
            }
        }

        $query = "UPDATE  Pacientes SET nome = '$nome', senha = '$senha', data_nasc = '$data', sexo = '$sexo', cor = '$cor', rua = '$rua', cep = '$cep', bairro = '$bairro',
        cidade = '$cidade', uf = '$uf', telefone = '$telefone', email = '$email', numero = '$numero', complemento = '$complemento' WHERE cpf = '$cpf'";
        $modificarPaciente = $db->query($query);

        if($modificarPaciente) {
            echo"<script language='javascript' type='text/javascript'>alert('Usuário atualizado com sucesso!');
            window.location.href='/paciente/dashboard'</script>";
        }else{
             echo"<script language='javascript' type='text/javascript'>alert('Não foi possível atualizar esse usuário');
            window.location.href='/paciente/dashboard'</script>";
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
                $valor = array("crm_exame"=>$row_exame['crm_exame'], "status"=>$row_exame['status'], "id_exame"=>$row_exame['id_exame']);
                array_push($array_exames, $valor);
            }

            $elementCount = count($array_exames);

            while($row_medico = $resultado_medico->fetch_assoc()){
                for($i = 0; $i < $elementCount; $i++){
                    if($array_exames[$i]['crm_exame'] === $row_medico['crm']){
                        $valoresAdicionais = array("nome"=>$row_medico['nome'], "crm"=>$array_exames[$i]['crm_exame'], 
                        "status"=>$array_exames[$i]['status'], "id_exame"=>$array_exames[$i]['id_exame']);
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
        $result_laudo = "SELECT * FROM Laudos WHERE cpf_laudo = '$cpf_paciente'";
        $result_medico = "SELECT * FROM Medicos";

        $resultado_paciente = $db->query($result_paciente);
        $resultado_exame = $db->query($result_exame);
        $resultado_laudo = $db->query($result_laudo);
        $resultado_medico = $db->query($result_medico);

        if ($resultado_paciente->num_rows <= 0){
            echo"<script language='javascript' type='text/javascript'>alert('Não existe esse Paciente');</script>";
            die();
        }
        else{
            $valores = array();
            $array_exames = array();
            $array_laudos = array();
            $array_medicos = array();
            
            $row_paciente = $resultado_paciente->fetch_assoc();
            $valores = array("nome"=>$row_paciente['nome'], "data_nasc"=>$row_paciente['data_nasc'], "cpf"=>$row_paciente['cpf'],
            "cor"=>$row_paciente['cor'], "sexo"=>$row_paciente['sexo'], "cep"=>$row_paciente['cep'], "rua"=>$row_paciente['rua'], "bairro"=>$row_paciente['bairro'],
            "numero"=>$row_paciente['numero'], "complemento"=>$row_paciente['complemento'], "cidade"=>$row_paciente['cidade'], "uf"=>$row_paciente['uf'],
            "telefone"=>$row_paciente['telefone'], "email"=>$row_paciente['email']);

            while($row_exame = $resultado_exame->fetch_assoc()){
                $valor = array("id_exame"=>$row_exame['id_exame'], "data_exame"=>$row_exame['data_exame'], "nome_exame"=>$row_exame['nome_exame'], 
                "crm_exame"=>$row_exame['crm_exame'], "status"=>$row_exame['status'], "recomendacao"=>$row_exame['recomendacao'], 
                "diagnostico_previo"=>$row_exame['diagnostico_previo']);
                array_push($array_exames, $valor);
            }
            array_push($valores, $array_exames);

            while($row_laudo = $resultado_laudo->fetch_assoc()){
                $valor = array("id_laudo"=>$row_laudo['id_laudo'], "laudo"=>$row_laudo['laudo'], "crm_laudo"=>$row_laudo['crm_laudo'], "imagem"=>$row_laudo['imagem']);
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

	public function resultado($id_exame){
		$database = new database;
		$db = $database->connect();

		$result_exame = "SELECT * FROM Exames WHERE id_exame = '$id_exame'";
		$result_laudo = "SELECT * FROM Laudos WHERE id_exame = '$id_exame'";
		$result_medico = "SELECT * FROM Medicos";

		$resultado_exame = $db->query($result_exame);
		$resultado_laudo = $db->query($result_laudo);
		$resultado_medico = $db->query($result_medico);

		if ($resultado_exame->num_rows <= 0){
			echo"<script language='javascript' type='text/javascript'>alert('Não existe esse Exame');</script>";
			die();
		}
		else{
			$valores = array();
			$array_exames = array();
			$array_laudos = array();
			$array_medicos = array();

			while($row_exame = $resultado_exame->fetch_assoc()){
				$valor = array("id_exame"=>$row_exame['id_exame'], "data_exame"=>$row_exame['data_exame'], "nome_exame"=>$row_exame['nome_exame'],
					"crm_exame"=>$row_exame['crm_exame'], "status"=>$row_exame['status'], "recomendacao"=>$row_exame['recomendacao'],
					"diagnostico_previo"=>$row_exame['diagnostico_previo']);

				$cpf_paciente = $row_exame['cpf_exame'];
				$status_avaliador = $row_exame['status'];
				array_push($array_exames, $valor);
			}

			while($row_laudo = $resultado_laudo->fetch_assoc()){
				$valor = array("id_laudo"=>$row_laudo['id_laudo'], "laudo"=>$row_laudo['laudo'], "crm_laudo"=>$row_laudo['crm_laudo'], "imagem"=>$row_laudo['imagem']);
				array_push($array_laudos, $valor);
			}

			while($row_medico = $resultado_medico->fetch_assoc()){
				$valor = array("nome"=>$row_medico['nome'], "crm"=>$row_medico['crm'], "tipo_medico"=>$row_medico['tipo_medico'], "titulacao"=>$row_medico['titulacao'],
					"ano_residencia"=>$row_medico['ano_residencia']);
				array_push($array_medicos, $valor);
			}

			$result_paciente = "SELECT * FROM Pacientes WHERE cpf = '$cpf_paciente'";
			$resultado_paciente = $db->query($result_paciente);

			$row_paciente = $resultado_paciente->fetch_assoc();
			$valores = array("nome"=>$row_paciente['nome'], "data_nasc"=>$row_paciente['data_nasc'], "cpf"=>$row_paciente['cpf'],
				"cor"=>$row_paciente['cor'], "sexo"=>$row_paciente['sexo'], "cep"=>$row_paciente['cep'], "rua"=>$row_paciente['rua'], "bairro"=>$row_paciente['bairro'],
				"numero"=>$row_paciente['numero'], "complemento"=>$row_paciente['complemento'], "cidade"=>$row_paciente['cidade'], "uf"=>$row_paciente['uf'],
				"telefone"=>$row_paciente['telefone'], "email"=>$row_paciente['email']);

			array_push($valores, $array_exames);
			array_push($valores, $array_laudos);
			array_push($valores, $array_medicos);
		}

		if($status_avaliador == "Laudo Validado"){
			return json_encode($valores);
		}else{
			echo"<script language='javascript' type='text/javascript'>alert('Laudo final ainda não disponivel.');</script>";
			die();
		}
	}
}