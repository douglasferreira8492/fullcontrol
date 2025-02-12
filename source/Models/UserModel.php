<?php
namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class UserModel extends DataLayer{

    public function __construct()
    {
        parent::__construct('users',['nome','email','password','ativo','admin_level'],'idusers');
    }

}