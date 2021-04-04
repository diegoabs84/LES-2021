<?php
$servername = "localhost";
$username = "matheus";
$password = "root";
$dbname = "hospital";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function retorna($cpf_paciente, $conn){
    $result_paciente = "SELECT * FROM Diagnosticos WHERE cpf_paciente = '$cpf_paciente' LIMIT 1";
    $resultado_paciente = mysqli_query($conn, $result_paciente);
    if($resultado_paciente->num_rows){
        $row_paciente = mysqli_fetch_assoc($resultado_paciente);
        $valores['cpf_paciente'] = $row_paciente['cpf_paciente']
        $valores['crm_responsavel'] = $row_paciente['crm_responsavel'];
        $valores['data_exame'] = $row_paciente['data_exame'];
        $valores['diagnostico'] = $row_paciente['diagnostico'];
        $valores['exame'] = $row_paciente['exame'];
    }else{
        $valores['data_exame'] = 'Data não encontrada';
    }
    return json_encode($valores);
}

function inserirLaudo(){

    $cpf = $row_paciente['cpf_paciente'];
    $laudo = $_POST['laudo'];
    $crm_residente = $_POST['crm_residente']

    $sqlLaudo = "INSERT INTO Laudos (cpf_paciente, laudo, crm_residente) VALUES ('$cpf', '$laudo', '$crm_residente')";
	$cadastroLaudo = $conn->query($sqlLaudo);

    if($cadastroLaudo){
        echo "Cadastro de laudo realizado com sucesso!"
    }

}
?>
