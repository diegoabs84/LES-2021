

const createDashboard = () => {

    //Pega a div onde sera gerado o conteudo e limpa
    let conteudo = document.getElementById('conteudo-gerado');
    conteudo.innerHTML = "";

    let data = new Date();
    let dataEditada = `${data.getDate()} / ${data.getMonth()+1} / ${data.getFullYear()}`;
    let cpf;
    let crm1, nome1, status1;
    let crm2, nome2, status2;
    let crm3, nome3, status3;
    
    //pegar dados do paciente
    var xmlhttp = new XMLHttpRequest();
    
    xmlhttp.onload = function(){
        var json = JSON.parse(this.responseText);
        console.log(json);
        cpf = json.cpf;
        document.getElementById('nome_paciente').innerHTML = json.nome;

        //só foi para teste
        crm1 = json[0].crm;
        nome1 = json[0].nome;
        status1 = json[0].status;

        crm2 = json[1].crm;
        nome2 = json[1].nome;
        status2 = json[1].status;

        crm3 = json[2].crm;
        nome3 = json[2].nome;
        status3 = json[2].status;
    };

    xmlhttp.open("GET", "/paciente/dados", false);
    xmlhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    xmlhttp.send(); 

    //titulo da pagina
    document.title = "Paciente - Dashboard";

    //dados que sao gerados
    let html = `
    
    <div class="cardBox">   <!--Cards de dados-->

                <div class="card">
                    <div>
                        <div class="numbers">${cpf}</div>
                        <div class="cardName"><span style="color:#17b980">CPF</span></div>
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

            <div class="details"> <!--Detalhes do paciente-->
                <div class="infoTable">
                    <div class="infoTableHeader">
                        <h2>Meus Exames</h2>
                        
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <td>Medico Responsavel</td>
                                <td>CRM</td>
                                <td>Status</td>
                                <td>Laudo</td>
                                
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                
                                <td>${nome1}</td>
                                <td>${crm1}</td>
                                <td><span class="status">${status1}</span></td>
                                <td><a id="laudo" href='#'>Visualizar</a></td>
                                
                            </tr>

                            <tr>
                                
                                <td>${nome2}</td>
                                <td>${crm2}</td>
                                <td><span class="status">${status2}</span></td>
                                <td><a id="laudo" href='#'>Visualizar</a></td>
                                
                            </tr>
                            <tr>
                                
                                <td>${nome3}</td>
                                <td>${crm3}</td>
                                <td><span class="status">${status3}</span></td>
                                <td><a id="laudo" href='#'>Visualizar</a></td>
                                
                            </tr>
                        </tbody>
                    </table>

                </div>

                
            </div>
    
    `




    conteudo.innerHTML = html;
    
    
}

export default createDashboard;