<?php $this->layout("../../_theme/theme"); ?>

<?php $this->start('conteudo') ?>
<div class="row justify-content-center">
    <div class="col-lg-10 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Unidade Comercial</h2>
                <a href="<?= url('admin/unidade/criar') ?>" class="btn btn-success btn-sm btn-icon-text float-right">
                    <i class="mdi mdi-plus-circle"></i>
                    Nova Unidade
                </a>
                <p class="card-description">
                    Listando as unidades.
                </p>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Empresa</th>
                                <th>CNPJ</th>
                                <th>Cidade</th>
                                <th>Estado</th>
                                <th scope="2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($unidades as $value): ?>
                                <tr>
                                    <td><?= $this->e($value->id_unidade_comercial) ?></td>
                                    <td><?= $this->e($value->razao_social) ?></td>
                                    <td><?= $this->e($value->CNPJ) ?></td>
                                    <td><?= $this->e($value->municipio) ?></td>
                                    <td><?= $this->e($value->UF) ?></td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm btn-icon-text">
                                            <i class="mdi mdi-delete"></i>Excluir
                                        </button>
                                        <a href="<?= url("admin/unidade/visualizar/{$value->id_unidade_comercial}") ?>" class="btn btn-primary btn-sm btn-icon-text">
                                            <i class="mdi mdi-eye"></i> Visualizar
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->end() ?>