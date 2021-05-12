<?php

include_once(__DIR__ . '/../../database.php');

$database = new database;
$db = $database->connect();

function retorna($cpf_paciente, $db){

    $result_paciente = "SELECT * FROM Diagnosticos WHERE cpf_paciente = '$cpf_paciente' LIMIT 1";
    $resultado_paciente = mysqli_query($db, $result_paciente);
    if($resultado_paciente->num_rows){
        $row_paciente = mysqli_fetch_assoc($resultado_paciente);
        // $valores['cpf_paciente'] = $row_paciente['cpf_paciente'];
        $valores['crm_responsavel'] = $row_paciente['crm_responsavel'];
        // $valores['data_exame'] = $row_paciente['data_exame'];
        $valores['diagnostico'] = $row_paciente['diagnostico'];
        // $valores['exame'] = $row_paciente['exame'];
    }else{
        $valores['data_exame'] = 'Data não encontrada';
    }
    return json_encode($valores);
}

if(isset($_GET['cpf_paciente'])){
    echo retorna($_GET['cpf_paciente'], $db);
}