<?php
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
$route->get("/","Web:login");                            // PÁGINA DE LOGIN

$route->get("/criar", "Web:create");                     // FORMULARIO PARA CRIAR USER
$route->post("/criar", "Web:create");                     // FORMULARIO PARA CRIAR USER
$route->post("/confirm", "Web:createUserConfirmEmail");  // ENVIA EMAIL E CONFIRMA CODIGO
$route->post("/procura/email", "Web:getEmail");          // UTILIZADO PELO AJAX

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