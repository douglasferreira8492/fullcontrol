<?php
namespace Source\App\Admin;
use League\Plates\Engine;

class UnidadeComercial{

    private $view;

    public function __construct()
    {
        $this->view = new Engine(__DIR__."/../../../view/admin/unidadeComercial","php");
    }

    public function cadastro($data)
    {
        echo $this->view->render('Cadastro',[
            'title' => SITE . " | Cadastro"
        ]);
    }

    public function unidadeList($data)
    {
        echo $this->view->render('Unidades', [
            'title' => SITE . " | Unidades"
        ]);
    }

}

