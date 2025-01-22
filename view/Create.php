<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= url("assets/template/") ?>vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= url("assets/template/") ?>vendors/base/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= url("assets/template/") ?>css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= url("assets/template/") ?>images/favicon.png" />
</head>
<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <!-- <img src="<?php //url("assets/template/") 
                                                ?>images/logo.svg" alt="logo"> -->
                                <h3>Cadastrar usuário</h3>
                            </div>
                            <h6 class="font-weight-light">Insira os dados.</h6>
                            <form class="pt-3" method="POST" action="<?= url("criar") ?>">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" placeholder="Nome completo" name="name" id="name">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" placeholder="E-mail" name="email" id="email">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" placeholder="Crie uma senha" name="password" id="password">
                                </div>

                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" placeholder="Confirme a senha" id="password-confirm">
                                </div>
                                <h4 class="mb-5"><small class="font-weight-light text-danger" id="text-message"><?= isset($data['err']) ? "Ocorreu um erro. Verifique seu e-mail" : ""?></small></h4>
                                <div class="mt-3">
                                    <button type="submit" id="button" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn text-white">Cadastrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script>
        let name = document.getElementById("name");
        let email = document.getElementById('email');
        let password = document.getElementById('password');
        let passwordConfirm = document.getElementById('password-confirm');
        let button = document.getElementById('button');
        let textMessage = document.getElementById('text-message');

        button.addEventListener("click", (e) => {
            if (name.value == '' || email.value == '' || password.value == '' || passwordConfirm.value == '') {
                textMessage.textContent = 'Você precisa preencher todos os campos!';
                e.preventDefault()
            }
            if (password.value.length < 8) {
                textMessage.textContent = 'A senha precisa ter no mínimo 8 caracteres!';
                e.preventDefault()
            }
            if (password.value != passwordConfirm.value) {
                textMessage.textContent = 'As duas senhas não são iguais!';
                e.preventDefault()
            }
        });
    </script>
    <script src="<?= url("assets/template/") ?>vendors/base/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="<?= url("assets/template/") ?>js/off-canvas.js"></script>
    <script src="<?= url("assets/template/") ?>js/hoverable-collapse.js"></script>
    <script src="<?= url("assets/template/") ?>js/template.js"></script>
    <!-- endinject -->


</body>
</html>