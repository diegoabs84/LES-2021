

const createDashboard = () => {

    let data = new Date();
    let dataEditada = `${data.getDate()} / ${data.getMonth()+1} / ${data.getFullYear()}`;

    let conteudo = document.getElementById('conteudo-gerado');
    conteudo.innerHTML = "";
    document.title = "Professor - Dashboard";
    let html = `
    
            <div class="cardBox">   <!--Cards de dados-->

                <div class="card">
                    <div>
                        <div class="numbers">000.000</div>
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
                                <td>Dr. Jose</td>
                                <td>Mario</td>
                                <td>000.000.000-00</td>
                                <td><a id="prontuario" href='#'>Abrir</a></td>
                                <td><a id="laudo" href='#'>Visualizar</a></td>
                                
                            </tr>

                            <tr>
                                <td>Dr. Maria</td>
                                <td>Trompete</td>
                                <td>000.000.000-00</td>
                                <td><a id="prontuario" href='#'>Abrir</a></td>
                                <td><a id="laudo" href='#'>Visualizar</a></td>
                                
                            </tr>
                            <tr>
                                <td>Dr. Genivaldo</td>
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
                        <h2>Laudos Abertos Recentemente</h2>
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