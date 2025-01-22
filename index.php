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
$route->get("/","Web:login");                          // PÁGINA DE LOGIN
$route->get("/{mess}", "Web:login");                   // LOGIN COM MENSSAGEM
$route->get("/criar", "Web:create");                   // FORMULARIO PARA CRIAR USER
$route->get("/criar/{err}", "Web:create");             // SE DER ERRO AO ENVIAR EMAIL, VOLTA DO CONFIRMAR EMAIL
$route->post("/criar", "Web:createUserConfirmEmail");  // ENVIA EMAIL E CONFIRMA CODIGO
$route->post("/criar/usuario", "Web:createUser");      // INSERE NO BANCO

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