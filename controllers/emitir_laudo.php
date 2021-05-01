<?php

include_once('database.php');

$database = new database;
$conn = $database->connect();

function retorna($cpf_paciente, $conn){
    $result_paciente = "SELECT * FROM Diagnosticos WHERE cpf_paciente = '$cpf_paciente' LIMIT 1";
    $resultado_paciente = mysqli_query($conn, $result_paciente);
    if($resultado_paciente->num_rows){
        $row_paciente = mysqli_fetch_assoc($resultado_paciente);
        $valores['cpf_paciente'] = $row_paciente['cpf_paciente'];
        $valores['crm_responsavel'] = $row_paciente['crm_responsavel'];
        $valores['diagnostico'] = $row_paciente['diagnostico'];
        $valores['exame'] = $row_paciente['exame'];
    }else{
        $valores['crm_responsavel'] = NULL;
        $valores['diagnostico'] = 'Não Existe Diagnostico Cadastrado';
        $valores['exame'] = NULL;
    }
    return json_encode($valores);
}

if(isset($_GET['cpf_paciente'])){
    echo retorna($_GET['cpf_paciente'], $conn);
}

if(isset($_POST['cpf_paciente'])){

    $cpf = $_POST['cpf_paciente'];
    $laudo = $_POST['laudo'];
    $crm_residente = $_COOKIE['crm'];

    $exame = $_POST['exame'];

    if($exame != NULL){
        $sqlLaudo = "INSERT INTO Laudos (cpf_paciente, laudo, crm_residente) VALUES ('$cpf', '$laudo', '$crm_residente')";
        $cadastroLaudo = $conn->query($sqlLaudo);

        if($cadastroLaudo){
            echo "Cadastro de laudo realizado com sucesso!";
        }
    }else{
        echo "Tentativa de Cadastro Invalida! Verifique a Existência de um Diagnostico.";
    }

}
?>
