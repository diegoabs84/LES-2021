

const createDashboard = () => {

    let data = new Date();
    let dataEditada = `${data.getDate()} / ${data.getMonth()+1} / ${data.getFullYear()}`;

    let conteudo = document.getElementById('conteudo-gerado');
    conteudo.innerHTML = "";

    //pegar dados do paciente
    var xmlhttp = new XMLHttpRequest();

    let nome1, sobrenome1, cpf1, id_exame1;
    let nome2, sobrenome2, cpf2, id_exame2;
    let nome3, sobrenome3, cpf3, id_exame3;
    
    xmlhttp.onload = function(){
        var json = JSON.parse(this.responseText);

        console.log(json);

        document.getElementById('nome_residente').innerHTML = json.nome_residente;

        nome1 = json[0].nome_paciente;
        sobrenome1 = json[0].sobrenome_paciente;
        cpf1 = json[0].cpf_paciente;
        id_exame1 = json[0].id_exame;

        nome2 = json[1].nome_paciente;
        sobrenome2 = json[1].sobrenome_paciente;
        cpf2 = json[1].cpf_paciente;
        id_exame2 = json[1].id_exame;

        nome3 = json[2].nome_paciente;
        sobrenome3 = json[2].sobrenome_paciente;
        cpf3 = json[2].cpf_paciente;
        id_exame3 = json[2].id_exame;
    };

    xmlhttp.open("GET", "/residente/dados", false);
    xmlhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    xmlhttp.send();

    document.title = "Residente - Dashboard";
    let html = `
    
    <div class="cardBox">   <!--Cards de dados-->

                <div class="card">
                    <div>
                        <div class="numbers">??</div>
                        <div class="cardName">Laudos Emitidos <span style="color:#269d8f">Hoje</span></div>
                    </div>
                    <div class="iconBox">
                        <i class="far fa-smile"></i>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">${dataEditada}</div>
                        <div class="cardName">Data de Hoje</div>
                    </div>
                    <div class="iconBox">
                        <i class="far fa-calendar-alt"></i>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">??</div>
                        <div class="cardName">Total de Laudos</div>
                    </div>
                    <div class="iconBox">
                    <i class="fas fa-file-signature"></i>
                    </div>
                </div>

            </div> 

            <div class="details"> <!--Detalhes dos pacientes-->
                <div class="infoTable">
                    <div class="infoTableHeader">
                        <h2>Pacientes</h2>
                        
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <td>Nome</td>
                                <td>Sobrenome</td>
                                <td>CPF</td>
                                
                                <td>Solicitação Exame</td>
                                <td>Laudo</td>
                                
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>${nome1}</td>
                                <td>${sobrenome1}</td>
                                <td>${cpf1}</td>
                                
                                <td><a id="solicitacao_exame" href='#'>Abrir</a></td>
                                <td><a id="laudo" href='/residente/emitir_laudo/${id_exame1}'>Emitir</a></td>
                                
                            </tr>

                            <tr>
                                <td>${nome2}</td>
                                <td>${sobrenome2}</td>
                                <td>${cpf2}</td>
                                
                                <td><a id="solicitacao_exame" href='#'>Abrir</a></td>
                                <td><a id="laudo" href='/residente/emitir_laudo/${id_exame2}'>Emitir</a></td>
                                
                            </tr>
                            <tr>
                                <td>${nome3}</td>
                                <td>${sobrenome3}</td>
                                <td>${cpf3}</td>
                                
                                <td><a id="solicitacao_exame" href='#'>Abrir</a></td>
                                <td><a id="laudo" href='/residente/emitir_laudo/${id_exame3}'>Emitir</a></td>
                                
                            </tr>
                        </tbody>
                    </table>

                </div>

                <div class="recentsViewer">
                    <div class="pacientHeader">
                        <h2>Laudos Emitidos Recentemente</h2>
                    </div>

                    <div class="recentsViewerData">
                        <div class="data" id="1">
                            <span>Jose</span>
                            <span>Silva</span>
                            <span>000.000.000-00</span>
                        </div>
                        <div class="data" id="2">
                            <span>Jose</span>
                            <span>Silva</span>
                            <span>000.000.000-00</span>
                        </div>
                        <div class="data" id="3">
                            <span>Jose</span>
                            <span>Silva</span>
                            <span>000.000.000-00</span>
                        </div>
                    </div>

                </div>
            </div>
    
    `




    conteudo.innerHTML = html;
    
    
}

export default createDashboard;