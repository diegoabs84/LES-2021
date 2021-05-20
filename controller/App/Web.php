<?php

include_once(__DIR__ . '/../database.php');

class Web{

    public function home(){
        return "/views/index.html";
    }

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
        $diagnostico_previo = $_POST['diagnostico_previo'];
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
                
                        $sqlExame = "INSERT INTO Exames (data_exame, nome_exame, diagnostico_previo, recomendacao, crm_exame, cpf_exame, status) 
                            VALUES ('$data', '$tipoExame', '$diagnostico_previo', '$recomende', '$crm', '$cpf', '$status')";
                        $cadastroExame = $db->query($sqlExame);
                
                        if($cadastroExame){
                            echo "Exame solicitado com sucesso!<br>";
                            echo "<br>";
                            echo "Paciente: ". $row['nome'] ."<br>";
                            echo "Exame: ". $tipoExame ."<br>";
                            echo "Data do Exame: ". $data ."<br>";
                            echo "Diagnostico Previo: ". $diagnostico_previo ."<br>";
                            echo "Recomendação Médica: ". $recomende ."<br>";
                            echo "Médico: Dr(a). ". $rowMedico['nome'] . " CRM: ". $rowMedico['crm'] ."<br>";
                        }
                    }
                } else {
                    echo"<script language='javascript' type='text/javascript'>alert('Paciente não Cadastrado. Cadastro automatico realizado. Senha padrão definida: 123.');</script>";
                    $senha = MD5('123');
                    $query = "INSERT INTO Pacientes (senha, cpf) VALUES ('$senha','$cpf')";
                    $cadastrarPaciente = $db->query($query);

                    $sqlExame = "INSERT INTO Exames (data_exame, nome_exame, diagnostico_previo, recomendacao, crm_exame, cpf_exame, status) 
                        VALUES ('$data', '$tipoExame', '$diagnostico_previo', '$recomende', '$crm', '$cpf', '$status')";
                    $cadastroExame = $db->query($sqlExame);

                    if($cadastrarPaciente && $cadastroExame){
                        echo "Exame solicitado com sucesso!<br>";
                        echo "<br>";
                        echo "CPF Paciente: ". $cpf ."<br>";
                        echo "Exame: ". $tipoExame ."<br>";
                        echo "Data do Exame: ". $data ."<br>";
                        echo "Diagnostico Previo: ". $diagnostico_previo ."<br>";
                        echo "Recomendação Médica: ". $recomende ."<br>";
                        echo "Médico: Dr(a). ". $rowMedico['nome'] . " CRM: ". $rowMedico['crm'] ."<br>";
                    }
                }
            }
        } else{
            echo"<script language='javascript' type='text/javascript'>alert('Médico não Cadastrado');window.location.href='/solicitar_exame';</script>";
        }
    }

}