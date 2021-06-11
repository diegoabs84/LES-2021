<?php

include_once(__DIR__ . '/../database.php');

class Residente{
    
    public function inserirLaudo($id_exame){
        $database = new database;
        $db = $database->connect();
    
        $result_exame = "SELECT * FROM Exames WHERE id_exame = '$id_exame'";
        $result_laudo = "SELECT * FROM Laudos";

        $resultado_exame = $db->query($result_exame);
        $resultado_laudo = $db->query($result_laudo);

        $row_exame = $resultado_exame->fetch_assoc();
        $cpf_exame = $row_exame['cpf_exame'];
        $crm_laudo = $_COOKIE['crm'];
        $laudo = $_POST['laudo'];

        $verificar_laudo = false;

        $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
        $novo_nome = md5(time()) . $extensao;
        $diretorio = "src/uploads_laudo/";

        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome);

        while($row_laudo = $resultado_laudo->fetch_assoc()){
            if($row_laudo['id_exame'] = $row_exame['id_exame']){
                $verificar_laudo = true;
            }
        }
        
        if($verificar_laudo == true){
            $sqlLaudo = "UPDATE Laudos SET laudo = '$laudo', imagem = '$novo_nome' WHERE id_exame = '$id_exame'";
            $atualizar_laudo = $db->query($sqlLaudo);

            if($atualizar_laudo){
                echo "Laudo Atualizado com Sucesso!<br>";

                $sqlStatus = "UPDATE Exames SET status = 'Laudo Nao Validado', anotacao = '' WHERE id_exame = '$id_exame'";
                $mudar_status = $db->query($sqlStatus);

                if($mudar_status){
                    echo "<br>Status Atualizado com Sucesso!";
                }
            }
        }else{
            $sqlLaudo = "INSERT INTO Laudos (crm_laudo, id_exame, laudo, cpf_laudo, imagem) 
            VALUES ('$crm_laudo', '$id_exame', '$laudo', '$cpf_exame', '$novo_nome')";
            $cadastro_laudo = $db->query($sqlLaudo);

            if($cadastro_laudo){
                echo "Laudo Efetuado com Sucesso!<br>";

                $sqlStatus = "UPDATE Exames SET status = 'Laudo Nao Validado' WHERE id_exame = '$id_exame'";
                $mudar_status = $db->query($sqlStatus);

                if($mudar_status){
                    echo "<br>Status Atualizado com Sucesso!";
                }
            }
        }
    }

    public function retornaExame($id_exame){
        $database = new database;
        $db = $database->connect();

        $result_exame = "SELECT * FROM Exames WHERE id_exame = '$id_exame'";
        $resultado_exame = $db->query($result_exame);

        $row_exame = $resultado_exame->fetch_assoc();
        $cpf_exame = $row_exame['cpf_exame'];

        $result_paciente = "SELECT * FROM Pacientes WHERE cpf = '$cpf_exame'";
        $resultado_paciente = $db->query($result_paciente);
        $row_paciente = $resultado_paciente->fetch_assoc();

        $valores = array("nome_paciente"=>$row_paciente['nome'], "cpf_paciente"=>$row_paciente['cpf'], "sexo_paciente"=>$row_paciente['sexo'], 
        "data_nasc"=>$row_paciente['data_nasc'], "id_exame"=>$row_exame['id_exame'], "nome_exame"=>$row_exame['nome_exame'], 
        "diagnostico_previo"=>$row_exame['diagnostico_previo'], "anotacao"=>$row_exame['anotacao']);

        return json_encode($valores);
        
    }

    public function retornaDados(){
        $database = new database;
        $db = $database->connect();

        $crm = $_COOKIE['crm'];

        $result_residente = "SELECT * FROM Medicos WHERE crm = '$crm'";
        $result_exame = "SELECT * FROM Exames";
        $result_paciente = "SELECT * FROM Pacientes";
        $result_laudo = "SELECT * FROM Laudos WHERE crm_laudo = '$crm'";

        $resultado_residente = $db->query($result_residente);
        $resultado_exame = $db->query($result_exame);
        $resultado_paciente = $db->query($result_paciente);
        $resultado_laudo = $db->query($result_laudo);

        $array_exames = array();

        if ($resultado_residente->num_rows <= 0){
            echo"<script language='javascript' type='text/javascript'>alert('Não existe esse Residente');</script>";
            die();
        }else{
            while($row_exame = $resultado_exame->fetch_assoc()){
                if($row_exame['status'] == "Em Espera" || $row_exame['status'] == "Laudo para Revisar"){
                    $valor = array("id_exame"=>$row_exame['id_exame'], "cpf_exame"=>$row_exame['cpf_exame'], 
                    "crm_exame"=>$row_exame['crm_exame'], "status"=>$row_exame['status']);
                    array_push($array_exames, $valor);
                }
            }

            $total_pacientes = count($array_exames);
            $total_laudos = 0;

            while($resultado_laudo->fetch_assoc()){
                $total_laudos++;
            }

            $row_residente = $resultado_residente->fetch_assoc();
            $valores = array("nome_residente"=>$row_residente['nome'], "crm_residente"=>$row_residente['crm'], "total_laudos"=>$total_laudos);

            while($row_paciente = $resultado_paciente->fetch_assoc()){
                for($i = 0; $i < $total_pacientes; $i++){
                    if($array_exames[$i]['cpf_exame'] === $row_paciente['cpf']){
                        $valoresAdicionais = array("nome_paciente"=>$row_paciente['nome'], "id_exame"=>$array_exames[$i]['id_exame'], 
                        "cpf_paciente"=>$array_exames[$i]['cpf_exame'], "status"=>$array_exames[$i]['status']);
                        
                        array_push($valores, $valoresAdicionais);
                    }
                }
            }
        }

        return json_encode($valores);
    }

}