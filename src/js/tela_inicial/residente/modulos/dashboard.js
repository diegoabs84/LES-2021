

const createDashboard = () => {

    let data = new Date();
    let dataEditada = `${data.getDate()} / ${data.getMonth()+1} / ${data.getFullYear()}`;

    let conteudo = document.getElementById('conteudo-gerado');
    conteudo.innerHTML = "";

    //pegar dados do paciente
    var xmlhttp = new XMLHttpRequest();
    
    xmlhttp.onload = function(){
        var json = JSON.parse(this.responseText);
        document.getElementById('nome_residente').innerHTML = json.nome_residente;
    };

    xmlhttp.open("GET", "/residente/dados", false);
    xmlhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    xmlhttp.send();

    document.title = "Residente - Dashboard";
    let html = `
    
    <div class="cardBox">   <!--Cards de dados-->

                <div class="card">
                    <div>
                        <div class="numbers">10</div>
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
                        <div class="numbers">220</div>
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
                                
                                <td>Prontuario</td>
                                <td>Laudo</td>
                                
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>Jose</td>
                                <td>Silva</td>
                                <td>000.000.000-00</td>
                                
                                <td><a id="prontuario" href='#'>Abrir</a></td>
                                <td><a id="laudo" href='#'>Visualizar</a></td>
                                
                            </tr>

                            <tr>
                                <td>Maria</td>
                                <td>Trompete</td>
                                <td>000.000.000-00</td>
                                
                                <td><a id="prontuario" href='#'>Abrir</a></td>
                                <td><a id="laudo" href='#'>Visualizar</a></td>
                                
                            </tr>
                            <tr>
                                <td>Genivaldo</td>
                                <td>Ojuara</td>
                                <td>000.000.000-00</td>
                                
                                <td><a id="prontuario" href='#'>Abrir</a></td>
                                <td><a id="laudo" href='#'>Visualizar</a></td>
                                
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