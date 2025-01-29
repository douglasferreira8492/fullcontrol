<?php
session_start();
require __DIR__ . "/vendor/autoload.php";
use CoffeeCode\Router\Router;

/**
 *  CONFIGURAÇÕES
 */
$route = new Router(ROOT);
$route->namespace('Source\App');

/**
 *  ROTA PRINCIPAL
 */
$route->group(null);
$route->get("/","Web:login");                             // PÁGINA DE LOGIN
$route->post("/", "Web:login");                           // PÁGINA DE LOGIN
$route->get('/logout', "Web:logout");                     // DESLOGA O USUÁRIO
$route->get("/recoverPassword", "Web:recoverPassword");   // RECUPERA A SENHA 
$route->post("/recoverPassword", "Web:recoverPassword");   // RECUPERA A SENHA POST
$route->get("/resetPassword/{id}/{hashCode}", "Web:resetPassword");   //  
$route->post("/resetPassword", "Web:resetPassword");                  // 

$route->get("/criar", "Web:create");                      // FORMULARIO PARA CRIAR USER
$route->post("/criar", "Web:create");                     // FORMULARIO PARA CRIAR USER
$route->post("/confirm", "Web:createUserConfirmEmail");   // ENVIA EMAIL E CONFIRMA CODIGO
$route->post("/procura/email", "Web:getEmail");           // UTILIZADO PELO AJAX

/**
 *  PAINEL DE ADMINISTRAÇÃO
 */
$route->group('admin', middleware: \Source\Filter\UserLogin::class);    // GRUPO ADMIN / APLICA FILTRO DE LOGIN
$route->get('/dashboard', "Admin\Dashboard:dashboard");                 // PÁGINA PRINCIPAL DASHBOARD

/**
 *  ERROR
 */
$route->group("ops");
$route->get("/{errcode}","Web:error");

$route->dispatch();

/**
 *  FUNÇÃO QUE CHAMAR ROTA DE ERRO
 */
if($route->error())
{
    $route->redirect("ops/{$route->error()}");
}