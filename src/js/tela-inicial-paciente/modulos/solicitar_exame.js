

const SolicitarExame = () => {
    let div = '';
    let form = '';
    let label = '';
    let input = '';
    let textLabel = {
        cpf: 'CPF',
        data: 'Data Prevista de Exame',
        tipo: 'Tipo de Exame',
        rec: 'Recomendações'
    };

    const date = new Date();
    

    //pega o elemento no html e limpa 
    let conteudoGerado = document.getElementById('conteudo-gerado');
    conteudoGerado.innerHTML = '';

    //cria o container pai
    let container = document.createElement('div');
    container.className = 'container-solicitar-exame';

    //adiciona o container pai dentro do elemento base
    conteudoGerado.appendChild(container);

    //muda a variavel container para pegar o elemento interno pela classe
    container = document.querySelector('.container-solicitar-exame');

    //cria o formulario
    form = document.createElement('form');
    form.setAttribute('method', 'POST');
    form.setAttribute('action', '../../controllers/solicitar_exame.php');

    // Criar elementos e
    //adicionar elementos dentro do formulario

    //criando area de input cpf
    div = document.createElement('div');
    div.className = 'item item-cpf';

    label = document.createElement('label');
    label.textContent = textLabel.cpf;
    div.appendChild(label);
    
    input = document.createElement('input');
    input.setAttribute('type','text');
    input.setAttribute('name','cpf');
    input.setAttribute('id','cpf');
    input.setAttribute('placeholder','000.000.000-00');
    div.appendChild(input);
    
    //adiciona child no form
    form.appendChild(div);

    //criando area de input data
    div = document.createElement('div');
    div.className = 'item item-data';

    label = document.createElement('label');
    label.textContent = textLabel.data;
    div.appendChild(label);
    
    input = document.createElement('input');
    input.setAttribute('type','date');
    input.setAttribute('name','data');
    input.setAttribute('id','data');
    input.setAttribute('value',date.toLocaleDateString());
    input.setAttribute('min','1910-01-01');
    
    div.appendChild(input);
    form.appendChild(div);
    
    //criando area de tipo de exame
    let select = document.createElement('select');
    let option1 = document.createElement('option');
    let option2 = document.createElement('option');
    let option3 = document.createElement('option');
    let option4 = document.createElement('option');

    div = document.createElement('div');
    div.className = 'item item-cadastro-tipo-exame';

    label = document.createElement('label');
    label.textContent = textLabel.tipo;
    div.appendChild(label);
    
    
    select.setAttribute('name','TipoExame');
    
    option1.setAttribute('selected','');
    option1.setAttribute('disabled','');
    option1.setAttribute('value', 'null');
    option1.textContent = 'Exame';
    select.appendChild(option1);

    option2.setAttribute('value','Ecocardiograma');
    option2.textContent = 'Ecocardiograma';
    select.appendChild(option2);

    option3.setAttribute('value','Eletrocardiograma');
    option3.textContent = 'Eletrocardiograma';
    select.appendChild(option3);

    option4.setAttribute('value','Mapa');
    option4.textContent = 'Mapa';
    select.appendChild(option4);

    div.appendChild(select);
    
    //adiciona child no form
    form.appendChild(div);


    //area de recomendacoes
    let textarea = document.createElement('textarea');

    div = document.createElement('div');
    div.className = 'item item-recomendacao';

    label = document.createElement('label');
    label.textContent = textLabel.rec;
    div.appendChild(label);
    
    
    textarea.setAttribute('name','recomende');
    textarea.setAttribute('id','recomende')
    
    
    div.appendChild(textarea);
    form.appendChild(div);

    //botao de submit
    div = document.createElement('div');
    div.className = 'item item-submit';

    input = document.createElement('input');
    input.setAttribute('type', 'submit');
    input.setAttribute('value', 'Solicitar');
    input.setAttribute('id', 'solicitar');
    input.setAttribute('name', 'solicitar');

    div.appendChild(input);
    form.appendChild(div);


    //adiciona o formulario ja preenchido com elementos filhos
    container.appendChild(form);
    
}

export default SolicitarExame;