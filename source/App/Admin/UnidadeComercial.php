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

    public function criar($data)
    {
        echo $this->view->render('Criar',[
            'title' => SITE . " | Cadastro"
        ]);
    }

    public function listarUnidades($data)
    {
        $unidades = (new UnidadeComercialModel())->find()->fetch(true);

        echo $this->view->render('Unidades', [
            'title' => SITE . " | Unidades",
            'unidades' => $unidades
        ]);
    }

    public function visualizarUnidade($data)
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

}

