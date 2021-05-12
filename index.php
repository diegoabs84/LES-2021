<?php

include_once(__DIR__ . '/source/App/Web.php');
include_once(__DIR__ . '/source/App/Paciente.php');
include_once(__DIR__ . '/source/App/Medico.php');
include_once(__DIR__ . '/source/App/Professor.php');
include_once(__DIR__ . '/source/App/Residente.php');
include_once(__DIR__ . '/source/App/Funcionario.php');

$web = new Web;
$paciente = new Paciente;
$medico = new Medico;
$professor = new Professor;
$residente = new Residente;
$funcionario = new Funcionario;

$request = $_SERVER['REQUEST_URI'];

$endpoint = explode('/', $request);

switch($endpoint[1]){

    case '':
        $view = $web->home();
        require_once __DIR__ . $view;
        break;
    
    case 'paciente':
        switch($endpoint[2]){

            case 'login':
                if (count($endpoint) == 3 && $_SERVER['REQUEST_METHOD'] == "GET"){
                    require_once __DIR__ . '/views/login/login_paciente.html';
                }else if(count($endpoint) == 3 && $_SERVER['REQUEST_METHOD'] == "POST"){
                    $view = $paciente->loginPaciente();
                    require_once __DIR__ . $view;
                }
            break;

            case 'dashboard':
                require_once __DIR__ . '/views/inicial/inicial_paciente.html';
                break;

            case 'dados':
                echo $paciente->retornaDados();
                break;

            case 'cadastro':
                if (count($endpoint) == 3 && $_SERVER['REQUEST_METHOD'] == "GET"){
                    require_once __DIR__ . '/views/cadastro/cadastro_paciente.html';
                }else if(count($endpoint) == 3 && $_SERVER['REQUEST_METHOD'] == "POST"){
                    $view = $paciente->cadastrarPaciente();
                    require_once __DIR__ . $view;
                }
                break;

            case 'atualizar':
                if (count($endpoint) == 3 && $_SERVER['REQUEST_METHOD'] == "GET"){
                    require_once __DIR__ . '/views/cadastro/atualizar_paciente.html';
                }else if(count($endpoint) == 3 && $_SERVER['REQUEST_METHOD'] == "POST"){
                    $view = $paciente->atualizarPaciente();
                    require_once __DIR__ . $view;
                }
                break;

        }
        break;

    case 'solicitar_exame' :
        if ($_SERVER['REQUEST_METHOD'] == "GET"){
            require_once __DIR__ . '/views/solicitar_exame/solicitar_exame.html';
        }else if ($_SERVER['REQUEST_METHOD'] == "POST"){
            $view = $medico->solicitarExame();
            require_once __DIR__ . $view;
        }
        break;

    case 'login_medicos' :
        if ($_SERVER['REQUEST_METHOD'] == "GET"){
            require_once __DIR__ . '/views/login/login_medico.html';
        }else if ($_SERVER['REQUEST_METHOD'] == "POST"){
            $view = $medico->loginMedico();
            require_once __DIR__ . $view;
        }
        break;

    case 'medico':
        switch($endpoint[2]){

            case 'dashboard' :
                require_once __DIR__ . '/views/inicial/inicial_medico.html';
                break;

            case 'dados':
                echo $medico->retornaDados();
                break;

            case 'diagnostico' :
                if ($_SERVER['REQUEST_METHOD'] == "GET"){
                    require_once __DIR__ . '/views/diagnostico/diagnostico.html';
                }else if ($_SERVER['REQUEST_METHOD'] == "POST"){
                    $view = $medico->diagnostico();
                    require_once __DIR__ . $view;
                }
                break;
        }
        break;

    case 'professor':
        switch($endpoint[2]){

            case 'dashboard':
                require_once __DIR__ . '/views/inicial/inicial_professor.html';
                break;

            case 'dados':
                echo $professor->retornaDados();
                break;

        }
        break;

    case 'residente':
        switch($endpoint[2]){
    
            case 'dashboard':
                require_once __DIR__ . '/views/inicial/inicial_residente.html';
                break;

            case 'dados':
                echo $residente->retornaDados();
                break;

            case 'dados_diagnostico':
                echo $residente->retornaDiagnostico();
                break;

            case 'emitir_laudo' :
                if ($_SERVER['REQUEST_METHOD'] == "POST"){
                    $view = $residente->inserirLaudo();
                    require_once __DIR__ . $view;
                }
                break;
    
        }   
        break;

    case 'funcionario':
        switch($endpoint[2]){

            case 'login' :
                if ($_SERVER['REQUEST_METHOD'] == "GET"){
                    require_once __DIR__ . '/views/login/login_funcionario.html';
                }else if ($_SERVER['REQUEST_METHOD'] == "POST"){
                    $view = $funcionario->loginFuncionario();
                    require_once __DIR__ . $view;
                }
                break;

            case 'dashboard' :
                require_once __DIR__ . '/views/dashboard/dashboard_funcionario.html';
                break;
            
            case 'cadastro_medico' :
                if ($_SERVER['REQUEST_METHOD'] == "GET"){
                    require_once __DIR__ . '/views/cadastro/cadastro_medico.html';
                }else if ($_SERVER['REQUEST_METHOD'] == "POST"){
                    $view = $funcionario->cadastrarMedico();
                    require_once __DIR__ . $view;
                }
                break;

        }
        break;

}