<?php
namespace Source\App\Admin;
use League\Plates\Engine;

class Dashboard{

    private $view;

    public function __construct()
    {
        $this->view = new Engine(__DIR__."/../../../view/admin/","php");
    }

    public function dashboard($data)
    {
        echo $this->view->render('dashboard',[
            'title' => SITE . " | Dashboard"
        ]);
    }

}

