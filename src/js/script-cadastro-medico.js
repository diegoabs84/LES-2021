window.addEventListener('load', () => {
  let divCadastro = document.getElementById('tipoMedico');

  divCadastro.addEventListener('change', (event) => {
    switch (event.target.value) {
      case 'medico':
        limpaConteudo();
        break;
      case 'residente':
        gerarResidencia();
        break;
      case 'professor':
        gerarTitulacao();
        break;

      case 'null':
        limpaConteudo();
        break;

      default:
        break;
    }
  });
});

function gerarResidencia() {
  let conteudoVariavel = document.getElementById('conteudo-variavel');
  conteudoVariavel.innerHTML = '';

  const anoResidente = `
  <div class="item item-residencia">
    <label>Ano da residência</label><br />
    <select name="ano_residente" id="ano_residente">
    <option selected value="null">---|---</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
</select>
</div>
`;

  conteudoVariavel.innerHTML = anoResidente;
}

function gerarTitulacao() {
  let conteudoVariavel = document.getElementById('conteudo-variavel');
  conteudoVariavel.innerHTML = '';

  const titulacao = `
  <div class="item item-titulacao">
  <label>Titulação</label> <br />
  <select name="titulacao" id="titulacao">
    <option selected value="null">
      ---|---
    </option>
    <option value="mestre">Mestre</option>
    <option value="doutor">Doutor</option>
    <option value="phd">PHD</option>
  </select>
</div>
`;

  conteudoVariavel.innerHTML = titulacao;
}

function limpaConteudo() {
  let conteudoVariavel = document.getElementById('conteudo-variavel');
  conteudoVariavel.innerHTML = '';
}
