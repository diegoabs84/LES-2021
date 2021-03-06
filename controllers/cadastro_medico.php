<?php
                                                                    // Funçoes para o cadastro e conexao com o banco de dados

$nome = $_POST['nome'];
$senha = MD5($_POST['senha']);
$crm = $_POST['crm'];
$medico = $_POST['medico'];
$tipo_medico = $_POST['tipo_medico'];
$ano_residente = $_POST['ano_residente'];
$connect = mysql_connect('localhost:3388','root','');
$db = mysql_select_db('Hospital_db');
$query_select = "SELECT crm FROM crm WHERE crm = '$crm'";
$select = mysql_query($query_select,$connect);
$array = mysql_fetch_array($select);
$logarray = $array['crm'];

                                        // O Javascript dentro dos 'if-else' são pros pop-ups de avisos



  if($crm == "" || $crm == null){
    echo"<script language='javascript' type='text/javascript'>
    alert('O campo crm deve ser preenchido');window.location.href='
    views/cadastro_medico.html';</script>";

    }else{
      if($logarray == $nome){

        echo"<script language='javascript' type='text/javascript'>
        alert('Esse login já existe');window.location.href='
        ../views/cadastro_medico.html';</script>";
        die();

      }else{
        $query = "INSERT INTO medicos (nome,senha,crm,medico,tipo_medico,ano_residente) VALUES ('$nome','$senha','$crm','$medico','$tipo_medico','$ano_residente')";
        $insert = mysql_query($query,$connect);

        if($insert){
          echo"<script language='javascript' type='text/javascript'>
          alert('Usuário cadastrado com sucesso!');window.location.
          href='../views/login_medico.html'</script>";
        }else{
          echo"<script language='javascript' type='text/javascript'>
          alert('Não foi possível cadastrar esse usuário');window.location
          .href='../views/cadastro_medico.html'</script>";
        }
      }
    }

?>