import laudo from './modulos/laudo.js';
import createDashboard from './modulos/dashboard.js';
//import createDadosCadastrais from '../common/dadosCadastrais.js';


window.addEventListener('load', () => {

//Pegando os elementos
let dashboard = document.getElementById('dashboard');

let laudos = document.getElementById('emitir-laudo');

let logout = document.getElementById('logout');

//Monta a pagina geral assim que a pagina carrega
createDashboard();

//Eventos

dashboard.addEventListener('click', createDashboard);

laudos.addEventListener('click', laudo);



logout.addEventListener('click', ()=>{
    let isSure = confirm("Realmente deseja sair?");
    if(isSure) window.location.href= '../index.html';
    
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

    



     
    










