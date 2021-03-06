<?php
  $login_cookie = $_COOKIE['crm'];
    if(isset($login_cookie)){
      echo"Bem-Vindo, $login_cookie <br>";
    }else{
      echo"Bem-Vindo, voce não está logado <br>";
      echo"Essas informacoees <font color='red'>NAO PODEM</font> ser acessadas por voce";
      echo"<br><a href='login.html'>Faça Login</a> Para ter acesso a pagina";
    }
?>