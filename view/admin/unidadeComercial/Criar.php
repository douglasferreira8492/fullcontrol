<?php $this->layout("../../_theme/theme"); ?>

<?php $this->start('conteudo') ?>
<div class="row justify-content-center  stretch-card">
    <div class="col-md-10" id="menssagem">
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-10 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Cadastrar empresa</h4>
                <form class="forms-sample">
                    <div class="form-group">
                        <div class="form-row align-items-center mb-4">

                            <div class="col-md-6 my-1">
                                <label for="">Pesquisar CNPJ:</label>
                                <input type="text" class="form-control" id="pesquisar-cnpj" placeholder="CNPJ">
                                <button type="submit" class="btn btn-primary mt-2 mb-4" id='button-pesquisar'>Pesquisar</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nomefantasia">Nome Fantasia</label>
                            <input type="text" class="form-control" id="nomefantasia" name="nomefantasia" placeholder="Nome Fantasia">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="razaosocial">Razão social</label>
                            <input type="text" class="form-control" id="razaosocial" name="razaosocial" placeholder="Razão social">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="CNPJ">CNPJ</label>
                            <input type="text" class="mask-cp form-control" id="CNPJ" name="CNPJ" placeholder="CNPJ">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cnaedescricao">CNAE Descricao</label>
                            <input type="text" class="form-control" id="cnaedescricao" name="cnaedescricao" placeholder="CNAE Descricao">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="cnaecodigo">CNAE Código</label>
                            <input type="text" class="form-control" id="cnaecodigo" name="cnaecodigo" placeholder="CNAE Código">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="dataabertura">Data Abertura</label>
                            <input type="date" class="form-control" id="dataabertura" name="dataabertura">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="telefone">Telefone</label>
                            <input type="text" class="form-control phone" id="telefone" name="telefone" placeholder="Telefone">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="E-mail">
                        </div>
                    </div>
                    <h4 class="card-title mb-5">Endereço</h4>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="rua">Rua</label>
                            <input type="text" class="form-control" id="rua" name="rua" placeholder="Rua">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="numero">Numero</label>
                            <input type="email" class="form-control" id="numero" name="numero" placeholder="Numero">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="complemento">Complemento</label>
                            <input type="text" class="form-control" id="complemento" name="complemento" placeholder="Complemento">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="bairro">Bairro</label>
                            <input type="email" class="form-control" id="bairro" name="bairro" placeholder="Bairro">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="municipio">Municipio</label>
                            <input type="text" class="form-control" id="municipio" name="municipio" placeholder="Municipio">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="uf">UF</label>
                            <input type="email" class="form-control" id="uf" name="uf" placeholder="UF">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="municipio">CEP</label>
                            <input type="text" class="mask-cep form-control" id="cep" name="cep" placeholder="cep">
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="row float-right">
                    <button type="submit" class="btn btn-primary mr-2" id='button-cadastrar'>Cadastrar</button>
                    <a href="<?= url('admin/unidade/listar') ?>" class="btn btn-light">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->end() ?>

