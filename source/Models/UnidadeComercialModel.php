<?php
namespace Source\Models;
use CoffeeCode\DataLayer\DataLayer;

class UnidadeComercialModel extends DataLayer{

    public function __construct()
    {
        parent::__construct('unidade_comercial',['nome_fantasia','razao_social'],'id_unidade_comercial',true);
    }

}