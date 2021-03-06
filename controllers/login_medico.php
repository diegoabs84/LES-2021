<?php
$crm = $_POST['crm'];
$entrar = $_POST['entrar'];
$senha = md5($_POST['senha']);
$medico = $_POST['medico'];
$connect = mysql_connect('localhost:3388','root','');
$db = mysql_select_db('Hospital_db');



      if (isset($entrar)) {
        $verifica = mysql_query("SELECT * FROM medicos WHERE crm =
        '$crm' AND senha = '$senha'") or die("erro ao selecionar");
          if (mysql_num_rows($verifica)<=0){                              // Verificação se o login e senha são as mesmas da database
            echo"<script language='javascript' type='text/javascript'>
            alert('Login e/ou senha incorretos');window.location
            .href='../views/login_medico.html';</script>";
            die();
          }else{
            setcookie("crm",$crm);
            header("Location:index_medico.php"); // Redirecionamento para index.php se o login/senha forem validados

                          }


    }
?>