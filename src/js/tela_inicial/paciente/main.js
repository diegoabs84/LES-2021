
import createDashboard from './modulos/dashboard.js';
import createDadosCadastrais from '../common/dadosCadastrais.js';


window.addEventListener('load', () => {

//Pegando os elementos

let dashboard = document.getElementById('dashboard');
let dadosCadastrais = document.getElementById('dados-cadastrais');
let logout = document.getElementById('logout');

//Monta a pagina geral assim que a pagina carrega
createDashboard();

//Eventos


dashboard.addEventListener('click', createDashboard);

dadosCadastrais.addEventListener('click', createDadosCadastrais);

logout.addEventListener('click', ()=>{
    let isSure = confirm("Realmente deseja sair?");
    if(isSure) window.location.href= '/';
    
});



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

    



     
    










