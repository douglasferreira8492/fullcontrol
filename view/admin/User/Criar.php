<?php $this->layout("../../_theme/theme"); ?>

<?php $this->start('conteudo') ?>
<div class="row justify-content-center">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="row float-left">
                    <div class="py-3 text-white">
                        <h3 class=""> <i class="mdi mdi-account"></i>&nbspCadastrando Usuario</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="forms-sample">
                    <?php $this->insert('Form') ?>
                </form>
            </div>
            <div class="card-footer">
                <div class="row float-right">
                    <button type="submit" class="btn btn-primary mr-2" id='button-save'>
                        <i class="mdi mdi-content-save"></i>
                        Salvar
                    </button>
                    <a href="<?= url('admin/usuario/listar') ?>" class="btn btn-light">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->end() ?>

<?php $this->start('script') ?>
<script>
    // BOTOES FOMULARIO E MENSSAGEM
    let buttonSave = document.getElementById('button-save');
    let menssagem = document.getElementById('menssagem');
    let menssagemForm = document.getElementById('menssagem-form');
    let form = document.querySelector('form');

    // CAMPOS DO FORMULARIO
    let nome = document.getElementById('nome');
    let email = document.getElementById('email');
    let password = document.getElementById('password');
    let passwordConfirm = document.getElementById('passwordConfirm');
    let status1 = document.getElementById('stauts1');
    let status2 = document.getElementById('stauts2');
    let adminLevel = document.getElementById('adminLevel');

    // EVENTOS
    buttonSave.addEventListener('click', (e) => {
        e.preventDefault();
        let resp = [];
        resp.pop();
        menssagem.textContent = "";
        menssagemForm.textContent = "";

        if (
            nome.value == "" || email.value == "" ||
            password.value == "" || passwordConfirm.value == "" ||
            adminLevel.value == "" || password.value != passwordConfirm.value ||
            !password.value.match(/[\W/!@#$%&*]/g) || !password.value.match(/[0-9]/g) ||
            !password.value.match(/[A-Z]/g) || !password.value.match(/[a-z]/g) ||
            !email.value.match(/^[^\s]+@[^\s]+\.[^\s]+$/)
        ) {
            if (name.value == "") {
                resp[1] = "O nome está vazio.";
            }
            if (email.value == "") {
                resp[2] = "O e-mail está vazio.";
            }
            if (password.value == "") {
                resp[3] = "A senha está vazia.";
            }
            if (passwordConfirm.value == "") {
                resp[4] = "A confirmação da senha está vazia.";
            }
            if (adminLevel.value == "") {
                resp[5] = "Precisa informar um nível de administrador.";
            }
            if (password.value != passwordConfirm.value) {
                resp[6] = "As duas senhas não coincidem.";
            }
            if (!password.value.match(/[\W/!@#$%&*]/g)) {
                resp[7] = "A senha precisa ter caracteres especiais.";
            }
            if (!password.value.match(/[0-9]/g)) {
                resp[8] = "A senha precisa ter números.";
            }
            if (!password.value.match(/[A-Z]/g)) {
                resp[9] = "A senha precisa ter letras maiúsculas.";
            }
            if (!password.value.match(/[a-z]/g)) {
                resp[10] = "A senha precisa ter letras minúsculas.";
            }
            if (!email.value.match(/^[^\s]+@[^\s]+\.[^\s]+$/)) {
                resp[11] = "E-mail inválido.";
            }

            // CRIA A LISTA DE ERROS
            let lista = document.createElement('ul');
            lista.style.color = "red";
            resp.forEach((value, key) => {
                let linha = document.createElement('li');
                linha.textContent = value;
                lista.appendChild(linha);
            });

            // EXIBE DENTRO DA DIV
            let div = document.createElement('div');
            div.setAttribute('class', 'alert alert-danger');
            div.textContent = "Revise os dados.";
            menssagem.appendChild(div);
            menssagemForm.appendChild(lista);

        } else {

            buscaEmail().then(data => {
                
                if (data.status == 400)
                {
                    try {
                        cadastrar().then(dados => {
                            if (dados.status == 200) {
                                window.location.href = base_url('admin/usuario/visualizar/' + dados.id);
                            }
                        }).catch(erro => {
                            let div = document.createElement('div');
                            div.setAttribute('class', 'alert alert-danger');
                            div.textContent = "Ocorreu um erro.";
                            menssagem.appendChild(div);
                        });

                    } catch (error) {
                        alert('Ocorreu um erro entre em contato com o administrador');
                        console.error("Error: " + error);
                    }
                } else {
                    let div = document.createElement('div');
                    div.setAttribute('class', 'alert alert-danger');
                    div.textContent = "Esse e-mail já está cadastrado utilize outro.";
                    menssagem.appendChild(div);
                }
            }).catch(erro => {
                console.error( erro);
            });
        }
    });

    async function buscaEmail() {
        let url = base_url("admin/usuario/buscaEmail");
        let options = {
            method: "POST",
            headers: {
                'Content-Type': "Application-Json"
            },
            body: JSON.stringify(email.value)
        }

        const rawResponse = await fetch(url, options);
        const content = await rawResponse.json();
        return content;
    }

    async function cadastrar() {
        let url = base_url("admin/usuario/criar");
        let dataForm = new FormData(form);
        let inputData = {};

        dataForm.forEach((value, key) => {
            inputData[key] = value;
        });

        let options = {
            method: "POST",
            headers: {
                'Content-Type': "Application-Json"
            },
            body: JSON.stringify(inputData)
        }

        const rawResponse = await fetch(url, options);
        const content = await rawResponse.json();
        return content;
    }
</script>
<?php $this->end() ?>