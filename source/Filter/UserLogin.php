<?php
namespace Source\Filter;
use CoffeeCode\Router\Router;
class UserLogin
{

    /**
     *  REALIZA A VERIFICAÇÃO SE USUÁRIO ESTÁ LOGADO
     */
    public function handle(Router $router)
    {
        if(
            !isset($_SESSION[SESSION_USER])
            || !$_SESSION[SESSION_USER]
            || !(int)$_SESSION[SESSION_USER]->idusers > 0
        ) {
            header("Location: " . url());
            exit;
        }
        return $router;
    }
}
