import SolicitarExame from './modulos/solicitar_exame.js';
import createDashboard from './modulos/dashboard.js';
import createGeral from './modulos/geral.js';
import createDadosCadastrais from './modulos/dadosCadastrais.js';


window.addEventListener('load', () => {

//Pegando os elementos
let geral = document.getElementById('geral');
let dashboard = document.getElementById('dashboard');
let solicitarExame = document.getElementById('solicitar-exame');
let dadosCadastrais = document.getElementById('dados-cadastrais');

//Monta a pagina geral assim que a pagina carrega
createGeral();

//Eventos
geral.addEventListener('click', createGeral);

dashboard.addEventListener('click', createDashboard);

solicitarExame.addEventListener('click', SolicitarExame);

dadosCadastrais.addEventListener('click', createDadosCadastrais);

});

    



     
    










