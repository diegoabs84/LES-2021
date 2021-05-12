
import createDashboard from './modulos/dashboard.js';
import createGeral from './modulos/geral.js';
import createVerExame from './modulos/ver-exame.js';
import createDadosCadastrais from './modulos/dadosCadastrais.js';


window.addEventListener('load', () => {

//Pegando os elementos
let geral = document.getElementById('geral');
let dashboard = document.getElementById('dashboard');
let verExame = document.getElementById('exame');
let dadosCadastrais = document.getElementById('dados-cadastrais');

//Monta a pagina geral assim que a pagina carrega
createGeral();

//Eventos
geral.addEventListener('click', createGeral);

dashboard.addEventListener('click', createDashboard);

verExame.addEventListener('click', createVerExame);

dadosCadastrais.addEventListener('click', createDadosCadastrais);

});

    



     
    










