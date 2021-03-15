<?php
$servername = "localhost";
$username = "root";
$password = "cfarias";
$dbname = "hospital";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function retorna($cpf_paciente, $conn){
    $result_paciente = "SELECT * FROM exames WHERE cpf_paciente = '$cpf_paciente' LIMIT 1";
    $resultado_paciente = mysqli_query($conn, $result_paciente);
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
    echo retorna($_GET['cpf_paciente'], $conn);
}

if(isset($_POST['cpf_paciente'])) {

    $cpf = $_POST['cpf_paciente'];
    $data = $_POST['data_prevista'];
    $crm = $_POST['crm_solicitador'];
    $exame = $_POST['exame'];
    $diagnostico = $_POST['diagnostico'];

    $sql = "INSERT INTO diagnostico (cpf_paciente, crm_responsavel,exame,data_exame,diagnostico) VALUES ('$cpf', '$crm', '$exame','$data','$diagnostico')";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

?>