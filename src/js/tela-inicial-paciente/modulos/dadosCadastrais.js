
const createDadosCadastrais = () => {
    //limpa o conteudo na div
    let conteudo = document.getElementById('conteudo-gerado');
    conteudo.innerHTML = '';


    //container pai de atualizar paciente
    let container = document.createElement('div');
    container.className = 'container-atualizar-cadastro';

    //adiciona o container pai dentro do elemento base
    conteudo.appendChild(container);

    //muda a variavel container para pegar o conteudo da div pai
    container = document.querySelector('container-atualizar-cadastro');

    



}

export default createDadosCadastrais;