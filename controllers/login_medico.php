<?php

include_once('database.php');

$database = new database;
$conn = $database->connect();

$crm = $_POST['crm'];
$entrar = $_POST['entrar'];
$senha = md5($_POST['senha']);

if (isset($entrar)) {
	$query = "SELECT * FROM Medicos WHERE crm ='$crm' AND senha = '$senha'";
	$verifica = $conn->query($query);
	if ($verifica->num_rows <= 0){
    		echo"<script language='javascript' type='text/javascript'>alert('CRM e/ou senha incorretos');window.location.href='../views/login/login_medico.html';</script>";
		die();
	}else{
		$rowMedico = $verifica->fetch_assoc();
		if ($rowMedico['tipo_medico'] == 'medico'){
			setcookie("crm",$crm);
			header("Location:../views/dashboard/dashboard_medico.html");
		}else if ($rowMedico['tipo_medico'] == 'residente'){
			setcookie("crm",$crm);
			header("Location:../views/dashboard/dashboard_residente.html");
		}else if ($rowMedico['tipo_medico'] == 'professor'){
			setcookie("crm",$crm);
			header("Location:../views/dashboard/dashboard_professor.html");
		}
    }
}
?>
