<?php

include_once(__DIR__ . '/../database.php');

//use database;

class Medico{

    public function loginMedico(){
        $database = new database;
        $db = $database->connect();

        $crm = $_POST['crm'];
        $senha = MD5($_POST['senha']);

        $query = "SELECT * FROM Medicos WHERE crm ='$crm' AND senha = '$senha'";
        $verifica = $db->query($query);
        if ($verifica->num_rows <= 0){
            echo"<script language='javascript' type='text/javascript'>alert('CRM e/ou senha incorretos');window.location.href='/login_medicos';</script>";
            die();
        }else{
            $rowMedico = $verifica->fetch_assoc();
            if ($rowMedico['tipo_medico'] == 'medico'){
                setcookie("crm",$crm);
                header("Location:/medico/dashboard");
            }else if ($rowMedico['tipo_medico'] == 'residente'){
                setcookie("crm",$crm);
                header("Location:/residente/dashboard");
            }else if ($rowMedico['tipo_medico'] == 'professor'){
                setcookie("crm",$crm);
                header("Location:/professor/dashboard");
            }
        }
    }

    public function solicitarExame(){
        $database = new database;
        $db = $database->connect();

        $cpf = $_POST['cpf'];
        $data = $_POST['data'];
        $tipoExame = $_POST['TipoExame'];
        $recomende = $_POST['recomende'];
        $crm = $_COOKIE['crm'];
        $status = "Em Espera";

        $sql = "SELECT nome FROM Pacientes WHERE cpf = '$cpf'";
        $result = $db->query($sql);

        $sqlVerfMedico = "SELECT nome, crm FROM Medicos WHERE crm = '$crm'";
        $resultCRM = $db->query($sqlVerfMedico);

        if ($resultCRM->num_rows > 0) {
            while ($rowMedico = $resultCRM->fetch_assoc()){

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                
                        $sqlExame = "INSERT INTO Exames (data_prevista, nome_exame, recomendacao, crm_solicitador, cpf_paciente, status) 
                        VALUES ('$data', '$tipoExame', '$recomende', '$crm', '$cpf', '$status')";
                        $cadastroExame = $db->query($sqlExame);
                
                        if($cadastroExame){
                            echo "Exame solicitado com sucesso!<br>";
                            echo "<br>";
                            echo "Paciente: ". $row['nome'] ."<br>";
                            echo "Exame: ". $tipoExame ."<br>";
                            echo "Data do Exame: ". $data ."<br>";
                            echo "Recomendação Médica: ". $recomende ."<br>";
                            echo "Médico: ". $rowMedico['nome'] . " CRM: ". $rowMedico['crm'] ."<br>";
                        }
                    }
                } else {
                    echo"<script language='javascript' type='text/javascript'>alert('Paciente não Cadastrado. Cadastro automatico realizado. Senha padrão definida: 123.');</script>";
                    $senha = MD5('123');
                    $query = "INSERT INTO Pacientes (senha, cpf) VALUES ('$senha','$cpf')";
                    $cadastrarPaciente = $db->query($query);

                    $sqlExame = "INSERT INTO Exames (data_prevista, nome_exame, recomendacao, crm_solicitador, cpf_paciente, status) 
                    VALUES ('$data', '$tipoExame', '$recomende', '$crm', '$cpf', '$status')";
                    $cadastroExame = $db->query($sqlExame);

                    if($cadastrarPaciente && $cadastroExame){
                        echo "Exame solicitado com sucesso!<br>";
                        echo "<br>";
                        echo "CPF Paciente: ". $cpf ."<br>";
                        echo "Exame: ". $tipoExame ."<br>";
                        echo "Data do Exame: ". $data ."<br>";
                        echo "Recomendação Médica: ". $recomende ."<br>";
                        echo "Médico: ". $rowMedico['nome'] . " CRM: ". $rowMedico['crm'] ."<br>";
                    }
                }
            }
        } else{
            echo"<script language='javascript' type='text/javascript'>alert('Médico não Cadastrado');window.location.href='/solicitar_exame';</script>";
        }
    }

    public function diagnostico(){
        $database = new database;
        $db = $database->connect();
        
        if(isset($_POST['cpf_paciente'])) {
        
            $cpf = $_POST['cpf_paciente'];
            $data = $_POST['data_prevista'];
            $crm = $_POST['crm_solicitador'];
            $exame = $_POST['exame'];
            $diagnostico = $_POST['diagnostico'];
        
            $sql = "INSERT INTO Diagnosticos (cpf_paciente, crm_responsavel,exame,data_exame,diagnostico) VALUES ('$cpf', '$crm', '$exame','$data','$diagnostico')";
        
            if (mysqli_query($db, $sql)) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($db);
            }
        }
    }

    public function retornaDados(){
        $database = new database;
        $db = $database->connect();

        $crm = $_COOKIE['crm'];

        $result_medico = "SELECT * FROM Medicos WHERE crm = '$crm'";
        $result_exame = "SELECT * FROM Exames WHERE crm_solicitador = '$crm'";
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
                $valor = array("cpf_paciente"=>$row_exame['cpf_paciente'], "crm_solicitador"=>$row_exame['crm_solicitador'], "status"=>$row_exame['status']);
                array_push($array_exames, $valor);
            }

            $total_pacientes = count($array_exames);
            $total_espera = 0;

            for($i = 0; $i < $total_pacientes; $i++){
                if($array_exames[$i]['status'] === "Em Espera"){
                    $total_espera++;
                }
            }

            $row_medico = $resultado_medico->fetch_assoc();
            $valores = array("nome_medico"=>$row_medico['nome'], "crm"=>$row_medico['crm'], "total_pacientes"=>$total_pacientes, "total_espera"=>$total_espera);

            while($row_paciente = $resultado_paciente->fetch_assoc()){
                for($i = 0; $i < $total_pacientes; $i++){
                    if($array_exames[$i]['cpf_paciente'] === $row_paciente['cpf']){
                        $valoresAdicionais = array("nome_paciente"=>$row_paciente['nome'], "sobrenome_paciente"=>$row_paciente['sobrenome'] , 
                        "cpf_paciente"=>$array_exames[$i]['cpf_paciente'], "status"=>$array_exames[$i]['status']);
                        
                        array_push($valores, $valoresAdicionais);
                    }
                }
            }

            return json_encode($valores);
        }
    }
}