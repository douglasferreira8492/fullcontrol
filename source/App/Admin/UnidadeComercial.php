<?php
namespace Source\App\Admin;

use DateTime;
use League\Plates\Engine;
use Source\Models\UnidadeComercialModel;

class UnidadeComercial{

    private $view;

    public function __construct()
    {
        $this->view = new Engine(__DIR__."/../../../view/admin/unidadeComercial","php");
    }

    // CRIAR OU CHAMA A PÁGINA PARA CRIAR DEPENDENDO DA REQUISIÇÃO
    public function criar($data): void
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $inputData = json_decode(file_get_contents('php://input'),true);
            $res = [];
            if($inputData == null)
            {
                $res = ['status' => 404 , 'menssagem' => 'Dados não enviados'];
                return;
            }
            $unidadeComercial = new UnidadeComercialModel();
            try {
                $unidadeComercial->nome_fantasia = $inputData['nomefantasia'];
                $unidadeComercial->razao_social = $inputData['razaosocial'];
                $unidadeComercial->CNPJ = $inputData['CNPJ'];
                $unidadeComercial->CPF = $inputData['CPF'];
                $unidadeComercial->CNAE = $inputData['cnaedescricao'];
                $unidadeComercial->CNAE_COD = $inputData['cnaecodigo'];
                $unidadeComercial->observacao = $inputData['obs'];
                $unidadeComercial->abertura = $inputData['dataabertura'];
                $unidadeComercial->telefone = $inputData['telefone'];
                $unidadeComercial->email = $inputData['email'];
                $unidadeComercial->logradouro = $inputData['rua'];
                $unidadeComercial->numero = $inputData['numero'];
                $unidadeComercial->complemento = $inputData['complemento'];
                $unidadeComercial->bairro = $inputData['bairro'];
                $unidadeComercial->municipio = $inputData['municipio'];
                $unidadeComercial->UF = $inputData['uf'];
                $unidadeComercial->cep = $inputData['cep'];
                $unidadeComercial->deleted_at = "false";
                $unidadeComercial->save();
                $res = ['status' => 200,'menssagem' => 'Cadastrado com successo','id' => $unidadeComercial->id_unidade_comercial];
                echo  json_encode($res);
            } catch (\Throwable $th) {
                $res = ['status' => 400, 'menssagem' => 'Não foi possível cadastrar'];
                echo  json_encode($res);
            }
        }else{
            echo $this->view->render('Criar', [
                'title' => SITE . " | Cadastro"
            ]);
        }
    }

    // DELETA A UNIDADE
    public function delete($data)
    {   
        $res = [];
        if((int)$data['id'] < 0 )
        {
            $res = ['status' => 400 , 'menssagem' => 'Id não válido'];
            echo json_encode($res);
            return;
        }
        try {
            $unidadeComercial = (new UnidadeComercialModel())->findById($data['id']);
            $unidadeComercial->deleted_at = (new DateTime())->format('Y-m-d H:i:s');
            $unidadeComercial->save();
            $res = ['status' => 200];
            echo json_encode($res);
        } catch (\Throwable $th)
        {
            $res = ['status' => 400];
            echo json_encode($res);
        }
    }

    // LISTA UNIDADES ATIVAS
    public function listarUnidades($data): void
    {
        $unidades = (new UnidadeComercialModel())->find('deleted_at = :deleted','deleted=false')->fetch(true);
        echo $this->view->render('Unidades', [
            'title' => SITE . " | Unidades",
            'unidades' => $unidades
        ]);
    }
    
    // APRESENTA O CARD COM AS INFORMAÇÕES DA UNIDADE
    public function visualizarUnidade($data): void
    {
        $unidade = (new UnidadeComercialModel())->findById((int)$data['id']);
        if($unidade != null)
        {
            echo $this->view->render('UnidadeDescricao', [
                'title' => SITE . " | Unidade",
                'unidade' => $unidade
            ]);
        }else{
            header("Location: " . url('admin/unidade/listar'));
        }
    }

    // EDITA A UNIDADE
    public function editarUnidade($data): void
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $resp = [];
            $inputData = json_decode(file_get_contents('php://input'),true);
            $unidadeComercial = (new UnidadeComercialModel())->findById($inputData['id_unidade_comercial']);
            if($unidadeComercial == null)
            {
                $resp = ['status' => 400];
                echo json_encode($resp);
            }else{
                try {
                    $unidadeComercial->nome_fantasia = $inputData['nomefantasia'];
                    $unidadeComercial->razao_social = $inputData['razaosocial'];
                    $unidadeComercial->CNPJ = $inputData['CNPJ'];
                    $unidadeComercial->CPF = $inputData['CPF'];
                    $unidadeComercial->CNAE = $inputData['cnaedescricao'];
                    $unidadeComercial->CNAE_COD = $inputData['cnaecodigo'];
                    $unidadeComercial->observacao = $inputData['obs'];
                    $unidadeComercial->abertura = $inputData['dataabertura'];
                    $unidadeComercial->telefone = $inputData['telefone'];
                    $unidadeComercial->email = $inputData['email'];
                    $unidadeComercial->logradouro = $inputData['rua'];
                    $unidadeComercial->numero = $inputData['numero'];
                    $unidadeComercial->complemento = $inputData['complemento'];
                    $unidadeComercial->bairro = $inputData['bairro'];
                    $unidadeComercial->municipio = $inputData['municipio'];
                    $unidadeComercial->UF = $inputData['uf'];
                    $unidadeComercial->cep = $inputData['cep'];
                    $unidadeComercial->deleted_at = "false";
                    $unidadeComercial->save();
                    $resp = ['status' =>200, 'id' => $unidadeComercial->id_unidade_comercial];
                    echo json_encode($resp);
                } catch (\Throwable $th) {
                    $resp = ['status' => 400,'message' => $th->getMessage()];
                    echo json_encode($resp);
                }
            }

        } else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $unidade = (new UnidadeComercialModel())->findById((int)$data['id']);
            $unidade->CNPJ = formataCNPJ($unidade->CNPJ);
            $unidade->CPF = formataCPF($unidade->CPF);
            $unidade->abertura = (new DateTime($unidade->abertura))->format('Y-m-d');
            $unidade->telefone = formataPhone($unidade->telefone);
            $unidade->cep = formataCEP($unidade->cep);

            if ($unidade != null) {
                echo $this->view->render('Editar', [
                    'title' => SITE . " | Editar Unidade",
                    'unidade' => $unidade
                ]);
            } else {
                header("Location: " . url('admin/unidade/listar'));
            }
        } 
    }

    // PESQUISA CPNJ // UTILIZADA PELO JAVASCRIPT
    public function pesquisarCNPJ($data):void
    {
        $res = [];
        $inputData = json_decode(file_get_contents('php://input'),true);
        if($inputData === null)
        {
            $res = ['status' => 404,'menssagem' => "Envie os dados"];
            echo json_encode($res);
            return;
        }
        $unidadeComercial = (new UnidadeComercialModel())->find("CNPJ = :ucnpj", "ucnpj={$inputData}")->fetch(true);
        if($unidadeComercial == null)
        {
            $res = ['status' => 404, 'menssagem' => "Usuário não encontrado"];
        }else
        {
            $res = ['status' => 200, 'menssagem' => "Usuário encontrado"];
        }
        echo json_encode($res);
    }

    // PESQUISA CPNJ // UTILIZADA PELO JAVASCRIPT
    public function pesquisarCNPJedit($data): void
    {
        $res = [];
        $inputData = json_decode(file_get_contents('php://input'),true);
        if ($inputData === null) {
            $res = ['status' => 400];
            echo json_encode($res);
            return;
        }
        $unidadeComercial = (new UnidadeComercialModel())->find("CNPJ = :ucnpj", "ucnpj={$inputData['CNPJ']}")->fetch(true);
        if (isset($unidadeComercial[0])) {
            $unidadeComercial = $unidadeComercial[0];
        }
        if($unidadeComercial != null)
        {
            if($unidadeComercial->id_unidade_comercial == $inputData['id_unidade_comercial'])
            {
                $res = ['status' => 400];
            }else{
                $res = ['status' => 200];
            }
        }else{
            $res = ['status' => 400];
        }
        echo json_encode($res);
    }

    // PESQUISA CPNJ // UTILIZADA PELO JAVASCRIPT
    public function pesquisarCPFedit($data): void
    {
        $res = [];
        $inputData = json_decode(file_get_contents('php://input'),true);
        if ($inputData === null) {
            $res = ['status' => 400];
            echo json_encode($res);
            return;
        }
        $unidadeComercial = (new UnidadeComercialModel())->find("CPF = :ucpf", "ucpf={$inputData['CPF']}")->fetch(true);
        if (isset($unidadeComercial[0])) {
            $unidadeComercial = $unidadeComercial[0];
        }
        if ($unidadeComercial != null)
        {
            if ($unidadeComercial->id_unidade_comercial == $inputData['id_unidade_comercial'])
            {
                $res = ['status' => 400];
            } else {
                $res = ['status' => 200];
            }
        } else {
            $res = ['status' => 400];
        }
        echo json_encode($res);
    }

    //PESQUISA CPF // UTILIZADA PELO CPF
    public function pesquisarCPF($data): void
    {
        $res = [];
        $inputData = json_decode(file_get_contents('php://input'),true);
        if ($inputData === null) {
            $res = ['status' => 404, 'menssagem' => "Envie os dados"];
            echo json_encode($res);
            return;
        }
        $unidadeComercial = (new UnidadeComercialModel())->find("CPF = :ucpf", "ucpf={$inputData}")->fetch(true);

        if ($unidadeComercial == null) {
            $res = ['status' => 404, 'menssagem' => "Usuário não encontrado"];
        } else {
            $res = ['status' => 200, 'menssagem' => "Usuário encontrado", 'data' => $unidadeComercial];
        }
        echo json_encode($res);
    }

}

