<?php

include_once('database.php');

$database = new database;
$conn = $database->connect();

$cpf = $_POST['cpf'];
$entrar = $_POST['entrar'];
$senha = md5($_POST['senha']);

if (isset($entrar)) {
	$query = "SELECT * FROM Pacientes WHERE cpf ='$cpf' AND senha = '$senha'";
	$verifica = $conn->query($query);
	if ($verifica->num_rows <= 0){
    		echo"<script language='javascript' type='text/javascript'>alert('CPF e/ou senha incorretos');window.location.href='../views/login/login_paciente.html';</script>";
		die();
	}else{
		setcookie("cpf",$cpf);
        header("Location:../views/dashboard/dashboard_paciente.html"); 
        }
}

?>
