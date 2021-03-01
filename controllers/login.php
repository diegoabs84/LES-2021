<?php
$login = $_POST['login'];
$entrar = $_POST['entrar'];
$senha = md5($_POST['senha']);
$connect = mysql_connect('localhost:3388','root','');
$db = mysql_select_db('Hospital_db');
      if (isset($entrar)) {

        $verifica = mysql_query("SELECT * FROM usuarios WHERE login =
        '$login' AND senha = '$senha'") or die("erro ao selecionar");
          if (mysql_num_rows($verifica)<=0){                              // Verificação se o login e senha são as mesmas da database
            echo"<script language='javascript' type='text/javascript'>
            alert('Login e/ou senha incorretos');window.location
            .href='login.html';</script>";
            die();
          }else{
            setcookie("login",$login);
            header("Location:index.php"); // Redirecionamento para index.php se o login/senha forem validados
          }
    }
?>