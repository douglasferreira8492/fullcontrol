<div class="row justify-content-center stretch-card">
    <div class="col-md-12" id="menssagem">
    </div>
</div>
<div class="form-row">
    <input type="hidden" class="form-control" id="idusers" name="idusers" value="<?= isset($usuario->idusers) ? $usuario->idusers : "" ?>">
    <div class="form-group col-md-6">
        <label for="nome"><strong>Nome</strong></label>
        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="<?= isset($usuario->nome) ? $usuario->nome : "" ?>">
    </div>
    <div class="form-group col-md-6">
        <label for="email"><strong>E-mail</strong></label>
        <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="<?= isset($usuario->email) ? $usuario->email : "" ?>">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="password"><strong>Senha</strong></label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Senha" >
    </div>
    <div class="form-group col-md-6">
        <label for="passwordConfirm"><strong>Confirmar senha</strong></label>
        <input type="password" class="form-control" id="passwordConfirm" name="passwordConfirm" placeholder="Confirmar senha" >
    </div>
</div>
<div class="form-row">
    <div class="form-group">
        <div class="form-check">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="status" id="status1" value="1" checked="">
                Ativo
                <i class="input-helper"></i>
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="status" id="status2" value="0">
                Inativo
                <i class="input-helper"></i></label>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="adminLevel"><strong>Nivel de administrador</strong></label>
        <select class="form-control" id="adminLevel" name="adminLevel">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select>
    </div>
</div>
<div class="col-md-12" id="menssagem-form">
</div>