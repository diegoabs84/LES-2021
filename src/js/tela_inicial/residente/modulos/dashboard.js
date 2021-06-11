

const createDashboard = () => {

    let data = new Date();
    let dataEditada = `${data.getDate()} / ${data.getMonth()+1} / ${data.getFullYear()}`;

    let conteudo = document.getElementById('conteudo-gerado');
    conteudo.innerHTML = "";

    //pegar dados do paciente
    var xmlhttp = new XMLHttpRequest();

    let nome1, cpf1, status1, id_exame1;
    let nome2, cpf2, status2, id_exame2;
    let nome3, cpf3, status3, id_exame3;

    //dados de quem vai ser revisado
    let nomeR1, cpfR1;
    let nomeR2, cpfR2;
    let nomeR3, cpfR3;

    let botao1, botao2, botao3;

    let total_laudos;
    
    xmlhttp.onload = function(){
        var json = JSON.parse(this.responseText);

        console.log(json);

        document.getElementById('nome_residente').innerHTML = json.nome_residente;

        total_laudos = json.total_laudos;

        nome1 = json[0].nome_paciente;
        cpf1 = json[0].cpf_paciente;
        status1 = json[0].status;
        id_exame1 = json[0].id_exame;

        if(json[0].status == "Laudo para Revisar"){
            nomeR1 = "Paciente: " + json[0].nome_paciente;
            cpfR1 = "CPF: " + json[0].cpf_paciente;
            botao1 = "Revisar"
        }else{
            botao1 = "Emitir"
        }

        nome2 = json[1].nome_paciente;
        cpf2 = json[1].cpf_paciente;
        status2 = json[1].status;
        id_exame2 = json[1].id_exame;

        if(json[0].status == "Laudo para Revisar"){
            nomeR2 = "Paciente: " + json[1].nome_paciente;
            cpfR2 = "CPF: " + json[1].cpf_paciente;
            botao2 = "Revisar"
        }else{
            botao2 = "Emitir"
        }

        nome3 = json[2].nome_paciente;
        cpf3 = json[2].cpf_paciente;
        status3 = json[2].status;
        id_exame3 = json[2].id_exame;

        if(json[0].status == "Laudo para Revisar"){
            nomeR3 = "Paciente: " + json[2].nome_paciente;
            cpfR3 = "CPF: " + json[2].cpf_paciente;
            botao3 = "Revisar"
        }else{
            botao3 = "Emitir"
        }

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
                        <div class="numbers">${total_laudos}</div>
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
                                <td>CPF</td>
                                <td>Solicitação Exame</td>
                                <td>Status</td>
                                <td>Laudo</td>
                                
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>${nome1}</td>
                                <td>${cpf1}</td>
                                <td><a id="solicitacao_exame" href='#'>Abrir</a></td>
                                <td><span class="status">${status1}</span></td>
                                <td><a id="laudo" href='/residente/emitir_laudo/${id_exame1}'>${botao1}</a></td>
                                
                            </tr>

                            <tr>
                                <td>${nome2}</td>
                                <td>${cpf2}</td>
                                <td><a id="solicitacao_exame" href='#'>Abrir</a></td>
                                <td><span class="status">${status2}</span></td>
                                <td><a id="laudo" href='/residente/emitir_laudo/${id_exame2}'>${botao2}</a></td>
                                
                            </tr>
                            <tr>
                                <td>${nome3}</td>
                                <td>${cpf3}</td>
                                <td><a id="solicitacao_exame" href='#'>Abrir</a></td>
                                <td><span class="status">${status3}</span></td>
                                <td><a id="laudo" href='/residente/emitir_laudo/${id_exame3}'>${botao3}</a></td>
                                
                            </tr>
                        </tbody>
                    </table>

                </div>

                <div class="recentsViewer">
                    <div class="pacientHeader">
                        <h2>Laudos para Revisão </h2>
                    </div>

                    <div class="recentsViewerData">
                        <div class="data" id="1">
                            <span>${nomeR1}</span>
                            <span></span>
                            <span>${cpfR1}</span>
                        </div>
                        <div class="data" id="2">
                            <span>${nomeR2}</span>
                            <span></span>
                            <span>${cpfR2}</span>
                        </div>
                        <div class="data" id="3">
                            <span>${nomeR3}</span>
                            <span></span>
                            <span>${cpfR3}</span>
                        </div>
                    </div>

                </div>
            </div>
    
    `




    conteudo.innerHTML = html;
    
    
}

export default createDashboard;