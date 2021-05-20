<?php

include_once(__DIR__ . '/../database.php');

//use database;

class Residente{
    
    public function inserirLaudo($id_exame){
        $database = new database;
        $db = $database->connect();
    
        $result_exame = "SELECT * FROM Exames WHERE id_exame = '$id_exame'";
        $resultado_exame = $db->query($result_exame);
        $row_exame = $resultado_exame->fetch_assoc();
        $cpf_exame = $row_exame['cpf_exame'];
        $crm_laudo = $_COOKIE['crm'];
        $laudo = $_POST['laudo'];

        $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
        $novo_nome = md5(time()) . $extensao;
        $diretorio = "src/uploads_laudo/";

        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome);
        
        $sqlDiagnostico = "INSERT INTO Laudos (crm_laudo, id_exame, laudo, cpf_laudo, imagem) 
        VALUES ('$crm_laudo', '$id_exame', '$laudo', '$cpf_exame', '$novo_nome')";
        $cadastro_diagnostico = $db->query($sqlDiagnostico);

        if($cadastro_diagnostico){
            echo "Diagnostico Efetuado com Sucesso!<br>";

            $sqlStatus = "UPDATE Exames SET status = 'Laudo NV' WHERE id_exame = '$id_exame'";
            $mudar_status = $db->query($sqlStatus);

            if($mudar_status){
                echo "<br>Status Atualizado com Sucesso!";
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
        "data_nasc"=>$row_paciente['data_nasc'], "id_exame"=>$row_exame['id_exame'], "nome_exame"=>$row_exame['nome_exame'], "diagnostico_previo"=>$row_exame['diagnostico_previo']);

        return json_encode($valores);
        
    }

    public function retornaDados(){
        $database = new database;
        $db = $database->connect();

        $crm = $_COOKIE['crm'];

        $result_residente = "SELECT * FROM Medicos WHERE crm = '$crm'";
        $result_exame = "SELECT * FROM Exames";
        $result_paciente = "SELECT * FROM Pacientes";

        $resultado_residente = $db->query($result_residente);
        $resultado_exame = $db->query($result_exame);
        $resultado_paciente = $db->query($result_paciente);

        $array_exames = array();

        if ($resultado_residente->num_rows <= 0){
            echo"<script language='javascript' type='text/javascript'>alert('Não existe esse Residente');</script>";
            die();
        }else{
            while($row_exame = $resultado_exame->fetch_assoc()){
                $valor = array("id_exame"=>$row_exame['id_exame'], "cpf_exame"=>$row_exame['cpf_exame'], "crm_exame"=>$row_exame['crm_exame'], "status"=>$row_exame['status']);
                array_push($array_exames, $valor);
            }

            $total_pacientes = count($array_exames);
            $total_espera = 0;

            for($i = 0; $i < $total_pacientes; $i++){
                if($array_exames[$i]['status'] === "Em Espera"){
                    $total_espera++;
                }
            }

            $row_residente = $resultado_residente->fetch_assoc();
            $valores = array("nome_residente"=>$row_residente['nome'], "crm_residente"=>$row_residente['crm']);

            while($row_paciente = $resultado_paciente->fetch_assoc()){
                for($i = 0; $i < $total_pacientes; $i++){
                    if($array_exames[$i]['cpf_exame'] === $row_paciente['cpf']){
                        $valoresAdicionais = array("nome_paciente"=>$row_paciente['nome'], "sobrenome_paciente"=>$row_paciente['sobrenome'] , 
                        "id_exame"=>$array_exames[$i]['id_exame'], "cpf_paciente"=>$array_exames[$i]['cpf_exame'], "status"=>$array_exames[$i]['status']);
                        
                        array_push($valores, $valoresAdicionais);
                    }
                }
            }
        }

        return json_encode($valores);
    }

}