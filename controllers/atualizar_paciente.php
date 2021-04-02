<?php

$servername = "localhost";
$username = "matheus";
$password = "root";
$dbname = "hospital";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$nome = $_POST['nome'];
$senha = MD5($_POST['senha']);
$cpf = $_COOKIE['cpf'];
$data = $_POST['data'];
$sexo = $_POST['sexo'];
$cor = $_POST['cor'];
$query_select = "SELECT nome FROM Pacientes WHERE cpf = '$cpf'";
$select = $conn->query($query_select);

$query = "UPDATE  Pacientes SET nome = '$nome', senha = '$senha', data_nasc = '$data', sexo = '$sexo', cor = '$cor' WHERE cpf = '$cpf'";
$modificarPaciente = $conn->query($query);

if ($select->num_rows > 0) {
    while ($row = $select->fetch_assoc()) {

        if($row['nome'] == ''){

            if($modificarPaciente) {
                echo"<script language='javascript' type='text/javascript'>alert('Usuário atualizado com sucesso!');window.location.href='../views/dashboard/dashboard_paciente.html'</script>";
            }else{
                echo"<script language='javascript' type='text/javascript'>alert('Não foi possível atualizar esse usuário');window.location.href='../views/dashboard/dashboard_paciente.html'</script>";
            }

        }else{
            echo"<script language='javascript' type='text/javascript'>alert('Paciente já está com os dados atualizados!');window.location.href='../views/dashboard/dashboard_paciente.html'</script>";
        }

    }

}

?>
