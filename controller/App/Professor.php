<?php

include_once(__DIR__ . '/../database.php');

//use database;

class Professor{

    public function retornaDados(){
        $database = new database;
        $db = $database->connect();

        $crm = $_COOKIE['crm'];

        $result_medico = "SELECT * FROM Medicos WHERE crm = '$crm'";

        $resultado_medico = $db->query($result_medico);

        if ($resultado_medico->num_rows <= 0){
            echo"<script language='javascript' type='text/javascript'>alert('Não existe esse Médico');</script>";
            die();
        }else{
            $row_medico = $resultado_medico->fetch_assoc();
            $valores = array("nome"=>$row_medico['nome'], "crm"=>$row_medico['crm']);

            return json_encode($valores);
        }
    }

}