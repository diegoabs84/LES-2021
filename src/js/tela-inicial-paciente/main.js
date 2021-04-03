import SolicitarExame from './modulos/solicitar_exame.js';
import createDashboard from './modulos/dashboard.js';
import createGeral from './modulos/geral.js';
import createVerExame from './modulos/ver-exame.js';
import createDadosCadastrais from './modulos/dadosCadastrais.js';


window.addEventListener('load', () => {


let geral = document.getElementById('geral');
let dashboard = document.getElementById('dashboard');
let solicitarExame = document.getElementById('solicitar-exame');
let verExame = document.getElementById('exame');
let dadosCadastrais = document.getElementById('dados-cadastrais');

//Monta a pagina geral assim que a pagina carrega
createGeral();

//Eventos
geral.addEventListener('click', createGeral);

dashboard.addEventListener('click', createDashboard);

solicitarExame.addEventListener('click', SolicitarExame);

verExame.addEventListener('click', createVerExame);

dadosCadastrais.addEventListener('click', createDadosCadastrais);

});

    



     
    










