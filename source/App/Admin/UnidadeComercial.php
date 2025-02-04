<?php
namespace Source\App\Admin;
use League\Plates\Engine;
use Source\Models\UnidadeComercialModel;

class UnidadeComercial{

    private $view;

    public function __construct()
    {
        $this->view = new Engine(__DIR__."/../../../view/admin/unidadeComercial","php");
    }

    public function criar($data): void
    {
        echo $this->view->render('Criar',[
            'title' => SITE . " | Cadastro"
        ]);
    }

    public function listarUnidades($data): void
    {
        $unidades = (new UnidadeComercialModel())->find()->fetch(true);

        echo $this->view->render('Unidades', [
            'title' => SITE . " | Unidades",
            'unidades' => $unidades
        ]);
    }

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

    public function pesquisarCNPJ($data)
    {
        $res = [];
        $inputData = json_decode(file_get_contents('php://input',true));

        if($inputData === null)
        {
            $res = ['status' => '404','menssagem' => "Envie os dados"];
            echo json_encode($res);
            return;
        }
        $unidadeComercial = (new UnidadeComercialModel())->find("CNPJ = :ucnpj", "ucnpj={$inputData}")->fetch(true);

        // echo json_encode($unidadeComercial);
        // return;
        if($unidadeComercial == null)
        {
            $res = ['status' => '404', 'menssagem' => "Usuário não encontrado"];
        }else
        {
            $res = ['status' => '200', 'menssagem' => "Usuário encontrado",'data' => $unidadeComercial];
        }
        echo json_encode($res);
    }

}

