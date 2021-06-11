<?php

include_once(__DIR__ . '/controller/App/Web.php');
include_once(__DIR__ . '/controller/App/Paciente.php');
include_once(__DIR__ . '/controller/App/Medico.php');
include_once(__DIR__ . '/controller/App/Professor.php');
include_once(__DIR__ . '/controller/App/Residente.php');
include_once(__DIR__ . '/controller/App/Funcionario.php');

$web = new Web;
$paciente = new Paciente;
$medico = new Medico;
$professor = new Professor;
$residente = new Residente;
$funcionario = new Funcionario;

$request = $_SERVER['REQUEST_URI'];

$endpoint = explode('/', $request);

switch($endpoint[1]){

    // PACIENTE    
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

            case 'dados_atualizacao':
                echo $paciente->retornaAtualizacao();
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
    
    // MEDICO
    case 'medico':
        switch($endpoint[2]){

            case 'dashboard' :
                require_once __DIR__ . '/views/inicial/inicial_medico.html';
                break;

            case 'dados':
                echo $medico->retornaDados();
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

            case 'dados_laudo':
                $id_laudo = $endpoint[3];
                echo $professor->retornaLaudo($id_laudo);
                break;
            
            case 'validar_laudo':
                $id_laudo = $endpoint[3];
                if ($_SERVER['REQUEST_METHOD'] == "GET"){
                    require_once __DIR__ . '/views/validar_laudo/validar_laudo.html';
                }else if ($_SERVER['REQUEST_METHOD'] == "POST"){
                    $professor->validarLaudo($id_laudo);
                }
                break;

        }
        break;
    
    // RESIDENTE
    case 'residente':
        switch($endpoint[2]){
    
            case 'dashboard':
                require_once __DIR__ . '/views/inicial/inicial_residente.html';
                break;

            case 'dados':
                echo $residente->retornaDados();
                break;

            case 'dados_exame':
                $id_exame = $endpoint[3];
                echo $residente->retornaExame($id_exame);
                break;

            case 'emitir_laudo' :
                $id_exame = $endpoint[3];
                if ($_SERVER['REQUEST_METHOD'] == "GET"){
                    require_once __DIR__ . '/views/laudo/laudo.html';
                }else if ($_SERVER['REQUEST_METHOD'] == "POST"){
                    $residente->inserirLaudo($id_exame);
                }
                break;
    
        }   
        break;
    
    // FUNCIONARIO
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

    // WEB
    case '':
        $view = $web->home();
        require_once __DIR__ . $view;
        break;

    case 'login_medicos' :
        if ($_SERVER['REQUEST_METHOD'] == "GET"){
            require_once __DIR__ . '/views/login/login_medico.html';
        }else if ($_SERVER['REQUEST_METHOD'] == "POST"){
            $view = $web->loginMedico();
            require_once __DIR__ . $view;
        }
        break;

    case 'solicitar_exame' :
        if ($_SERVER['REQUEST_METHOD'] == "GET"){
            require_once __DIR__ . '/views/solicitar_exame/solicitar_exame.html';
        }else if ($_SERVER['REQUEST_METHOD'] == "POST"){
            $web->solicitarExame();
        }
        break;

    case 'prontuario':
        $cpf_paciente = $endpoint[2];
        if ($_SERVER['REQUEST_METHOD'] == "GET"){
            require_once __DIR__ . '/views/prontuario/prontuario.html';
        }else if ($_SERVER['REQUEST_METHOD'] == "POST"){
            echo $paciente->prontuario($cpf_paciente);
        }
        break;

	case 'resultado':
		$id_exame = $endpoint[2];
		if ($_SERVER['REQUEST_METHOD'] == "GET") {
			require_once __DIR__ . '/views/resultado/resultado.html';
		} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
			echo $paciente->resultado($id_exame);
		}
		break;

}