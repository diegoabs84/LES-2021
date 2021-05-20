<?php

include_once(__DIR__ . '/../database.php');

//use database;

class Medico{

    // public function retornaExame($id_exame){
    //     $database = new database;
    //     $db = $database->connect();

    //     $result_exame = "SELECT * FROM Exames WHERE id_exame = '$id_exame'";
    //     $resultado_exame = $db->query($result_exame);

    //     $row_exame = $resultado_exame->fetch_assoc();
    //     $cpf_exame = $row_exame['cpf_exame'];

    //     $result_paciente = "SELECT * FROM Pacientes WHERE cpf = '$cpf_exame'";
    //     $resultado_paciente = $db->query($result_paciente);
    //     $row_paciente = $resultado_paciente->fetch_assoc();

    //     $valores = array("nome_paciente"=>$row_paciente['nome'], "cpf_paciente"=>$row_paciente['cpf'], "sexo_paciente"=>$row_paciente['sexo'], 
    //     "data_nasc"=>$row_paciente['data_nasc'], "id_exame"=>$row_exame['id_exame'], "nome_exame"=>$row_exame['nome_exame']);

    //     return json_encode($valores);
        
    // }

    // public function diagnostico($id_exame){
    //     $database = new database;
    //     $db = $database->connect();

        // $result_exame = "SELECT * FROM Exames WHERE id_exame = '$id_exame'";
        // $resultado_exame = $db->query($result_exame);
        // $row_exame = $resultado_exame->fetch_assoc();
        // $cpf_exame = $row_exame['cpf_exame'];
        // $crm_exame = $row_exame['crm_exame'];
        // $diagnostico = $_POST['diagnostico'];

        // $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
        // $novo_nome = md5(time()) . $extensao;
        // $diretorio = "src/uploads_diagnostico/";

        // move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome);
        
        // $sqlDiagnostico = "INSERT INTO Diagnosticos (crm_diagnostico, id_exame, diagnostico, cpf_diagnostico, imagem) 
        // VALUES ('$crm_exame', '$id_exame', '$diagnostico', '$cpf_exame', '$novo_nome')";
        // $cadastro_diagnostico = $db->query($sqlDiagnostico);

        // if($cadastro_diagnostico){
        //     echo "Diagnostico Efetuado com Sucesso!<br>";

        //     $sqlStatus = "UPDATE Exames SET status = 'Diagnosticado' WHERE id_exame = '$id_exame'";
        //     $mudar_status = $db->query($sqlStatus);

        //     if($mudar_status){
        //         echo "<br>Status Atualizado com Sucesso!";
        //     }
        // }
    // }

    public function retornaDados(){
        $database = new database;
        $db = $database->connect();

        $crm = $_COOKIE['crm'];

        $result_medico = "SELECT * FROM Medicos WHERE crm = '$crm'";
        $result_exame = "SELECT * FROM Exames WHERE crm_exame = '$crm'";
        $result_paciente = "SELECT * FROM Pacientes";

        $resultado_medico = $db->query($result_medico);
        $resultado_exame = $db->query($result_exame);
        $resultado_paciente = $db->query($result_paciente);

        $array_exames = array();

        if ($resultado_medico->num_rows <= 0){
            echo"<script language='javascript' type='text/javascript'>alert('Não existe esse Médico');</script>";
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

            $row_medico = $resultado_medico->fetch_assoc();
            $valores = array("nome_medico"=>$row_medico['nome'], "crm"=>$row_medico['crm'], "total_pacientes"=>$total_pacientes, "total_espera"=>$total_espera);

            while($row_paciente = $resultado_paciente->fetch_assoc()){
                for($i = 0; $i < $total_pacientes; $i++){
                    if($array_exames[$i]['cpf_exame'] === $row_paciente['cpf']){
                        $valoresAdicionais = array("nome_paciente"=>$row_paciente['nome'], "sobrenome_paciente"=>$row_paciente['sobrenome'] , 
                        "id_exame"=>$array_exames[$i]['id_exame'], "cpf_paciente"=>$array_exames[$i]['cpf_exame'], "status"=>$array_exames[$i]['status']);
                        
                        array_push($valores, $valoresAdicionais);
                    }
                }
            }

            return json_encode($valores);
        }
    }
}