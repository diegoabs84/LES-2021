

const createDashboard = () => {

    let data = new Date();
    let dataEditada = `${data.getDate()} / ${data.getMonth()+1} / ${data.getFullYear()}`;

    let conteudo = document.getElementById('conteudo-gerado');
    conteudo.innerHTML = "";

    let crm;
    let residente1, paciente1, cpf1, id_laudo1;
    let residente2, paciente2, cpf2, id_laudo2;
    let residente3, paciente3, cpf3, id_laudo3;

    //pegar dados do paciente
    var xmlhttp = new XMLHttpRequest();
    
    xmlhttp.onload = function(){
        var json = JSON.parse(this.responseText);

        console.log(json);

        // json[0][x] - medicos
        // json[1] - residente logado
        // json[2][x] - pacientes
        // json[3][x] - laudos

        crm = json[1].crm;
        document.getElementById('nome_professor').innerHTML = json[1].nome;
        
        id_laudo1 = json[3][0].id_laudo;
        for(var i = 0; i < json[0].length; i++){
            if(json[0][i].crm == json[3][0].crm_laudo){
                residente1 = json[0][i].nome;
                for(var j = 0; j < json[2].length; j++){
                    if(json[2][j].cpf_paciente == json[3][0].cpf_laudo){
                        paciente1 = json[2][j].nome_paciente;
                        cpf1 = json[2][j].cpf_paciente;
                    } 
                }
            }
        }

        id_laudo2 = json[3][1].id_laudo;
        for(var i = 0; i < json[0].length; i++){
            if(json[0][i].crm == json[3][1].crm_laudo){
                residente2 = json[0][i].nome;
                for(var j = 0; j < json[2].length; j++){
                    if(json[2][j].cpf_paciente == json[3][1].cpf_laudo){
                        paciente2 = json[2][j].nome_paciente;
                        cpf2 = json[2][j].cpf_paciente;
                    }
                }
            }
        }
    };
 
    xmlhttp.open("GET", "/professor/dados", false);
    xmlhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    xmlhttp.send(); 

    document.title = "Professor - Dashboard";
    let html = `
    
            <div class="cardBox">   <!--Cards de dados-->

                <div class="card">
                    <div>
                        <div class="numbers">${crm}</div>
                        <div class="cardName"><span style="color:#17b980">CRM</span></div>
                    </div>
                    <div class="iconBox">
                        
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

            </div> 

            <div class="details"> <!--Detalhes dos laudos dos residentes-->
                <div class="infoTable">
                    <div class="infoTableHeader">
                        <h2>Laudos de Residentes</h2>
                        <a href="#" class="btnViewAll">Ver Todos</a>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <td>Residente</td>
                                <td>Paciente</td>
                                <td>CPF</td>
                                <td>Prontuario</td>
                                <td>Laudo</td>
                                
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>${residente1}</td>
                                <td>${paciente1}</td>
                                <td>${cpf1}</td>
                                <td><a id="prontuario" href='#'>Abrir</a></td>
                                <td><a id="laudo" href='/professor/validar_laudo/${id_laudo1}'>Validar</a></td>
                                
                            </tr>

                            <tr>
                                <td>${residente2}</td>
                                <td>${paciente2}</td>
                                <td>${cpf2}</td>
                                <td><a id="prontuario" href='#'>Abrir</a></td>
                                <td><a id="laudo" href='/professor/validar_laudo/${id_laudo2}'>Validar</a></td>
                                
                            </tr>
                            <tr>
                                <td>${residente3}</td>
                                <td>${paciente3}</td>
                                <td>${cpf3}</td>
                                <td><a id="prontuario" href='#'>Abrir</a></td>
                                <td><a id="laudo" href='/professor/validar_laudo/${id_laudo3}'>Validar</a></td>
                                
                            </tr>
                        </tbody>
                    </table>

                </div>

                <div class="recentsViewer">
                    <div class="pacientHeader">
                        <h2>Laudos Validados Recentemente</h2>
                    </div>

                    <div class="recentsViewerData">
                        <div class="data" id="1">
                            <span>Joseph</span>
                            <span>000.000.000-00</span>
                        </div>
                        <div class="data" id="2">
                            <span>Luigi</span>
                            <span>000.000.000-00</span>
                        </div>
                        <div class="data" id="3">
                            <span>Mario</span>
                            <span>000.000.000-00</span>
                        </div>
                    </div>

                </div>
            </div>
    
    `




    conteudo.innerHTML = html;
    
    
}

export default createDashboard;