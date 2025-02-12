<?php $this->layout("../../_theme/theme"); ?>

<?php $this->start('conteudo') ?>

<div class="row justify-content-center">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="row float-left">
                    <div class="py-3 text-white">
                        <h3 class=""> <i class="mdi mdi-account"></i></i>&nbspInformações do usuário</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="mb-3"><?= $this->e($usuario->nome) ?></h2>
                        <address>
                            <p>
                                <strong>E-mail: </strong><?= $this->e($usuario->email) ?>
                            </p>

                            <?php if ($usuario->ativo): ?>
                                <p>
                                    <strong>Ativo:</strong> <label class="badge badge-success">Sim</label></td>
                                </p>
                            <?php else: ?>
                                <p>
                                    <strong>Ativo:</strong> <label class="badge badge-success">Não</label></td>
                                </p>
                            <?php endif; ?>
                            <p>
                                <strong>Nível:</strong> <label class="badge badge-warning"><?= $this->e($usuario->admin_level) ?></label>
                            </p>
                            <p>
                                <strong>Criado em: </strong> <?= formataData($this->e($usuario->created_at)) ?>
                            </p>
                            <?php if ($usuario->deleted_at): ?>
                                <p>
                                    <strong>Nível:</strong> <label class="badge badge-warning"><?= $this->e($usuario->admin_level) ?></label>
                                </p>
                            <?php endif; ?>
                        </address>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <form>
                    <div class="row float-right">
                        <a href="<?= url('admin/usuario/listar') ?>" class="btn btn-sm btn-success btn-icon-text mr-1">
                            <i class="mdi mdi-keyboard-return"></i>
                            Voltar
                        </a>
                        <a href='<?= url("admin/usuario/editar/{$usuario->idusers}") ?>' class="btn btn-sm btn-dark btn-icon-text mr-1">
                            <i class="mdi mdi-file-check btn-icon-append"></i>
                            Editar
                        </a>
                        <a href='<?= url("admin/unidade/delete/{$usuario->idusers}") ?>' class="btn-excluir mr-1 btn btn-danger btn-sm btn-icon-text">
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
    // const botoesExcluir = document.querySelectorAll('.btn-excluir');
    // // ADICIONA O EVENTO A CADA BOTAO E SE CONFIRMAR EXCLUI
    // botoesExcluir.forEach((botao) => {
    //     botao.addEventListener('click', (e) => {
    //         e.preventDefault();
    //         let result = confirm('Deseja excluir?');
    //         if (result) {
    //             excluir(botao).then(dados => {
    //                 if (dados == 200) {
    //                     window.location.href = base_url('admin/unidade/listar');
    //                 } else if (dados == 400) {
    //                     criarElementoMenssagem('alert alert-danger', 'Ocorreu um erro ao excluir!');
    //                 }
    //             });
    //         }
    //     })
    // });

    // // EXCLUIR UNIDADE COMERCIAL
    // async function excluir(url) {
    //     const rawResponse = await fetch(url, {
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'Application/json'
    //         }
    //     });
    //     const content = await rawResponse.json();
    //     if (content.status == 200) {
    //         return 200;
    //     } else if (content.status == 400) {
    //         return 400;
    //     }
    // }

    // // CRIA DIV DE ALERTA E INSERE
    // function criarElementoMenssagem(className, menssagemText) {
    //     let divMenssagem = document.querySelector('.menssagem');
    //     let div = document.createElement('div');
    //     div.setAttribute('class', className);
    //     div.textContent = menssagemText;
    //     divMenssagem.appendChild(div);
    //     window.scrollTo(0, 0);
    // }
</script>

<?php $this->end() ?>