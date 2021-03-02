<?php
                                                                    // Funçoes para o cadastro e conexao com o banco de dados
$nome = $_POST['nome'];
$crm = $_POST['crm'];
$senha = MD5($_POST['senha']);
$connect = mysql_connect('localhost:3388','root','');
$db = mysql_select_db('Hospital_db');
$query_select = "SELECT login FROM Medicos WHERE crm = '$crm'";
$select = mysql_query($query_select,$connect);
$array = mysql_fetch_array($select);
$logarray = $array['login'];

                                                                    // O Javascript dentro dos 'if-else' são pros pop-ups de avisos
if($login == "" || $login == null){
    echo"<script language='javascript' type='text/javascript'>
    alert('O campo login deve ser preenchido');window.location.href='
    cadastro.html';</script>";

    }else{
      if($logarray == $login){

        echo"<script language='javascript' type='text/javascript'>
        alert('Esse login já existe');window.location.href='
        cadastro_medico.html';</script>";
        die();

      }else{
        $query = "INSERT INTO Medicos (nome,crm,senha) VALUES ('$nome','$crm','$senha')";
        $insert = mysql_query($query,$connect);

        if($insert){
          echo"<script language='javascript' type='text/javascript'>
          alert('Médico cadastrado com sucesso!');window.location.
          href='login_medico.html'</script>";
        }else{
          echo"<script language='javascript' type='text/javascript'>
          alert('Não foi possível cadastrar esse médico');window.location
          .href='cadastro_medico.html'</script>";
        }
      }
    }
?>