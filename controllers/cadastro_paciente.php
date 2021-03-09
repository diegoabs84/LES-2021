<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$nome = $_POST['nome'];
$senha = MD5($_POST['senha']);
$cpf = $_POST['cpf'];
$data = $_POST['data'];
$sexo = $_POST['sexo'];
$cor = $_POST['cor'];
$query_select = "SELECT nome FROM Pacientes WHERE nome = '$nome'";
$select = $conn->query($query_select);

if($cpf == "" || $cpf == null){
		echo"<script language='javascript' type='text/javascript'>alert('O campo CPF deve ser preenchido');window.location.href='/..views/cadastro_paciente.html';</script>";
}

if ($select->num_rows >= 0){
	while ($rowPaciente = $select->fetch_assoc()){
  		if($rowPaciente['cpf'] == $cpf){

  	      		echo"<script language='javascript' type='text/javascript'>alert('Esse CPF já está cadastrada');window.location.href='../views/cadastro_paciente.html';</script>";
  	      		die();
		}
	}
	$query = "INSERT INTO Pacientes (nome, senha, cpf, data_nasc, sexo, cor) VALUES ('$nome','$senha','$cpf','$data','$sexo','$cor')";
  	$cadastrarPaciente = $conn->query($query);

  	if($cadastrarPaciente) {
		echo"<script language='javascript' type='text/javascript'>alert('Usuário cadastrado com sucesso!');window.location.href='../views/login_paciente.html'</script>";
	}else{
  	        echo"<script language='javascript' type='text/javascript'>alert('Não foi possível cadastrar esse usuário');window.location.href='../views/cadastro_paciente.html'</script>";
  	}
}

?>
