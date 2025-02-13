<?php $this->layout("../../_theme/theme") ?>

<?php $this->start('conteudo') ?>

<div class="menssagem"></div>
<div class="row justify-content-center">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="row float-left">
                    <div class="py-3 text-white">
                        <h2 class=""> <i class="mdi mdi-account"></i></i>&nbspUsuários</h2>
                    </div>
                </div>
                <div class="row py-3 float-right">
                    <a href="<?= url('admin/usuario/criar') ?>" class="btn btn-success btn-sm btn-icon-text float-right">
                        <i class="mdi mdi-plus-circle"></i>
                        Novo usuario
                    </a>
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table" id="tabela-usuarios">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Ativo</th>
                                <th>Nivel</th>
                                <th scope="2">Ações</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th>
                                    <input type="text" class="form-control is-valid" id="search_nome" name="search_nome" placeholder="Nome">
                                </th>
                                <th>
                                    <input type="email" class="form-control is-valid" id="search_email" name="search_email" placeholder="E-mail">
                                </th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($usuarios != null): ?>
                                <?php foreach ($usuarios as $value): ?>
                                    <tr>
                                        <td><?= $this->e($value->idusers) ?></td>
                                        <td><?= $this->e($value->nome) ?></td>
                                        <td><?= $this->e($value->email) ?></td>
                                        <?php if ($value->ativo): ?>
                                            <td><label class="badge badge-success">Sim</label></td>
                                        <?php else: ?>
                                            <td><label class="badge badge-danger">Não</label></td>
                                        <?php endif; ?>
                                        <td><label class="badge badge-warning"><?= $this->e($value->admin_level) ?></label></td>
                                        <td>
                                            <a href="<?= url("admin/usuario/visualizar/{$value->idusers}") ?>" class="btn btn-primary btn-sm btn-icon-text">
                                                <i class="mdi mdi-eye"></i> Ver
                                            </a>
                                            <a href='<?= url("admin/usuario/delete/{$value->idusers}") ?>' class="btn-excluir mr-1 btn btn-danger btn-sm btn-icon-text">
                                                <i class="mdi mdi-delete"></i>Excluir
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->end() ?>

<?php $this->start('script') ?>

<script>
    $(document).ready(function() {
        let table = $("#tabela-usuarios").DataTable({
            language: {
                url: TRADUCAO
            }
        });
        $("#search_nome").on('keyup change', function() {
            table.column(1).search(this.value).draw();
        });
        $("#search_email").on('keyup change', function() {
            table.column(2).search(this.value).draw();
        });

    });

    let botoes = document.querySelectorAll('.btn-excluir');

    botoes.forEach((botao) => {

        botao.addEventListener('click', (e) => {
            e.preventDefault();
            deletar(botao.href).then(dados => {
                if (dados.status == 200)
                {
                    let linha = e.target.closest('tr');
                    linha.remove();
                    let menssagem = document.getElementById('menssagem');
                    let div = document.createElement('div');
                    div.setAttribute('class', 'alert alert-success');
                    div.textContent = "Usuário excluído com sucesso!";
                    menssagem.appendChild(div);
                }
            }).catch(error => {

            });
        })

    });

    async function deletar(urlDelete) {
        let options = {
            method: 'GET'
        };
        const rawResponse = await fetch(urlDelete, options);
        return rawResponse.json();
    }
</script>

<?php $this->end() ?>