window.addEventListener('load', () => {
  let divCadastro = document.getElementById('tipoMedico');

  divCadastro.addEventListener('change', (event) => {
    switch (event.target.value) {
      case 'medico':
        gerarTipoMedico();
        break;
      case 'residente':
        gerarResidencia();
        break;
      case 'professor':
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

function gerarTipoMedico() {
  let conteudoVariavel = document.getElementById('conteudo-variavel');
  conteudoVariavel.innerHTML = '';

  const tipoMedico = `
  <div class="item tipo-medico">
  <label>Tipo de médico</label> <br />
  <select name="tipo_medico" id="tipo_medico">
    <option selected value="null">
      ---|---
    </option>
    <option value="mestre">Mestre</option>
    <option value="doutor">Doutor</option>
    <option value="phd">PHD</option>
  </select>
</div>
`;

  conteudoVariavel.innerHTML = tipoMedico;
}

function limpaConteudo() {
  let conteudoVariavel = document.getElementById('conteudo-variavel');
  conteudoVariavel.innerHTML = '';
}
