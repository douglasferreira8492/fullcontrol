<?php $this->layout("../../_theme/theme"); ?>

<?php $this->start('conteudo') ?>
<div class="row justify-content-center">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="row float-left">
                    <div class="py-3 text-white">
                        <h3 class=""> <i class="mdi mdi-account"></i>&nbspEditando Usuario</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="forms-sample">
                    <?php $this->insert('Form', ['usuario' => $usuario]) ?>
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
    let id = document.getElementById('idusers');
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
            adminLevel.value == ""
        ) {
            if (name.value == "") {
                resp[1] = "O nome está vazio.";
            }
            if (email.value == "") {
                resp[2] = "O e-mail está vazio.";
            }
            if (adminLevel.value == "") {
                resp[5] = "Precisa informar um nível de administrador.";
            }

            insereMenssagem(resp);

        } else {

            let testPass = [];
            if (password.value != "") {
                if (password.value != passwordConfirm.value) {
                    testPass[1] = "As duas senhas não coincidem.";
                }
                if (!password.value.match(/[\W/!@#$%&*]/g)) {
                    testPass[2] = "A senha precisa ter caracteres especiais.";
                }
                if (!password.value.match(/[0-9]/g)) {
                    testPass[3] = "A senha precisa ter números.";
                }
                if (!password.value.match(/[A-Z]/g)) {
                    testPass[4] = "A senha precisa ter letras maiúsculas.";
                }
                if (!password.value.match(/[a-z]/g)) {
                    testPass[4] = "A senha precisa ter letras minúsculas.";
                }
                if (!email.value.match(/^[^\s]+@[^\s]+\.[^\s]+$/)) {
                    testPass[5] = "E-mail inválido.";
                }
            }

            if (testPass.length > 0) {
                insereMenssagem(testPass);
            } else {
                buscaEmailEdit().then(data => {  
                    if (data.status == 400)
                    {
                        try {
                            editar().then(dados => {
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
                    console.error(erro);
                });
            }
        }
    });

    async function buscaEmailEdit()
    {
        let url = base_url("admin/usuario/buscaEmailEdit");
        let dataForm = new FormData(form);
        let data = {};
        dataForm.forEach((value,key)=>{
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

    async function editar() {
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

    function insereMenssagem(resp) {
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
    }
</script>
<?php $this->end() ?>