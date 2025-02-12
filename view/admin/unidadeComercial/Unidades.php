<?php $this->layout("../../_theme/theme"); ?>

<?php $this->start('conteudo') ?>
<div class="menssagem"></div>
<div class="row justify-content-center">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="row float-left">
                    <div class="py-3 text-white">
                        <h2 class=""> <i class="mdi mdi-domain menu-icon"></i>&nbspUnidades</h2>
                    </div>
                </div>
                <div class="row py-3 float-right">
                    <a href="<?= url('admin/unidade/criar') ?>" class="btn btn-success btn-sm btn-icon-text float-right">
                        <i class="mdi mdi-plus-circle"></i>
                        Nova Unidade
                    </a>
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table" id="tabela-unidades">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Empresa</th>
                                <th>CNPJ</th>
                                <th>CPF</th>
                                <th>Telefone</th>
                                <th scope="2">Ações</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th>
                                    <input type="text" class="form-control is-valid" id="search_empresa" name="search_empresa" placeholder="Empresa">
                                </th>
                                <th>
                                    <input type="number" class="form-control is-valid" id="search_cnpj" name="search_cnpj" placeholder="CNPJ">
                                </th>
                                <th>
                                    <input type="number" class="form-control is-valid" id="search_cpf" name="search_cpf" placeholder="CPF">
                                </th>
                                <th></th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($unidades != null): ?>
                                <?php foreach ($unidades as $value): ?>
                                    <tr>

                                        <td><?= $this->e($value->id_unidade_comercial) ?></td>
                                        <td><?= $this->e($value->razao_social) ?></td>
                                        <?php if ($this->e($value->CNPJ) == ""): ?>
                                            <td class="text-center"> --- </td>
                                        <?php else: ?>
                                            <td><?= formataCNPJ($this->e($value->CNPJ)) ?></td>
                                        <?php endif; ?>
                                        <?php if ($this->e($value->CPF) == ""): ?>
                                            <td class="text-center"> --- </td>
                                        <?php else: ?>
                                            <td><?= formataCPF($this->e($value->CPF)) ?></td>
                                        <?php endif; ?>

                                        <?php if ($this->e($value->telefone) == ""): ?>
                                            <td class="text-center"> --- </td>
                                        <?php else: ?>
                                            <td><?= formataPhone($this->e($value->telefone)) ?></td>
                                        <?php endif; ?>
                                        <td>
                                            <a href="<?= url("admin/unidade/visualizar/{$value->id_unidade_comercial}") ?>" class="btn btn-primary btn-sm btn-icon-text">
                                                <i class="mdi mdi-eye"></i> Ver
                                            </a>
                                            <a href='<?= url("admin/unidade/delete/{$value->id_unidade_comercial}") ?>' class="btn-excluir mr-1 btn btn-danger btn-sm btn-icon-text">
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
        let table = $('#tabela-unidades').DataTable({
            language: {
                url: TRADUCAO,
            },
        }); // Filtros por coluna (usando os inputs da primeira linha)
        $('#search_empresa').on('keyup change', function() {
            table.column(1).search(this.value).draw(); // Coluna 1 é "Empresa"
        });
        $('#search_cnpj').on('keyup change', function() {
            table.column(2).search(this.value).draw(); // Coluna 2 é "CNPJ"
        });
        $('#search_cpf').on('keyup change', function() {
            table.column(3).search(this.value).draw(); // Coluna 3 é "CPF"
        });
    });

    // PEGA TODOS OS BOTOES DE EXCLUIR
    const botoesExcluir = document.querySelectorAll('.btn-excluir');
    // ADICIONA O EVENTO A CADA BOTAO E SE CONFIRMAR EXCLUI
    botoesExcluir.forEach((botao) => {
        botao.addEventListener('click', (e) => {
            e.preventDefault();
            let result = confirm('Deseja excluir?');
            if (result) {
                const linha = e.target.closest('tr');
                linha.remove();
                excluir(botao).then(dados => {
                    if (dados == 200) {
                        criarElementoMenssagem('alert alert-success', 'Unidade excluída com sucesso!');
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