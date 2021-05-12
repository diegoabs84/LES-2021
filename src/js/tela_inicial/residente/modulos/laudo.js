
const laudo = () => {

    let conteudo = document.getElementById('conteudo-gerado');
    conteudo.innerHTML = "";
    document.title = "Residente - Laudo";

    let html = `
    
    <div class="container-emitir-laudo">
        <div class="content-box">
            <script type='text/javascript'>
                $(document).ready(function(){
                    $("input[name='cpf_paciente']").blur(function(){
                        var $crm_responsavel = $("input[name='crm_responsavel']");
                        var $diagnostico = $("textarea[name='diagnostico']");
                        var $exame = $("input[name='exame']");

                        $.getJSON('../../controllers/emitir_laudo.php',{
                            cpf_paciente: $( this ).val()
                        },function( json ){
                            $crm_responsavel.val( json.crm_responsavel);
                            $diagnostico.val(json.diagnostico);
                            $exame.val(json.exame);

                            console.log('--> json', json);
                        });
                    });
                });
            </script>
            <div class="container-quadrado">
                <form method="POST" action="/residente/emitir_laudo">
                    <div class="container">
                    <div class="label">
                    <h2 class="titulo">Emitir</h2>

                    <div class="item-cpf">
                        <input type="text" class="form-control" name="cpf_paciente" placeholder="CPF do Paciente"></input>
                    </div>

                    <div class="item-exame">
                        <input type="text" class="form-control" name="exame" placeholder="Exame"></input>
                    </div>

                    <div class="item-diagnostico">
                        <textarea type="text" class="form-control" name="diagnostico" placeholder="Diagnostico"></textarea>
                    </div>

                    <div class="item-laudo">
                        <textarea type="text" class="form-control" name="laudo" placeholder="Laudo"></textarea>
                    </div>

                    <div class="item-crm">
                    <input type="text" class="form-control" name="crm_responsavel" placeholder="CRM">
                    </div>
                    
                    <div class="botao-salvar">
                    <input type="submit" value="Salvar">
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    `;

    conteudo.innerHTML = html;
}


export default laudo;