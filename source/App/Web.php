<?php
namespace Source\App;
use League\Plates\Engine;
use League\Plates\Template\Data;
use Source\Models\UserModel;
use Source\Support\Email;

class Web
{
    private $view;

    /**
     *  INSTANCIA A VISÃO (PLATES)
     */
    public function __construct()
    {
        $this->view = new Engine(__DIR__."/../../view/web/","php");
    }
    /**
     *  PAGINA PARA CRIAR USUÁRIO
     */

    public function create(array $data)
    {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            // Lê o conteúdo JSON do corpo da requisição
            $inputData = json_decode(file_get_contents('php://input'), true);

            // Verifica se a decodificação foi bem-sucedida
            if ($inputData === null) {
                // Caso não seja válido, retorna erro de JSON malformado
                $resp = ['status' => 400, 'message' => 'Dados JSON inválidos'];
                echo json_encode($resp);
                return;
            }

            // Atribui os dados decodificados às variáveis do usuário
            $user = new UserModel();
            $user->nome     = $inputData['name'];
            $user->email    = $inputData['email'];
            $user->password = password_hash($inputData['password'], PASSWORD_DEFAULT);
            $user->ativo    = true;
            $user->admin_level = "1";

            try {
                // Salva o usuário
                $user->save();
                $resp = ['status' => 200, 'message' => 'Usuário cadastrado com sucesso!'];
                echo json_encode($resp);
            } catch (\Throwable $th) {
                // Se ocorrer um erro ao salvar
                $resp = ['status' => 400, 'message' => 'Erro ao salvar o usuário', 'error' => $th->getMessage()];
                echo json_encode($resp);
            }
        } else if ($_SERVER['REQUEST_METHOD'] == "GET") {
            echo $this->view->render("Create", [
                'title' => SITE . " | Criar",
                'data' => $data
            ]);
        }
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
     *  PAGINA DE LOGIN
     */
    public function login(array $data):void
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $resp = [];
            $inputData = json_decode(file_get_contents('php://input'),true);

            if($inputData === null || $inputData['email'] == "" || $inputData['password'] == "")
            {
                $resp = ['status' => 400,'message'=> 'Dados não recebidos envie novamente.'];
                echo json_encode($resp);
                exit;
            }
            $user = (new UserModel())->find("email = :uemail","uemail={$inputData['email']}")->fetch(true);
            if($user == null)
            {
                $resp = ['status' => 400,'message'=> 'Usuário não encontrado.'];
                echo json_encode($resp);
                exit;
            }else if(count($user) > 0)
            {
                $user = $user[0]->data;
                if(password_verify($inputData['password'],$user->password))
                {
                    $_SESSION[SESSION_USER] = $user;
                    $resp = ['status' => 200, 'message' => 'Logado.'];
                    echo json_encode($resp);
                    exit;
                }else{
                    $resp = ['status' => 400,'message'=> 'Email ou senha inválidos.'];
                    echo json_encode($resp);
                    exit;
                }
            }

        }else if($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            echo $this->view->render("login", [
                'title' => SITE . " | Login",
                'data'  => $data
            ]);
        }
        
    }
   
    /**
     *  LOGOUT
     */
    public function logout()
    {
        $_SESSION[SESSION_USER] = NULL;
        header("Location: " . url());
    }

    /**
     *  PROCURA EMAIL
     */
    public function getEmail(array $data): void
    {
        $callback['data'] = $data;
        $userEmail = (new UserModel())->find("email = :uemail","uemail={$data['email']}")->fetch(true);
        echo json_encode(isset($userEmail[0]->email) ? $userEmail[0]->email : $userEmail);
    }

    /**
     *  RECUPERA SENHA 
     */
    public function recoverPassword($data)
    {
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $resp = [];
            $inputData = json_decode(file_get_contents('php://input'),true);
            if($inputData === null)
            {
                $resp = ['status' => 400,'message' => 'Dados não recebidos'];
                echo json_encode($resp);
                exit;
            }

            $user = (new UserModel())->find("email = :uemail","uemail={$inputData['email']}")->fetch(true);
            
            if($user == null)
            {
                $resp = ['status' => 400, 'message' => 'Esse usuário não está cadastrado.'];
                echo json_encode($resp);
                exit;
            }
            
            try {

                $userUpdate = (new UserModel())->findById($user[0]->idusers);
                $userUpdate->reset_hash = hash('sha256', HASH);
                $userUpdate->save();

                $email = new Email();

                $url   =  url("resetPassword/{$user[0]->idusers}/{$userUpdate->reset_hash}");
                $body  = "Olá {$user[0]->nome},<br/> <a href='$url'> Clique aqui para redefinir a sua senha</a>";

                $email->add($user[0]->email,$user[0]->nome,'Recuperacao de senha',$body)->send();

                $resp = ['status' => 200, 'message' => 'E-mail enviado!'];
                echo json_encode($resp);
                exit;
            } catch (\Throwable $th)
            {
                $resp = ['status' => 400, 'message' => $th->getMessage()];
                echo json_encode($resp);
                exit;
            }

        }else if($_SERVER['REQUEST_METHOD'] == "GET")
        {
            echo $this->view->render('RecoverPassword', [
                'title' => SITE . " | Recuperar senha"
            ]);
        }
        
    }
    /**
     *  RESETAR PASSWORD
     */
    public function resetPassword(array $data):void
    {

        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $resp = [];
            $inputData = json_decode(file_get_contents('php://input'),true);

            try {
                $user = (new UserModel())->findById($inputData['id']);
                $user->password = password_hash($inputData['password'], PASSWORD_DEFAULT);
                $user->reset_hash = '';
                $user->save();
                $resp = ["status" => 200,"message" => "Senha atualizada!"];
                echo json_encode($resp);
            } catch (\Throwable $th) {
                $resp = ["status" => 400, "message" => "Erro ao atualizar."];
                echo json_encode($resp);
            }

        }else if($_SERVER['REQUEST_METHOD'] == "GET")
        {
            if (isset($data['id']) && isset($data['hashCode'])) {
                $user = (new UserModel())->find("idusers = :uid AND reset_hash = :uhash", "uid={$data['id']}&uhash={$data['hashCode']}")->fetch(true);
                if ($user == null) {
                    header("Location: " . url());
                    exit;
                } else {
                    echo $this->view->render('ResetPassword', [
                        'title'    => SITE . " | Atualizar senha",
                        'hashCode' => $data['hashCode'],
                        'id'       => $user[0]->idusers
                    ]);
                    exit;
                }
            } else {
                header("Location: " . url());
            }
        }       
    }
    /**
     *  EXIBE ERROS
     */
    public function error(array $data):void
    {
        echo "ERROR: ". $data['errcode'];
    }
}