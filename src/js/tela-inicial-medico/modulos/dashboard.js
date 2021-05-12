

const createDashboard = () => {

    let conteudo = document.getElementById('conteudo-gerado');
    conteudo.innerHTML = "";
    document.title = "Medico - Dashboard";
    let html = `
    
    <div class="cardBox">   <!--Cards de dados-->

                <div class="card">
                    <div>
                        <div class="numbers">10</div>
                        <div class="cardName">Pacientes Atendidos <span style="color:#269d8f">Hoje</span></div>
                    </div>
                    <div class="iconBox">
                        <i class="far fa-smile"></i>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">50</div>
                        <div class="cardName">Pacientes em espera</div>
                    </div>
                    <div class="iconBox">
                        <i class="fas fa-user-injured"></i>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">220</div>
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
                                <td>Diagnostico</td>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>Jose</td>
                                <td>Silva</td>
                                <td>000.000.000-00</td>
                                <td><span class="status">Em Espera</span></td>
                                <td><a href='#'>Visualizar</a></td>
                            </tr>

                            <tr>
                                <td>Maria</td>
                                <td>Trompete</td>
                                <td>000.000.000-00</td>
                                <td><span class="status">Em Espera</span></td>
                                <td><a href='#'>Visualizar</a></td>
                            </tr>
                            <tr>
                                <td>Genivaldo</td>
                                <td>Ojuara</td>
                                <td>000.000.000-00</td>
                                <td><span class="status">Em Espera</span></td>
                                <td><a href='#'>Visualizar</a></td>
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