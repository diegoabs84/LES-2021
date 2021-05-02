

const createDashboard = () => {

    //Pega a div onde sera gerado o conteudo e limpa
    let conteudo = document.getElementById('conteudo-gerado');
    conteudo.innerHTML = "";

    let data = new Date();
    let dataEditada = `${data.getDate()} / ${data.getMonth()+1} / ${data.getFullYear()}`;

    //titulo da pagina
    document.title = "Paciente - Dashboard";

    //dados que sao gerados
    let html = `
    
    <div class="cardBox">   <!--Cards de dados-->

                <div class="card">
                    <div>
                        <div class="numbers">000.000.000-00</div>
                        <div class="cardName"><span style="color:#269d8f">CPF</span></div>
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
                                
                                <td>Dr. Silva</td>
                                <td>000.000</td>
                                <td><span class="status">Em Espera</span></td>
                                
                                <td><a id="laudo" href='#'>Visualizar</a></td>
                                
                            </tr>

                            <tr>
                                
                                <td>Dr. Trompete</td>
                                <td>000.000</td>
                                <td><span class="status">Em Espera</span></td>
                                <td><a id="laudo" href='#'>Visualizar</a></td>
                                
                            </tr>
                            <tr>
                                
                                <td>Dr. Ojuara</td>
                                <td>000.000</td>
                                <td><span class="status">Em Espera</span></td>
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