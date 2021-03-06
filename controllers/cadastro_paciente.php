<?php
                                                                    // Funçoes para o cadastro e conexao com o banco de dados

$login = $_POST['login'];
$senha = MD5($_POST['senha']);
$cpf = $_POST['cpf'];
$data = $_POST['data'];
$sexo = $_POST['sexo'];
$cor = $_POST['cor'];
$connect = mysql_connect('localhost:3388','root','');
$db = mysql_select_db('Hospital_db');
$query_select = "SELECT login FROM usuarios WHERE login = '$login'";
$select = mysql_query($query_select,$connect);
$array = mysql_fetch_array($select);
$logarray = $array['login'];

                                        // O Javascript dentro dos 'if-else' são pros pop-ups de avisos



  if($login == "" || $login == null){
    echo"<script language='javascript' type='text/javascript'>
    alert('O campo login deve ser preenchido');window.location.href='
    /..views/cadastro.html';</script>";

    }else{
      if($logarray == $login){

        echo"<script language='javascript' type='text/javascript'>
        alert('Esse login já existe');window.location.href='
        ../cadastro_paciente.html';</script>";
        die();

      }else{
        $query = "INSERT INTO usuarios (login,senha,cpf,data,sexo,cor) VALUES ('$login','$senha','$cpf','$data','$sexo','$cor')";
        $insert = mysql_query($query,$connect);

        if($insert){
          echo"<script language='javascript' type='text/javascript'>
          alert('Usuário cadastrado com sucesso!');window.location.
          href='../views/login_paciente.html'</script>";
        }else{
          echo"<script language='javascript' type='text/javascript'>
          alert('Não foi possível cadastrar esse usuário');window.location
          .href='../views/cadastro_paciente.html'</script>";
        }
      }
    }

?>