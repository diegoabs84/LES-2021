<?php

include_once(__DIR__ . '/../database.php');

class Professor{

    public function retornaDados(){
        $database = new database;
        $db = $database->connect();

        $crm_residente = $_COOKIE['crm'];

        $result_medico = "SELECT * FROM Medicos";
        $result_paciente = "SELECT * FROM Pacientes";
        $result_laudo = "SELECT * FROM Laudos";
        $result_exame = "SELECT * FROM Exames";

        $resultado_medico = $db->query($result_medico);
        $resultado_paciente = $db->query($result_paciente);
        $resultado_laudo = $db->query($result_laudo);
        $resultado_exame = $db->query($result_exame);

        if ($resultado_medico->num_rows <= 0){
            echo"<script language='javascript' type='text/javascript'>alert('Não existe esse Médico');</script>";
            die();
        }else{
            $valores = array();
            $array_medicos = array();
            $array_pacientes = array();
            $array_laudos = array();

            while($row_medico = $resultado_medico->fetch_assoc()){
                $valoresAdicionais = array("nome"=>$row_medico['nome'], "crm"=>$row_medico['crm']);
                        
                array_push($array_medicos, $valoresAdicionais);
            }

            array_push($valores, $array_medicos);

            for($i = 0; $i < count($array_medicos); $i++){
                if($array_medicos[$i]['crm'] == $crm_residente){
                    $valor = array("nome"=>$array_medicos[$i]['nome'], "crm"=>$array_medicos[$i]['crm']);

                    array_push($valores, $valor);
                }
            }

            while($row_paciente = $resultado_paciente->fetch_assoc()){
                $valoresAdicionais = array("nome_paciente"=>$row_paciente['nome'], "cpf_paciente"=>$row_paciente['cpf']);
                        
                array_push($array_pacientes, $valoresAdicionais);
            }

            array_push($valores, $array_pacientes);

            while($row_laudo = $resultado_laudo->fetch_assoc()){
                while($row_exame = $resultado_exame->fetch_assoc()){
                    if($row_exame['id_exame'] == $row_laudo['id_exame']){
                        if($row_exame['status'] == "Laudo Nao Validado"){
                            $valoresAdicionais = array("id_laudo"=>$row_laudo['id_laudo'], "cpf_laudo"=>$row_laudo['cpf_laudo'], 
                            "laudo"=>$row_laudo['laudo'], "crm_laudo"=>$row_laudo['crm_laudo'], "imagem"=>$row_laudo['imagem']);
                            array_push($array_laudos, $valoresAdicionais);
                        }
                    }
                }
            }

            array_push($valores, $array_laudos);

            return json_encode($valores);
        }
    }

    public function retornaLaudo($id_laudo){
        $database = new database;
        $db = $database->connect();

        $result_laudo = "SELECT * FROM Laudos WHERE id_laudo = '$id_laudo'";

        $resultado_laudo = $db->query($result_laudo);
        $row_laudo = $resultado_laudo->fetch_assoc();

        $id_exame = $row_laudo['id_exame'];

        $result_exame = "SELECT * FROM Exames WHERE id_exame = '$id_exame'";
        $resultado_exame = $db->query($result_exame);
        $row_exame = $resultado_exame->fetch_assoc();

        $cpf_laudo = $row_laudo['cpf_laudo'];

        $result_paciente = "SELECT * FROM Pacientes WHERE cpf = '$cpf_laudo'";
        $resultado_paciente = $db->query($result_paciente);
        $row_paciente = $resultado_paciente->fetch_assoc();

        $valores = array("nome_paciente"=>$row_paciente['nome'], "cpf_paciente"=>$row_paciente['cpf'], "sexo_paciente"=>$row_paciente['sexo'], 
        "data_nasc"=>$row_paciente['data_nasc'], "id_exame"=>$row_exame['id_exame'], "nome_exame"=>$row_exame['nome_exame'], "diagnostico_previo"=>$row_exame['diagnostico_previo'], 
        "laudo"=>$row_laudo['laudo'], "imagem"=>$row_laudo['imagem']);

        return json_encode($valores);
    }

    public function validarLaudo($id_laudo){
        $database = new database;
        $db = $database->connect();

        $anotacao = $_POST['anotacao'];

        $result_laudo = "SELECT * FROM Laudos WHERE id_laudo = '$id_laudo'";

        $resultado_laudo = $db->query($result_laudo);
        $row_laudo = $resultado_laudo->fetch_assoc();

        $id_exame = $row_laudo['id_exame'];

        if($anotacao == ""){
            $sqlStatus = "UPDATE Exames SET status = 'Laudo Validado' WHERE id_exame = '$id_exame'";
            $mudar_status = $db->query($sqlStatus);

            if($mudar_status){
                echo "Laudo Validado!<br><br>";
            }
        }else{
            $sqlStatus = "UPDATE Exames SET status = 'Laudo para Revisão', anotacao = '$anotacao' WHERE id_exame = '$id_exame'";
            $mudar_status = $db->query($sqlStatus);

            if($mudar_status){
                echo "Laudo com anotação!<br><br>Residente informado sobre a anotação.";
            }
        }
    }

}