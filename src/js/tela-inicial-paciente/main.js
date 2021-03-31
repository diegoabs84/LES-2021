import SolicitarExame from './solicitar_exame.js';
import createDashboard from './dashboard.js';
import createGeral from './geral.js';
import createVerExame from './ver-exame.js';
import createDadosCadastrais from './dadosCadastrais.js';


window.addEventListener('load', () => {


let geral = document.getElementById('geral');
let dashboard = document.getElementById('dashboard');
let solicitarExame = document.getElementById('solicitar-exame');
let verExame = document.getElementById('exame');
let dadosCadastrais = document.getElementById('dados-cadastrais');


geral.addEventListener('click', createGeral);

dashboard.addEventListener('click', createDashboard);

solicitarExame.addEventListener('click', SolicitarExame);

verExame.addEventListener('click', createVerExame);

dadosCadastrais.addEventListener('click', createDadosCadastrais);

});

    



     
    










