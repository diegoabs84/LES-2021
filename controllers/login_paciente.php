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
$entrar = $_POST['entrar'];
$senha = md5($_POST['senha']);

if (isset($entrar)) {
	$query = "SELECT * FROM Pacientes WHERE cpf ='$cpf' AND senha = '$senha'";
	$verifica = $conn->query($query);
	if ($verifica->num_rows <= 0){
    		echo"<script language='javascript' type='text/javascript'>alert('CPF e/ou senha incorretos');window.location.href='../views/login_paciente.html';</script>";
		die();
	}else{
		setcookie("cpf",$cpf);
            	header("Location:index_paciente.php"); 
        }
}

?>
