<?php $this->layout("../../_theme/theme"); ?>

<?php $this->start('conteudo') ?>
<div class="row justify-content-center stretch-card">
    <div class="col-md-12" id="menssagem">
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="row float-left">
                    <div class="py-3 text-white">
                        <h3 class=""> <i class="mdi mdi-domain menu-icon"></i>&nbspEditando unidade</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="forms-sample">
                    <?php $this->insert('Form', ['unidade' => $unidade]) ?>
                </form>
            </div>
            <div class="card-footer">
                <div class="row float-right">
                    <button type="submit" class="btn btn-primary mr-2" id='button-save'>
                        <i class="mdi mdi-content-save"></i>
                        Salvar
                    </button>
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
    let buttonSave = document.getElementById('button-save');
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
    let tipoDocumento = document.getElementById('tipo-documento');
    let cpf = document.getElementById('CPF');

    // EVENTOS
    window.addEventListener('load', (e) => {
        selecionaDocumento();
    })
    tipoDocumento.addEventListener('change', (e) => {
        selecionaDocumento();
    });
    buttonSave.addEventListener('click', (e) => {
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
        }
        if (razaosocial.value == "") {
            criarElementoMenssagem('alert alert-danger', 'Você precisa preencher o Razao Social', razaosocial, 'red');
            return false;
        }
        // if (removeMascara(cnpjInput.value) != "") {
        //     if (!validaCNPJ(cnpjInput.value)) {
        //         criarElementoMenssagem('alert alert-danger', 'CNPJ inválido');
        //         return false;
        //     }
        // }
        // if (removeMascara(cpf.value) != "") {
        //     if (!validaCPF(cpf.value)) {
        //         criarElementoMenssagem('alert alert-danger', 'CPF inválido');
        //         return false;
        //     }
        // }
        if (cnpjInput.value == "" && cpf.value == "") {
            criarElementoMenssagem('alert alert-danger', 'Você precisa informar um documento!');
            return false;
        } else {

            if (cnpjInput.value != "") {
                pesquisarCNPJedit().then(dados => {
                    if (dados.status == 400) {
                        console.log(dados.status)
                        envia();
                    } else {
                        criarElementoMenssagem('alert alert-danger', 'Esse CNPJ já está cadastrado.');
                        return false;
                    }
                }).catch(error => {
                    criarElementoMenssagem('alert alert-danger', 'Ocorreu um erro.');
                    return false;
                });
            }

            if (cpf.value != "") {
                pesquisarCPFedit().then(dados => {
                        if (dados.status == 400) {
                            envia();
                        } else {
                            criarElementoMenssagem('alert alert-danger', 'Esse CPF já está cadastrado.');
                            return false;
                        }
                    })
                    .catch(error => {
                        criarElementoMenssagem('alert alert-danger', 'Ocorreu um erro.');
                        return false;
                    });
            }
        }
    }

    async function pesquisarCNPJedit() {
        let url = base_url("admin/unidade/pesquisa/cnpjEdit");
        let dataForm = new FormData(form);
        let data = {};
        dataForm.forEach((value, key) => {
            if (key == 'CNPJ') {
                value = removeMascara(value);
            }
            data[key] = value;
        });
        let options = {
            method: "POST",
            headers: {
                'Content-Type': "Application-Json"
            },
            body: JSON.stringify(data)
        }

        const rawResponse = await fetch(url, options);
        const content = await rawResponse.json();
        return content;
    }

    async function pesquisarCPFedit() {
        let url = base_url("admin/unidade/pesquisa/cpfEdit");
        let dataForm = new FormData(form);
        let data = {};
        dataForm.forEach((value, key) => {
            if (key == 'CPF') {
                value = removeMascara(value);
            }
            data[key] = value;
        });
        let options = {
            method: "POST",
            headers: {
                'Content-Type': "Application-Json"
            },
            body: JSON.stringify(data)
        }

        const rawResponse = await fetch(url, options);
        const content = await rawResponse.json();
        return content;
    }

    // ENVIA PARA FUNÇÃO PHP
    async function envia() {
        let url = base_url('admin/unidade/editar');
        let formData = new FormData(form);
        let data = {};
        formData.forEach((value, key) => {

            if (key == 'CNPJ' || key == 'CPF' || key == 'telefone' || key == 'cep') {
                value = removeMascara(value);
            }
            data[key] = value
        });
        let options = {
            method: 'POST',
            headers: {
                'Content-Type': 'Application/json'
            },
            body: JSON.stringify(data)
        };

        try {
            const rawResponse = await fetch(url, options);
            const content = await rawResponse.json();
            if (content.status == 200) {
                window.location.href = base_url('admin/unidade/visualizar/' + content.id);
            }
        } catch (error) {
            console.error(error);
        }

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
        window.scrollTo(0, 0);
    }
    // MOSTRA OU ESCONDE CAMPOS CNPJ E CPF
    function selecionaDocumento() {
        if (tipoDocumento.value === 'cnpj') {
            cnpjInput.style.display = 'block';
            cpf.style.display = 'none';
            cpf.value = "";

        } else if (tipoDocumento.value === 'cpf') {
            cnpjInput.style.display = 'none';
            cpf.style.display = 'block';
            cnpjInput.value = "";
        }
    }
</script>
<?php $this->end() ?>