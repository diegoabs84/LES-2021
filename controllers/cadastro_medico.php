<?php
                                                                    // Funçoes para o cadastro e conexao com o banco de dados

$nome = $_POST['nome'];
$senha = MD5($_POST['senha']);
$crm = $_POST['crm'];
$medico = $_POST['medico'];
$connect = mysql_connect('localhost:3388','root','');
$db = mysql_select_db('Hospital_db');
$query_select = "SELECT nome FROM medicos WHERE nome = '$nome'";
$select = mysql_query($query_select,$connect);
$array = mysql_fetch_array($select);
$logarray = $array['nome'];

                                        // O Javascript dentro dos 'if-else' são pros pop-ups de avisos



  if($nome == "" || $nome == null){
    echo"<script language='javascript' type='text/javascript'>
    alert('O campo login deve ser preenchido');window.location.href='
    cadastro.html';</script>";

    }else{
      if($logarray == $nome){

        echo"<script language='javascript' type='text/javascript'>
        alert('Esse login já existe');window.location.href='
        cadastro_paciente.html';</script>";
        die();

      }else{
        $query = "INSERT INTO medicos (nome,senha,crm,medico) VALUES ('$nome','$senha','$crm','$medico')";
        $insert = mysql_query($query,$connect);

        if($insert){
          echo"<script language='javascript' type='text/javascript'>
          alert('Usuário cadastrado com sucesso!');window.location.
          href='login_paciente.html'</script>";
        }else{
          echo"<script language='javascript' type='text/javascript'>
          alert('Não foi possível cadastrar esse usuário');window.location
          .href='cadastro_paciente.html'</script>";
        }
      }
    }

?>