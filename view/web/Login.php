<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= url('assets/template/') ?>vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= url('assets/template/') ?>vendors/base/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= url('assets/template/') ?>css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= url('assets/template/') ?>images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <!-- <img src="<?php //url('assets/template/')
                                                ?>images/logo.svg" alt="logo"> -->
                                <h3>Full Control | Login</h3>
                                <hr />
                            </div>
                            <form class="pt-3" method="POST">
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" id="email" placeholder="E-mail" name="email">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" id="password" placeholder="Senha" name="password">
                                </div>
                                <h3 class="mb-5"><small class="text-success" id="text-message-success"></small></h3>
                                <h3 class="mb-5"><small class="text-danger" id="text-message-danger"></small></h3>
                                <div class="mt-4 font-weight-light">
                                    <a href="<?= url('recoverPassword') ?>" class="text-primary">Esqueceu a senha?</a>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Logar</button>
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
    <script src="<?= url('view/web/script/') ?>Login.js"></script>
    <script src="<?= url('assets/template/') ?>vendors/base/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="<?= url('assets/template/') ?>js/off-canvas.js"></script>
    <script src="<?= url('assets/template/') ?>js/hoverable-collapse.js"></script>
    <script src="<?= url('assets/template/') ?>js/template.js"></script>
    <!-- endinject -->
</body>

</html>