<?php $this->start('script') ?>
<script>
    // BOTOES FOMULARIO E MENSSAGEM
    let pesquisarInputCNPJ = document.getElementById('pesquisar-cnpj');
    let buttonPesquisar = document.getElementById('button-pesquisar');
    let buttonCadastrar = document.getElementById('button-cadastrar');
    let menssagem = document.getElementById('menssagem');
    let form = document.querySelector('form');

    // CAMPOS DO FORMULARIO
    let nomefantasia = document.getElementById('nomefantasia');
    let razaosocial = document.getElementById('razaosocial');
    let cnpjInput = document.getElementById('CNPJ');
    let cnaedescricao = document.getElementById('cnaedescricao');
    let cnaecodigo = document.getElementById('cnaecodigo');
    let dataabertura = document.getElementById('dataabertura');
    let telefone = document.getElementById('telefone');
    let email = document.getElementById('email');
    let rua = document.getElementById('rua');
    let numero = document.getElementById('numero');
    let complemento = document.getElementById('complemento');
    let bairro = document.getElementById('bairro');
    let municipio = document.getElementById('municipio');
    let uf = document.getElementById('uf');
    let cep = document.getElementById('cep');

    // EVENTOS
    pesquisarInputCNPJ.addEventListener('keyup', (e) => {
        let returnCNPJformat = formatCNPJ(pesquisarInputCNPJ);
        pesquisarInputCNPJ.value = returnCNPJformat;
    });
    buttonPesquisar.addEventListener('click', (e) => {
        e.preventDefault();
        pesquisaCNPJ(removeMascaraCNPJ(pesquisarInputCNPJ.value));
    });
    buttonCadastrar.addEventListener('click', (e) => {
        e.preventDefault();
        cadastrar()
    });

    // FUNÇÃO CADASTRAR
    function cadastrar() {
        menssagem.innerHTML = "";
        nomefantasia.style.borderColor = "";
        razaosocial.style.borderColor = "";

        if (nomefantasia.value == "") {
            criarElementoMenssagem('alert alert-danger', 'Você precisa preencher o Nome Fantasia.', nomefantasia, 'red');
            return false;
        } else if (razaosocial.value == "") {
            criarElementoMenssagem('alert alert-danger', 'Você precisa preencher o Razao Social', razaosocial, 'red');
            return false;
        }

        let formData = new FormData(form);
        let data = {};
        formData.forEach((value, key) => {
            data[key] = value
        });

        let resp = pesquisa_CNPJ_DB();

    }

    // CRIA DIV DE ALERTA E INSERE 
    function criarElementoMenssagem(className, menssagemText, campoBorder = null, colorBorder = null) {
        let div = document.createElement('div');
        div.setAttribute('class', className);
        div.textContent = menssagemText;
        menssagem.appendChild(div);
        if (campoBorder !== null && colorBorder != null) {
            campoBorder.style.borderColor = colorBorder;
        }
    }

    async function pesquisa_CNPJ_DB() {
        let url = 'http://localhost/fullcontrol/admin/unidade/pesquisa/cnpj'
        const rawResponse = await fetch(url, {
            method: "POST",
            headers: {
                'Content-Type': 'Application/json'
            },
            body: JSON.stringify(removeMascaraCNPJ(cnpjInput.value))
        });

        const content = await rawResponse.json();

        console.log(content.status)
        if (content.status == 200) {
            criarElementoMenssagem('alert alert-danger', 'CNPJ já cadastrado', cnpjInput, 'red');
        } else {
            return await true;
        }
    }

    // PESQUISA NO SPEEDIO O CNPJ PARA PREENCHER MAIS RÁPIDO O FORMULARIO
    async function pesquisaCNPJ(cnpj) {

        let url = 'https://api-publica.speedio.com.br/buscarcnpj?cnpj=' + cnpj;
        let options = {
            method: 'GET',
            header: {
                'Content-Type': 'application/json'
            }
        };
        const content = await fetch(url, options);
        const empresa = await content.json();

        // SE NÃO HOUVER ERRO NA REQUISIÇÃO
        if (!empresa.error) {
            let dateAbertura = "";
            let cnpjProcess = "";
            let telefoneProcess = "";
            let cepProcess = "";

            // FAZ OS TESTES SE NÃO VIER VAZIO, SENÃO ESTIVER APLICA AS MASCARAS
            if (empresa['DATA ABERTURA'] != "") {
                dateAbertura = converterData(empresa['DATA ABERTURA']);
            }
            if (empresa.CNPJ != "") {
                cnpjProcess = formatCNPJ(empresa.CNPJ);
            }
            if (empresa.DDD != "" && empresa.TELEFONE != "") {
                telefoneProcess = formatPhone(empresa.DDD + empresa.TELEFONE);
            }
            if (empresa.CEP != "") {
                cepProcess = formatCEP(empresa.CEP);
            }
            // INSERE OS VALORES
            nomefantasia.value = empresa['NOME FANTASIA'];
            razaosocial.value = empresa['RAZAO SOCIAL'];
            cnpjInput.value = cnpjProcess;
            cnaedescricao.value = empresa['CNAE PRINCIPAL DESCRICAO'];
            cnaecodigo.value = empresa['CNAE PRINCIPAL CODIGO'];
            dataabertura.value = dateAbertura;
            telefone.value = telefoneProcess;
            email.value = empresa.EMAIL;
            rua.value = empresa.LOGRADOURO;
            numero.value = empresa.NUMERO;
            complemento.value = empresa.COMPLEMENTO;
            bairro.value = empresa.BAIRRO;
            municipio.value = empresa.MUNICIPIO;
            uf.value = empresa.UF;
            cep.value = cepProcess;
        }
    }
</script>
<?php $this->end() ?>

<!-- BAIRRO:"ITAIM BIBI"
CEP:"04542000"
CNAE PRINCIPAL CODIGO:"4651601"
CNAE PRINCIPAL DESCRICAO:"Comércio atacadista de equipamentos de informática"
CNPJ:"00623904000173"
COMPLEMENTO:"ANDAR 7 E 8 CONJ 71, 72, 81 E 82"
DATA ABERTURA:"12/05/1995"
DDD:"11"
EMAIL:"fiscal@apple.com"
LOGRADOURO:"LEOPOLDO COUTO MAGALHAES JUNIOR"
MUNICIPIO:"São paulo"
NOME FANTASIA:""
NUMERO:"700"
RAZAO SOCIAL:"APPLE COMPUTER BRASIL LTDA"
STATUS:"ATIVA"
TELEFONE:
"55030000"
TIPO LOGRADOURO:"RUA"
UF:"SP -->