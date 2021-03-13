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
$crm = $_POST['crm'];
$tipo_medico = $_POST['tipo_medico'];
$titulacao = $_POST['titulacao'];
$ano_residente = $_POST['ano_residente'];
$query_select = "SELECT nome, crm FROM Medicos";
$select = $conn->query($query_select);

if($crm == "" || $crm == null){
  	  echo"<script language='javascript' type='text/javascript'>
  	  alert('O campo crm deve ser preenchido');window.location.href='
  	  ..views/cadastro_medico.html';</script>";
}

if ($select->num_rows >= 0){
	while ($rowMedico = $select->fetch_assoc()){
  		if($rowMedico['crm'] == $crm){

  	      		echo"<script language='javascript' type='text/javascript'>alert('Essa CRM já está cadastrada');window.location.href='../views/cadastro_medico.html';</script>";
  	      		die();
		}
	}
	$query = "INSERT INTO Medicos (nome, senha, crm, tipo_medico, titulacao, ano_residencia) VALUES ('$nome','$senha','$crm','$tipo_medico','$titulacao','$ano_residente')";
  	$cadastrarMedico = $conn->query($query);

  	if($cadastrarMedico) {
		echo"<script language='javascript' type='text/javascript'>alert('Usuário cadastrado com sucesso!');window.location.href='../views/login_medico.html'</script>";
	}else{
  	        echo"<script language='javascript' type='text/javascript'>alert('Não foi possível cadastrar esse usuário');window.location.href='../views/cadastro_medico.html'</script>";
  	}
}

?>
