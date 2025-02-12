<div class="form-row">
    <input type="hidden" class="form-control" id="id_unidade_comercial" name="id_unidade_comercial" placeholder="Nome Fantasia" value="<?= isset($unidade->id_unidade_comercial) ? $unidade->id_unidade_comercial : "" ?>">
    <div class="form-group col-md-6">
        <label for="nomefantasia"><strong>Nome Fantasia</strong></label>
        <input type="text" class="form-control" id="nomefantasia" name="nomefantasia" placeholder="Nome Fantasia" value="<?= isset($unidade->nome_fantasia) ? $unidade->nome_fantasia : "" ?>">
    </div>
    <div class="form-group col-md-6">
        <label for="razaosocial"><strong>Razão social</strong></label>
        <input type="text" class="form-control" id="razaosocial" name="razaosocial" placeholder="Razão social" value="<?= isset($unidade->razao_social) ? $unidade->razao_social : "" ?>">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="tipo-documento"><strong>Tipo de Documento</strong></label>
        <select id="tipo-documento" class="form-control">
            <option <?php if (isset($unidade->CNPJ) && $unidade->CNPJ != "") echo "selected"; ?> value="cnpj"><strong>CNPJ</strong></option>
            <option <?php if (isset($unidade->CPF) && $unidade->CPF != "") echo "selected"; ?> value="cpf"><strong>CPF</strong></option>
        </select>
    </div>
    <div class="form-group col-md-6">
        <label for="CNPJ"><strong>DOCUMENTO:</strong></label>
        <input type="text" class="mask-cp form-control" id="CNPJ" name="CNPJ" placeholder="CNPJ" value="<?= isset($unidade->CNPJ) ? $unidade->CNPJ : "" ?>">
        <input type="text" class="mask-cpf form-control" id="CPF" name="CPF" placeholder="CPF" value="<?= isset($unidade->CPF) ? $unidade->CPF : "" ?>">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="cnaedescricao"><strong>CNAE Descricao</strong></label>
        <input type="text" class="form-control" id="cnaedescricao" name="cnaedescricao" placeholder="CNAE Descricao" value="<?= isset($unidade->CNAE) ? $unidade->CNAE : "" ?>">
    </div>
    <div class="form-group col-md-6">
        <label for="cnaecodigo"><strong>CNAE Código</strong></label>
        <input type="text" class="form-control" id="cnaecodigo" name="cnaecodigo" placeholder="CNAE Código" value="<?= isset($unidade->CNAE_COD) ? $unidade->CNAE_COD : "" ?>">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="obs"><strong>Observação</strong></label>
        <input type="text" class="form-control" id="obs" name="obs" value="<?= isset($unidade->observacao) ? $unidade->observacao : "" ?>">
    </div>
    <div class="form-group col-md-6">
        <label for="dataabertura"><strong>Data Abertura</strong></label>
        <input type="date" class="form-control" id="dataabertura" name="dataabertura" value="<?= isset($unidade->abertura) ? $unidade->abertura : "" ?>">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="telefone"><strong>Telefone</strong></label>
        <input type="text" class="form-control phone" id="telefone" name="telefone" placeholder="Telefone" value="<?= isset($unidade->telefone) ? $unidade->telefone : "" ?>">
    </div>
    <div class="form-group col-md-6">
        <label for="email"><strong>E-mail</strong></label>
        <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="<?= isset($unidade->email) ? $unidade->email : "" ?>">
    </div>
</div>
<h4 class="card-title mb-5"><strong>Endereço</strong></h4>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="rua"><strong>Rua</strong></label>
        <input type="text" class="form-control" id="rua" name="rua" placeholder="Rua" value="<?= isset($unidade->logradouro) ? $unidade->logradouro : "" ?>">
    </div>
    <div class="form-group col-md-6">
        <label for="numero"><strong>Numero</strong></label>
        <input type="email" class="form-control" id="numero" name="numero" placeholder="Numero" value="<?= isset($unidade->numero) ? $unidade->numero : "" ?>">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="complemento"><strong>Complemento</strong></label>
        <input type="text" class="form-control" id="complemento" name="complemento" placeholder="Complemento" value="<?= isset($unidade->complemento) ? $unidade->complemento : "" ?>">
    </div>
    <div class="form-group col-md-6">
        <label for="bairro"><strong>Bairro</strong></label>
        <input type="email" class="form-control" id="bairro" name="bairro" placeholder="Bairro" value="<?= isset($unidade->bairro) ? $unidade->bairro : "" ?>">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="municipio"><strong>Municipio</strong></label>
        <input type="text" class="form-control" id="municipio" name="municipio" placeholder="Municipio" value="<?= isset($unidade->Municipio) ? $unidade->Municipio : "" ?>">
    </div>
    <div class="form-group col-md-6">
        <label for="uf"><strong>UF</strong></label>
        <input type="email" class="form-control" id="uf" name="uf" placeholder="UF" value="<?= isset($unidade->UF) ? $unidade->UF : "" ?>">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="municipio"><strong>CEP</strong></label>
        <input type="text" class="mask-cep form-control" id="cep" name="cep" placeholder="cep" value="<?= isset($unidade->cep) ? $unidade->cep : "" ?>">
    </div>
</div>