<?php $this->layout("../../_theme/theme"); ?>

<?php $this->start('conteudo') ?>

<div class="row justify-content-center">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="row float-left">
                    <div class="py-3 text-white">
                        <h3 class=""> <i class="mdi mdi-domain menu-icon"></i>&nbspDescrição da unidade</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class=""><?= $this->e($unidade->razao_social) ?></h3>
                        <address>
                            <p>
                                <strong>NOME FANTASIA: </strong><?= $this->e($unidade->nome_fantasia) ?>
                            </p>

                            <?php if ($unidade->CNPJ != ""): ?>
                                <p>
                                    <strong>CNPJ: </strong><?= formataCNPJ($this->e($unidade->CNPJ)) ?>
                                </p>
                            <?php endif; ?>
                            <?php if ($unidade->CPF != ""): ?>
                                <p>
                                    <strong>CPF: </strong><?= formataCPF($this->e($unidade->CPF)) ?>
                                </p>
                            <?php endif; ?>
                            <p>
                                <strong>CNAE: </strong> <?= $this->e($unidade->CNAE) ?>
                            </p>
                            <p>
                                <strong>CNAE COD: </strong> <?= $this->e($unidade->CNAE_COD) ?>
                            </p>
                            <p>
                                <strong>DATA ABERTURA: </strong> <?= formataData($this->e($unidade->abertura)) ?>
                            </p>
                            <p>
                                <strong>CNAE COD: </strong> <?= $this->e($unidade->CNAE_COD) ?>
                            </p>
                        </address>
                    </div>

                    <div class="col-md-6">
                        <h3 class="">CONTATO</h3>
                        <address>
                            <?php if ($this->e($unidade->email) != ""): ?>
                                <p class="font-weight-bold">
                                    E-MAIL
                                </p>
                                <p class="font-weight-bold">
                                    </strong> <?= $this->e($unidade->email) ?>
                                </p>
                                <br />
                            <?php endif; ?>
                            <?php if ($this->e($unidade->telefone) != ""): ?>
                                <p class="font-weight-bold">
                                    Telefone
                                </p>
                                <p class="font-weight-bold">
                                    <?= formataPhone($this->e($unidade->telefone)) ?>
                                </p>
                            <?php endif; ?>
                        </address>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h3 class="mb-3">ENEDEREÇO</h3>
                <address>
                    <p>
                        <strong>RUA: </strong> <?= $this->e($unidade->logradouro) ?>
                    </p>
                    <p>
                        <strong>NUMERO: </strong> <?= $this->e($unidade->numero) ?>
                    </p>
                    <p>
                        <strong>COMPLEMENTO: </strong> <?= $this->e($unidade->complemento) ?>
                    </p>
                    <p>
                        <strong>BAIRRO: </strong> <?= $this->e($unidade->bairro) ?>
                    </p>
                    <p>
                        <strong>MUNICIPIO: </strong> <?= $this->e($unidade->municipio) ?>
                    </p>
                    <p>
                        <strong>UF: </strong> <?= $this->e($unidade->UF) ?>
                    </p>
                    <p>
                        <strong>CEP: </strong> <?= formataCEP($this->e($unidade->cep)) ?>
                    </p>
                    <p>
                        <strong>CRIADO EM: </strong> <?= formataData($this->e($unidade->created_at)) ?>
                    </p>
                </address>
            </div>

            <div class="card-footer">
                <form>
                    <div class="row float-right">
                        <a href="<?= url('admin/unidade/listar') ?>" class="btn btn-sm btn-success btn-icon-text mr-1">
                            <i class="mdi mdi-keyboard-return"></i>
                            Voltar
                        </a>
                        <a href='<?= url("admin/unidade/editar/{$unidade->id_unidade_comercial}") ?>' class="btn btn-sm btn-dark btn-icon-text mr-1">
                            <i class="mdi mdi-file-check btn-icon-append"></i>
                            Editar
                        </a>
                        <a href='<?= url("admin/unidade/delete/{$unidade->id_unidade_comercial}") ?>' class="btn-excluir mr-1 btn btn-danger btn-sm btn-icon-text">
                            <i class="mdi mdi-delete"></i>
                            Excluir
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->end() ?>

<?php $this->start('script') ?>
<script>
    const botoesExcluir = document.querySelectorAll('.btn-excluir');
    // ADICIONA O EVENTO A CADA BOTAO E SE CONFIRMAR EXCLUI
    botoesExcluir.forEach((botao) => {
        botao.addEventListener('click', (e) => {
            e.preventDefault();
            let result = confirm('Deseja excluir?');
            if (result) {
                excluir(botao).then(dados => {
                    if (dados == 200) {
                        window.location.href = base_url('admin/unidade/listar');
                    } else if (dados == 400) {
                        criarElementoMenssagem('alert alert-danger', 'Ocorreu um erro ao excluir!');
                    }
                });
            }
        })
    });

    // EXCLUIR UNIDADE COMERCIAL
    async function excluir(url) {
        const rawResponse = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'Application/json'
            }
        });
        const content = await rawResponse.json();
        if (content.status == 200) {
            return 200;
        } else if (content.status == 400) {
            return 400;
        }
    }

    // CRIA DIV DE ALERTA E INSERE
    function criarElementoMenssagem(className, menssagemText) {
        let divMenssagem = document.querySelector('.menssagem');
        let div = document.createElement('div');
        div.setAttribute('class', className);
        div.textContent = menssagemText;
        divMenssagem.appendChild(div);
        window.scrollTo(0, 0);
    }
</script>

<?php $this->end() ?>