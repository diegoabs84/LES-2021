<?php

include_once(__DIR__ . '/../database.php');

//use database;

class Residente{
    
    public function inserirLaudo(){
        $database = new database;
        $db = $database->connect();
    
        $cpf = $_POST['cpf_paciente'];
        $laudo = $_POST['laudo'];
        $crm_residente = $_POST['crm_residente'];
    
        $sqlLaudo = "INSERT INTO Laudos (cpf_paciente, laudo, crm_residente) VALUES ('$cpf', '$laudo', '$crm_residente')";
        $cadastroLaudo = $db->query($sqlLaudo);
    
        if($cadastroLaudo){
            echo "Cadastro de laudo realizado com sucesso!";
        }
    
    }

    public function retornaDados(){
        $database = new database;
        $db = $database->connect();

        $crm = $_COOKIE['crm'];

        $result_residente = "SELECT * FROM Medicos WHERE crm = '$crm'";

        $resultado_residente = $db->query($result_residente);

        if ($resultado_residente->num_rows <= 0){
            echo"<script language='javascript' type='text/javascript'>alert('Não existe esse Reseidente');</script>";
            die();
        }else{
            $row_residente = $resultado_residente->fetch_assoc();
            $valores = array("nome_residente"=>$row_residente['nome'], "crm_residente"=>$row_residente['crm']);
        }
        return json_encode($valores);
    }

    public function retornaDiagnostico(){
        $database = new database;
        $db = $database->connect();

        // $cpf_paciente = $_GET['cpf_paciente'];
        $cpf_paciente = "123";

        $result_paciente = "SELECT * FROM Diagnosticos WHERE cpf_paciente = '$cpf_paciente' LIMIT 1";
        $resultado_paciente = mysqli_query($db, $result_paciente);
        if($resultado_paciente->num_rows){
            $row_paciente = mysqli_fetch_assoc($resultado_paciente);
            // $valores['crm_responsavel'] = $row_paciente['crm_responsavel'];
            // $valores['diagnostico'] = $row_paciente['diagnostico'];
            $valores = array("crm_responsavel"=>$row_paciente['crm_responsavel'], "diagnostico"=>$row_paciente['diagnostico']);
        }else{
            $valores['data_exame'] = 'Data não encontrada';
        }
        return json_encode($valores);
    }

}