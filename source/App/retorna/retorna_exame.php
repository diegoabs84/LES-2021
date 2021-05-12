<?php

include_once(__DIR__ . '/../../database.php');

$database = new database;
$db = $database->connect();

function retorna($cpf_paciente, $db){
    
    $result_paciente = "SELECT * FROM Exames WHERE cpf_paciente = '$cpf_paciente' LIMIT 1";
    $resultado_paciente = mysqli_query($db, $result_paciente);
    if($resultado_paciente->num_rows){
        $row_paciente = mysqli_fetch_assoc($resultado_paciente);
        $valores['data_prevista'] = $row_paciente['data_prevista'];
        $valores['crm_solicitador'] = $row_paciente['crm_solicitador'];
        $valores['exame'] = $row_paciente['nome_exame'];
    }else{
        $valores['data_prevista'] = 'Data não encontrada';
    }
    return json_encode($valores);
}

if(isset($_GET['cpf_paciente'])){
    echo retorna($_GET['cpf_paciente'], $db);
}