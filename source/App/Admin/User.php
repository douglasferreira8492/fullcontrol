<?php
namespace Source\App\Admin;

use DateTime;
use League\Plates\Engine;
use Source\Models\UserModel;

class User{

    private $view;

    public function __construct()
    {
        $this->view = new Engine(__DIR__ . "/../../../view/admin/User",'php');
    }

    // CRIAR USUARIO
    public function criar(array $data)
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
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
            $user->nome     = $inputData['nome'];
            $user->email    = $inputData['email'];
            $user->password = password_hash($inputData['password'], PASSWORD_DEFAULT);
            $user->ativo    = (int)$inputData['status'];
            $user->admin_level = $inputData['adminLevel'];

            try {
                // Salva o usuário
                $user->save();
                $resp = ['status' => 200, 'message' => 'Usuário cadastrado com sucesso!','id' => $user->idusers];
                echo json_encode($resp);
            } catch (\Throwable $th) {
                // Se ocorrer um erro ao salvar
                $resp = ['status' => 400, 'message' => 'Erro ao salvar o usuário', 'error' => $th->getMessage()];
                echo json_encode($resp);
            }
        } else if ($_SERVER['REQUEST_METHOD'] == "GET")
        {
            echo $this->view->render("Criar", [
                'title' => SITE . " | Criar"
            ]);
        }
    }

    // LISTA TODOS USUÁRIOS
    public function listar(): void
    {
        $users = (new UserModel())->find("deleted_at = :deleted","deleted=false")->fetch(true);
        echo $this->view->render('Users',[
            'title' => SITE . " | Listando usuários",
            'usuarios' => $users
        ]);
    }

    // APRESENTA O CARD COM AS INFORMAÇÕES DAO USUÁRIO
    public function visualizarUsuario($data): void
    {
        $usuario = (new UserModel())->findById((int)$data['id']);
        if ($usuario != null) {
            echo $this->view->render('UsuarioDescricao', [
                'title' => SITE . " | Usuario",
                'usuario' => $usuario
            ]);
        } else {
            header("Location: " . url('admin/usuario/listar'));
        }
    }

    // DELETAR
    public function deletar($data): void
    {
        $resp = [];
        try {
            $usuario = (new UserModel())->findById((int)$data['id']);
            $usuario->deleted_at = (new DateTime())->format('Y-m-d H:i:s');
            $usuario->save();
            $resp = ['status' => 200];
            echo json_encode($resp);
        } catch (\Throwable $th) {
            $resp = ['status' => 200];
            echo json_encode($resp);
        }
    }

    // EDITAR
    public function editar($data): void
    {

        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $resp = [];
            $inputData = json_decode(file_get_contents('php://input'),true);
            if($inputData == null)
            {
                $resp = ['status' => 400];
                echo json_encode($resp);
            }

            try {
                $usuario = (new UserModel())->findById((int)$inputData['idusers']);
                $usuario->nome     = $inputData['nome'];
                $usuario->email    = $inputData['email'];
                if($inputData['password'] != "")
                {
                    $usuario->password = password_hash($inputData['password'], PASSWORD_DEFAULT);
                }
                $usuario->ativo    = (int)$inputData['status'];
                $usuario->admin_level = $inputData['adminLevel'];
                $usuario->save();
                $resp = ['status' => 200];
                echo json_encode($resp);

            } catch (\Throwable $th) {
                $resp = ['status' => 200];
                echo json_encode($resp);
            }

        }else{

            $usuario = (new UserModel())->findById((int)$data['id']);
            if ($usuario != null) {
                echo $this->view->render('Editar', [
                    'title' => SITE . " | Usuario",
                    'usuario' => $usuario
                ]);
            } else {
                header("Location: " . url('admin/usuario/listar'));
            }

        }
        
    }

    // BUSCA E-MAIL
    public function buscaEmail($data): void
    {
        $resp = [];
        // Lê o conteúdo JSON do corpo da requisição
        $inputData = json_decode(file_get_contents('php://input'), true);
        $usuario = (new UserModel())->find("email = :uemail","uemail={$inputData}")->fetch(true);
        if($usuario == null)
        {
            $resp = ['status' => 400];
        }else{
            $resp = ['status' => 200];
        }
        echo json_encode($resp);
    }

    public function buscaEmailEdit($data): void
    {
        $resp = [];
        // Lê o conteúdo JSON do corpo da requisição
        $inputData = json_decode(file_get_contents('php://input'), true);
        $usuario = (new UserModel())->find("email = :uemail", "uemail={$inputData['email']}")->fetch(true);
        if(isset($usuario[0]))
        {
            $usuario = $usuario[0];
        }
        if($usuario != null)
        {
            if ($usuario->idusers == $inputData['idusers'])
            {
                $resp = ['status' => 400];

            }else{
                $resp = ['status' => 200];
            }
        }else{
            $resp = ['status' => 400];
        }     
        echo json_encode($resp);
    }
}