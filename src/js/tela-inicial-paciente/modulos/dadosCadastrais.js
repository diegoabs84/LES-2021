
const createDadosCadastrais = () => {

    let input,label ='';

    //limpa o conteudo na div
    let conteudo = document.getElementById('conteudo-gerado');
    conteudo.innerHTML = '';


    //container pai de atualizar paciente
    let container = document.createElement('div');
    container.className = 'container-atualizar-cadastro';

    //adiciona o container pai dentro do elemento base
    conteudo.appendChild(container);

    //muda a variavel container para pegar o conteudo da div pai
    container = document.querySelector('.container-atualizar-cadastro');

    //cria o formulario
    let form = document.createElement('form');
    form.setAttribute('method', 'POST');
    form.setAttribute('action', '../../controllers/atualizar_paciente.php');

    // montar div nome
    let divNome = document.createElement('div');
    divNome.className = ' item atualizar-cadastro-nome';

    label = document.createElement('label');
    label.textContent = 'Nome';
    divNome.appendChild(label);
    
    input = document.createElement('input');
    input.setAttribute('type','text');
    input.setAttribute('name','nome');
    input.setAttribute('id','nome');
    input.setAttribute('placeholder','Insira seu nome');
    divNome.appendChild(input);

    //adiciona child no form
    form.appendChild(divNome);

    // montar div senha
    let divSenha = document.createElement('div');
    divSenha.className = 'item atualizar-cadastro-senha';

    label = document.createElement('label');
    label.textContent = 'Senha';
    divSenha.appendChild(label);
    
    input = document.createElement('input');
    input.setAttribute('type','password');
    input.setAttribute('name','senha');
    input.setAttribute('id','senha');
    input.setAttribute('placeholder','Senha');
    divSenha.appendChild(input);

    //adiciona ao form
    form.appendChild(divSenha);

    //monta div de tipo de pele


    //Adiciona tudo ao container pai
    container.appendChild(form);
}

export default createDadosCadastrais;