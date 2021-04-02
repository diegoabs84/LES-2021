<?php

$servername = "localhost";
$username = "matheus";
$password = "root";
$dbname = "hospital";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$login = $_POST['login'];
$entrar = $_POST['entrar'];
$senha = md5($_POST['senha']);
#$funcionario = $_POST['funcionario'];

if (isset($entrar)) {
	$query = "SELECT * FROM Funcionarios WHERE login ='$login' AND senha = '$senha'";
	$verifica = $conn->query($query);
	if ($verifica->num_rows <= 0){
    		echo"<script language='javascript' type='text/javascript'>alert('LOGIN e/ou senha incorretos');window.location.href='../views/login/login_funcionario.html';</script>";
		die();
	}else{
		setcookie("login",$login);
        header("Location:../views/dashboard/dashboard_funcionario.html"); 
        }
    }

?>