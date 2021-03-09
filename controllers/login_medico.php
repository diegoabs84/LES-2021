<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$crm = $_POST['crm'];
$entrar = $_POST['entrar'];
$senha = md5($_POST['senha']);
#$medico = $_POST['medico'];

if (isset($entrar)) {
	$query = "SELECT * FROM Medicos WHERE crm ='$crm' AND senha = '$senha'";
	$verifica = $conn->query($query);
	if ($verifica->num_rows <= 0){
    		echo"<script language='javascript' type='text/javascript'>alert('CRM e/ou senha incorretos');window.location.href='../views/login_medico.html';</script>";
		die();
	}else{
		$rowMedico = $verifica->fetch_assoc();
		if ($rowMedico['tipo_medico'] == 'residente'){
			setcookie("crm",$crm);
			header("Location:index_medico.php");
		}else{
			setcookie("crm",$crm);
			header("Location:../views/solicitar_exame.html");
		}
        }
}
?>
