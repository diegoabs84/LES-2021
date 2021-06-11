<?php

include_once(__DIR__ . '/../database.php');

class Medico{

    public function retornaDados(){
        $database = new database;
        $db = $database->connect();

        $crm = $_COOKIE['crm'];

        $result_medico = "SELECT * FROM Medicos WHERE crm = '$crm'";
        $result_exame = "SELECT * FROM Exames WHERE crm_exame = '$crm'";
        $result_paciente = "SELECT * FROM Pacientes";

        $resultado_medico = $db->query($result_medico);
        $resultado_exame = $db->query($result_exame);
        $resultado_paciente = $db->query($result_paciente);

        $array_exames = array();

        if ($resultado_medico->num_rows <= 0){
            echo"<script language='javascript' type='text/javascript'>alert('Não existe esse Médico');</script>";
            die();
        }else{
            while($row_exame = $resultado_exame->fetch_assoc()){
                $valor = array("id_exame"=>$row_exame['id_exame'], "cpf_exame"=>$row_exame['cpf_exame'], "crm_exame"=>$row_exame['crm_exame'], "status"=>$row_exame['status']);
                array_push($array_exames, $valor);
            }

            $total_pacientes = count($array_exames);
            $total_validado = 0;

            for($i = 0; $i < $total_pacientes; $i++){
                if($array_exames[$i]['status'] === "Laudo Validado"){
                    $total_validado++;
                }
            }

            $row_medico = $resultado_medico->fetch_assoc();
            $valores = array("nome_medico"=>$row_medico['nome'], "crm"=>$row_medico['crm'], "total_pacientes"=>$total_pacientes, "total_validado"=>$total_validado);

            while($row_paciente = $resultado_paciente->fetch_assoc()){
                for($i = 0; $i < $total_pacientes; $i++){
                    if($array_exames[$i]['cpf_exame'] === $row_paciente['cpf']){
                        $valoresAdicionais = array("nome_paciente"=>$row_paciente['nome'],"id_exame"=>$array_exames[$i]['id_exame'], 
                        "cpf_paciente"=>$array_exames[$i]['cpf_exame'], "status"=>$array_exames[$i]['status']);
                        array_push($valores, $valoresAdicionais);
                    }
                }
            }

            return json_encode($valores);
        }
    }
}