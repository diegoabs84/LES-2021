<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
	
$cpf = $_POST['cpf'];
$data = $_POST['data'];
$tipoExame = $_POST['TipoExame'];
$recomende = $_POST['recomende'];
$crm = $_COOKIE['crm'];

$sql = "SELECT nome FROM Pacientes WHERE cpf = '$cpf'";
$result = $conn->query($sql);

$sqlVerfMedico = "SELECT nome, crm FROM Medicos WHERE crm = '$crm'";
$resultCRM = $conn->query($sqlVerfMedico);

if ($resultCRM->num_rows > 0) {
	while ($rowMedico = $resultCRM->fetch_assoc()){

		if ($result->num_rows > 0) {
		  	while ($row = $result->fetch_assoc()) {
		
		  		$sqlExame = "INSERT INTO Exames (data_prevista, nome_exame, recomendacao, crm_solicitador, cpf_paciente) VALUES ('$data', '$tipoExame', '$recomende', '$crm', '$cpf')";
		  		$cadastroExame = $conn->query($sqlExame);
		
		  		if($cadastroExame){
					echo "Exame solicitado com sucesso!<br>";
					echo "<br>";
					echo "Paciente: ". $row['nome'] ."<br>";
					echo "Exame: ". $tipoExame ."<br>";
					echo "Data do Exame: ". $data ."<br>";
					echo "Recomendação Médica: ". $recomende ."<br>";
					echo "Médico: ". $rowMedico['nome'] . " CRM: ". $rowMedico['crm'] ."<br>";
		  		}
		  	}
		} else {
			echo"<script language='javascript' type='text/javascript'>alert('Paciente não Cadastrado');window.location.href='../views/solicitar_exame.html';</script>";
		}
	}
} else{
	echo"<script language='javascript' type='text/javascript'>alert('Médico não Cadastrado');window.location.href='../views/solicitar_exame.html';</script>";
}
	
?>
