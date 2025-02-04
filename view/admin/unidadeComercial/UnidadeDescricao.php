<?php $this->layout("../../_theme/theme"); ?>

<?php $this->start('conteudo') ?>

<div class="row justify-content-center">
    <div class="col-md-10 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?= $this->e($unidade->razao_social) ?></h4>
                <div class="row">
                    <div class="col-md-6">
                        <address>
                            <p class="font-weight-bold"><?= $this->e($unidade->nome_fantasia) ?></p>
                            <p>
                                <strong>CNPJ:</strong><?= $this->e($unidade->CNPJ) ?>
                            </p>
                            <p>
                                <strong>CNAE: </strong> <?= $this->e($unidade->CNAE) ?>
                            </p>
                            <p>
                                <strong>CNAE COD: </strong> <?= $this->e($unidade->CNAE_COD) ?>
                            </p>
                            <p>
                                <strong>DATA ABERTURA: </strong> <?= $this->e($unidade->abertura) ?>
                            </p>
                            <p>
                                <strong>CNAE COD: </strong> <?= $this->e($unidade->CNAE_COD) ?>
                            </p>
                        </address>
                    </div>
                    <div class="col-md-6">
                        <address class="text-primary">
                            <p class="font-weight-bold">
                                E-MAIL
                            </p>
                            <p class="font-weight-bold">
                                </strong> <?= $this->e($unidade->email) ?>
                            </p>
                            <br />
                            <p class="font-weight-bold">
                                Telefone
                            </p>
                            <p class="font-weight-bold">
                                <?= $this->e($unidade->telefone) ?>
                            </p>
                        </address>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h4 class="card-title">Endereço</h4>
                <address>
                    <p>
                        <strong>RUA: </strong><?= $this->e($unidade->logradouro) ?>,
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
                        <strong>CRIADO EM: </strong> <?= $this->e($unidade->created_at) ?>
                    </p>
                </address>
            </div>

            <div class="card-footer">
                <div class="row float-right">
                    <a href="<?= url('admin/unidade/listar') ?>" class="btn btn-sm btn-success btn-icon-text mr-1">
                        <i class="mdi mdi-file-check btn-icon-append"></i>
                        Voltar
                    </a>
                    <button type="button" class="btn btn-sm btn-dark btn-icon-text mr-1">
                        <i class="mdi mdi-file-check btn-icon-append"></i>
                        Editar
                    </button>
                    <button type="button" class="btn btn-danger btn-sm btn-icon-text">
                        <i class="mdi mdi-delete"></i>Excluir
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->end() ?>