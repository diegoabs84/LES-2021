import SolicitarExame from './modulos/solicitar_exame.js';
import createDashboard from './modulos/dashboard.js';
import createDadosCadastrais from './modulos/dadosCadastrais.js';


window.addEventListener('load', () => {

//Pegando os elementos
let logout = document.getElementById('logout');
let dashboard = document.getElementById('dashboard');
let solicitarExame = document.getElementById('solicitar-exame');
let dadosCadastrais = document.getElementById('dados-cadastrais');

//Monta a pagina geral assim que a pagina carrega


//Eventos

dashboard.addEventListener('click', createDashboard);

solicitarExame.addEventListener('click', SolicitarExame);

dadosCadastrais.addEventListener('click', createDadosCadastrais);

logout.addEventListener('click', ()=>{});



// sidebar 
let isToggled = document.querySelector('.toggle');
let sidebar = document.querySelector('.sidebar');
let main = document.querySelector('.main');

isToggled.addEventListener('click', toggleMenu);


function toggleMenu(){
    isToggled.classList.toggle('active');
    sidebar.classList.toggle('active');
    main.classList.toggle('active');
}


});

    



     
    










