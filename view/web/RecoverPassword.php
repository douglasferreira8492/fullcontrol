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
    <input type="hidden" class="form-control form-control-lg" id="number_confirm" value="<?= $data['confirm'] ?>">
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

                                <h3>Recuperar senha</h3>
                            </div>
                            <h5 class="font-weight-light" id="text-insert-email">Digite o seu e-mail.</h5>
                            <form method="POST" action="" class="pt-3">
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" placeholder="E-mail" name="email" id="email">
                                </div>
                                <small class="text-success" id="text-message-success"></small>
                                <small class="text-danger" id="text-message-danger"></small>
                                <button type="submit" id="button-confirm" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn text-white">Enviar</button>
                                <a style="display:none;" id="button-login" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn text-white" href="<?= url() ?>">Login</a>
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
    <script src="<?= url("view/web/script/") ?>RecoverPassword.js"></script>
    <script src="<?= url("assets/template/") ?>vendors/base/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="<?= url("assets/template/") ?>js/off-canvas.js"></script>
    <script src="<?= url("assets/template/") ?>js/hoverable-collapse.js"></script>
    <script src="<?= url("assets/template/") ?>js/template.js"></script>
    <!-- endinject -->


</body>

</html>