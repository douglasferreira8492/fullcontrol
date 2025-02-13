<?php
use CoffeeCode\Router\Router;
/**
* CONFIGURAÇÕES
*/
$route = new Router(ROOT);
$route->namespace('Source\App');

/**
* ROTA PRINCIPAL
*/
$route->group(null);
$route->get("/","Web:login"); // PÁGINA DE LOGIN
$route->post("/", "Web:login"); // PÁGINA DE LOGIN
$route->get('/logout', "Web:logout"); // DESLOGA O USUÁRIO
$route->get("/recoverPassword", "Web:recoverPassword"); // RECUPERA A SENHA
$route->post("/recoverPassword", "Web:recoverPassword"); // RECUPERA A SENHA POST
$route->get("/resetPassword/{id}/{hashCode}", "Web:resetPassword"); //
$route->post("/resetPassword", "Web:resetPassword"); //

// $route->get("/criar", "Web:create"); // FORMULARIO PARA CRIAR USER
// $route->post("/criar", "Web:create"); // FORMULARIO PARA CRIAR USER
// $route->post("/confirm", "Web:createUserConfirmEmail"); // ENVIA EMAIL E CONFIRMA CODIGO
// $route->post("/procura/email", "Web:getEmail"); // UTILIZADO PELO AJAX

/**
* PAINEL DE ADMINISTRAÇÃO
*/
$route->namespace('Source\App\Admin');
$route->group('admin', middleware: \Source\Filter\UserLogin::class);
$route->get('/dashboard', "Dashboard:dashboard");
// UNIDADE
$route->get('/unidade/criar', "UnidadeComercial:criar");
$route->post('/unidade/criar', "UnidadeComercial:criar");
$route->get('/unidade/listar', "UnidadeComercial:listarUnidades");
$route->get('/unidade/visualizar/{id}', "UnidadeComercial:visualizarUnidade");
$route->get('/unidade/editar/{id}', "UnidadeComercial:editarUnidade");
$route->post('/unidade/editar', "UnidadeComercial:editarUnidade");
$route->post('/unidade/pesquisa/cnpj', "UnidadeComercial:pesquisarCNPJ");
$route->post('/unidade/pesquisa/cnpjEdit', "UnidadeComercial:pesquisarCNPJedit");
$route->post('/unidade/pesquisa/cpfEdit', "UnidadeComercial:pesquisarCPFedit");
$route->post('/unidade/delete/{id}', "UnidadeComercial:delete");
// USUARIO
$route->get('/usuario/listar', "User:listar");
$route->get('/usuario/criar', "User:criar");
$route->get('/usuario/editar/{id}', "User:editar");
$route->post('/usuario/editar/', "User:editar");
$route->get('/usuario/visualizar/{id}', "User:visualizarUsuario");
$route->post('/usuario/criar', "User:criar");
$route->post('/usuario/buscaEmail', "User:buscaEmail");
$route->post('/usuario/buscaEmailEdit', "User:buscaEmailEdit");
$route->get('/usuario/delete/{id}', "User:deletar");

/**
* ERROR
*/
$route->group("ops");
$route->get("/{errcode}","Web:error");

$route->dispatch();

/**
* FUNÇÃO QUE CHAMAR ROTA DE ERRO
*/
if($route->error())
{
$route->redirect("ops/{$route->error()}");
}