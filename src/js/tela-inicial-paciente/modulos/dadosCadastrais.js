
const createDadosCadastrais = () => {

    let input,label,select,option ='';
    let data = new Date();

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

    //monta div data de nascimento
    let divData = document.createElement('div');
    divData.className = 'item atualizar-cadastro-data-nascimento';

    label = document.createElement('label');
    label.textContent = 'Data de Nascimento';
    divData.appendChild(label);
    
    input = document.createElement('input');
    input.setAttribute('type','date');
    input.setAttribute('name','data');
    input.setAttribute('id','data');
    input.setAttribute('value', data.toLocaleDateString());
    input.setAttribute('min','1910-01-01');
    divData.appendChild(input);

    //adiciona ao form
    form.appendChild(divData);

    //montar div cor de pele
     select = document.createElement('select');
     
    
    let divCor = document.createElement('div');
    divCor.className = 'item atualizar-cor';

    label = document.createElement('label');
    label.textContent = 'Cor';
    divCor.appendChild(label);
    
    
    select.setAttribute('name','cor');
    select.setAttribute('id','cor');
    
    option = document.createElement('option');
    option.setAttribute('selected','');
    option.setAttribute('value', 'null');
    option.textContent = '---|---';
    select.appendChild(option);

    option = document.createElement('option');
    option.setAttribute('value','branco');
    option.textContent = 'Branco';
    select.appendChild(option);

    option = document.createElement('option');
    option.setAttribute('value','negro');
    option.textContent = 'Negro';
    select.appendChild(option);

    option = document.createElement('option');
    option.setAttribute('value','pardo');
    option.textContent = 'Pardo';
    select.appendChild(option);

    divCor.appendChild(select);
    
    //adiciona child no form
    form.appendChild(divCor);

    //montar div sexo



    //Adiciona tudo ao container pai
    container.appendChild(form);
}

export default createDadosCadastrais;