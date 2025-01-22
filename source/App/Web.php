<?php
namespace Source\App;
use League\Plates\Engine;
use Source\Models\User;
use Source\Support\Email;

class Web
{
    private $view;

    /**
     *  INSTANCIA A VISÃO (PLATES)
     */
    public function __construct()
    {
        $this->view = new Engine(__DIR__."/../../view/","php");
    }

    /**
     *  PAGINA PARA CRIAR USUÁRIO
     */
    public function create(array $data):void
    {
        echo $this->view->render("Create", [
            'title' => SITE . " | Criar",
            'data'  => $data
        ]);
    }

    /**
     *  PAGINA PRARA CONFIRMAR E-MAIL
     */
    public function createUserConfirmEmail(array $data):void
    {
        if($_SERVER["REQUEST_METHOD"] != "POST") header("Location: " . url());
        $data['confirm'] = rand(10000, 99999);
        $message = "Olá {$data['name']}! <br/> Seu código de ativação é <h3>{$data['confirm']}<h3>";
        $subject = "Confirmacao de conta";
        $email = new Email();
        $result = $email->add($data['email'], $data['name'],$subject,$message)->send();
        if($result == false) header("Location: " . url("criar/error"));
        echo $this->view->render("CreateConfirmEmail", [
            'title' => SITE . " | Confirmar e-mail",
            'data'  => $data
        ]);
    }
    /**
     *  FUNÇÃO DE CADASTRA USUÁRIO
     */
    public function createUser(array $data): void
    {
        if($_SERVER["REQUEST_METHOD"] != "POST") header(url());
        $user = new User();
        $user->nome     = $data['name'];
        $user->email    = $data['email'];
        $user->password = password_hash($data['password'],PASSWORD_DEFAULT);
        $user->ativo    = true;
        $user->admin_level = '1';
        try {
            $user->save();
            header("Location: " . url('sucesso'));
        } catch (\Exception $th) {
            header("Location: " . url('falhou'));
        }
    }
    /**
     *  PAGINA DE LOGIN
     */
    public function login(array $data):void
    {
        echo $this->view->render("login",[
            'title' => SITE . " | Login",
            'data'  => $data
        ]);
    }

    /**
     *  PROCURA EMAIL
     */
    public function getEmail(string $email)
    {
        $userEmail = (new User())->find("email = :uemail","uemail={$email}")->fetch(true);
        return isset($userEmail[0]->email) ? $userEmail[0]->email : $userEmail;
    }

    /**
     *  EXIBE ERROS
     */
    public function error(array $data):void
    {
        echo "ERROR: ". $data['errcode'];
    }
}