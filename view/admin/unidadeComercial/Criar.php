<?php $this->layout("../../_theme/theme"); ?>

<?php $this->start('conteudo') ?>

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
                                <input type="text" class="form-control" id="inlineFormInputName" placeholder="CNPJ">
                                <button type="submit" class="btn btn-primary mt-2 mb-4">Pesquisar</button>
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
                            <input type="password" class="form-control" id="CNPJ" name="CNPJ" placeholder="CNPJ">
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
                            <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone">
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

                </form>
            </div>
            <div class="card-footer">
                <div class="row float-right">
                    <button type="submit" class="btn btn-primary mr-2">Cadastrar</button>
                    <a href="<?= url('admin/unidade/listar') ?>" class="btn btn-light">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $this->end() ?>