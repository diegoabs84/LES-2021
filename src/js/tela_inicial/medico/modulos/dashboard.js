

const createDashboard = () => {

    let conteudo = document.getElementById('conteudo-gerado');
    conteudo.innerHTML = "";
    let total_pacientes, total_espera;

    let nome1, sobrenome1, cpf1, status1, id_exame1;
    let nome2, sobrenome2, cpf2, status2, id_exame2;
    let nome3, sobrenome3, cpf3, status3, id_exame3;

    //pegar dados do paciente
    var xmlhttp = new XMLHttpRequest();
    
    xmlhttp.onload = function(){
        var json = JSON.parse(this.responseText);

        console.log(json);

        document.getElementById('nome_medico').innerHTML = json.nome_medico;
        total_pacientes = json.total_pacientes;
        total_espera = json.total_espera;

        //só foi para teste
        nome1 = json[0].nome_paciente;
        sobrenome1 = json[0].sobrenome_paciente;
        cpf1 = json[0].cpf_paciente;
        status1 = json[0].status;
        id_exame1 = json[0].id_exame;

        nome2 = json[1].nome_paciente;
        sobrenome2 = json[1].sobrenome_paciente;
        cpf2 = json[1].cpf_paciente;
        status2 = json[1].status;
        id_exame2 = json[1].id_exame;

        nome3 = json[2].nome_paciente;
        sobrenome3 = json[2].sobrenome_paciente;
        cpf3 = json[2].cpf_paciente;
        status3 = json[2].status;
        id_exame3 = json[2].id_exame;
    };
 
    xmlhttp.open("GET", "/medico/dados", false);
    xmlhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    xmlhttp.send(); 

    document.title = "Medico - Dashboard";
    let html = `
    
    <div class="cardBox">   <!--Cards de dados-->

                <div class="card">
                    <div>
                        <div class="numbers">??</div>
                        <div class="cardName">Pacientes Atendidos <span style="color:#269d8f">Hoje</span></div>
                    </div>
                    <div class="iconBox">
                        <i class="far fa-smile"></i>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">${total_espera}</div>
                        <div class="cardName">Pacientes em espera</div>
                    </div>
                    <div class="iconBox">
                        <i class="fas fa-user-injured"></i>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">${total_pacientes}</div>
                        <div class="cardName">Total de Atendimentos</div>
                    </div>
                    <div class="iconBox">
                        <i class="far fa-calendar-alt"></i>
                    </div>
                </div>

            </div> 

            <div class="details"> <!--Detalhes dos pacientes-->
                <div class="infoTable">
                    <div class="infoTableHeader">
                        <h2>Diagnosticar Pacientes</h2>
                        <a href="#" class="btnViewAll">Ver Todos</a>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <td>Nome</td>
                                <td>Sobrenome</td>
                                <td>CPF</td>
                                <td>Status</td>
                                <td>Prontuario</td>
                                <td>Laudo</td>
                                <td>Diagnosticar</td>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>${nome1}</td>
                                <td>${sobrenome1}</td>
                                <td>${cpf1}</td>
                                <td><span class="status">${status1}</span></td>
                                <td><a id="prontuario" href='/prontuario/${cpf1}'>Abrir</a></td>
                                <td><a id="laudo" href='#'>Visualizar</a></td>
                                
                                <!-- se o status for "diagnosticado" não disponibilizar a opção de diagnosticar abaixo -->
                                
                                <td><a id="diagnostico" href='/medico/diagnostico/${id_exame1}'>Realizar</a></td>
                            </tr>

                            <tr>
                                <td>${nome2}</td>
                                <td>${sobrenome2}</td>
                                <td>${cpf2}</td>
                                <td><span class="status">${status2}</span></td>
                                <td><a id="prontuario" href='/prontuario/${cpf2}'>Abrir</a></td>
                                <td><a id="laudo" href='#'>Visualizar</a></td>
                                <td><a id="diagnostico" href='/medico/diagnostico/${id_exame2}'>Realizar</a></td>
                            </tr>
                            <tr>
                                <td>${nome3}</td>
                                <td>${sobrenome3}</td>
                                <td>${cpf3}</td>
                                <td><span class="status">${status3}</span></td>
                                <td><a id="prontuario" href='/prontuario/${cpf3}'>Abrir</a></td>
                                <td><a id="laudo" href='#'>Visualizar</a></td>
                                <td><a id="diagnostico" href='/medico/diagnostico/${id_exame3}'>Realizar</a></td>
                            </tr>
                        </tbody>
                    </table>

                </div>

                <div class="recentsViewer">
                    <div class="pacientHeader">
                        <h2>Pacientes Diagnosticados Recentemente</h2>
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