<?php
define("ROOT", "http://localhost/fullcontrol");
define("SITE","Full Control");
define("SESSION_USER",'User');
define('HASH', 'Egxnd3Mtd2l6LXNlcnAiDWhhc2ggZXhlbXBsb3MyBRAAGIAEMgYQABgWGB5Iy1lQHtRdVYvFhwCngBkAEAmAGhAqABnReqAQYwLjE5LjG4AQPIAQD4AQGYAhygAuIWqAIGwgIKEAAYsAMY');

const DATA_LAYER_CONFIG = [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "db_fullcontrol",
    "username" => "root",
    "passwd" => "",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
];

define("EMAIL",[
    'host'     => "smtp.gmail.com",
    'user'     => "casa993.tv1@gmail.com",
    'password' => "hjyd otef mcod eiad",
    'port'     => 465,
    'name'     => "Suport Full Control"
]);

/**
 *  FUNÇAO DE AJUDA
 */

 function url(string $uri = null):string
 {
    if($uri)
    {
        return ROOT. "/{$uri}";
    }
    return ROOT;
}

/**
 *  MASCARAS
 */
function formataCNPJ($cnpj)
{
    $cnpj = substr($cnpj, 0, 18); // Limita o tamanho máximo a 18 caracteres
    $cnpj = preg_replace('/\D/', '', $cnpj); // Remove caracteres não numéricos
    $cnpj = preg_replace('/(\d{2})(\d)/', '$1.$2', $cnpj); // Adiciona ponto após os dois primeiros dígitos
    $cnpj = preg_replace('/(\d{3})(\d)/', '$1.$2', $cnpj); // Adiciona ponto após o terceiro bloco de 3 dígitos
    $cnpj = preg_replace('/(\d{3})(\d)/', '$1/$2', $cnpj); // Adiciona barra após o quarto bloco de 3 dígitos
    $cnpj = preg_replace('/(\d{4})(\d)/', '$1-$2', $cnpj); // Adiciona o traço após os quatro últimos dígitos
    return $cnpj;
}

function formataCPF($cpf)
{
    $cpf = substr($cpf, 0, 14); // Limita o tamanho máximo a 14 caracteres
    $cpf = preg_replace('/\D/', '', $cpf); // Remove caracteres não numéricos
    $cpf = preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpf); // Adiciona pontos e traço na máscara
    return $cpf;
}

function formataPhone($phone)
{
    $phone = substr($phone, 0, 15); // Limita o tamanho máximo a 15 caracteres
    $phone = preg_replace('/\D/', '', $phone); // Remove caracteres não numéricos
    $phone = preg_replace('/^(\d{2})(\d)/', '($1) $2', $phone); // Adiciona parênteses e espaço após o DDD
    $phone = preg_replace('/(\d)(\d{4})$/', '$1-$2', $phone); // Adiciona traço no final
    return $phone;
}

function formataCEP($cep)
{
    $cep = substr($cep, 0, 9); // Limita o tamanho máximo a 9 caracteres
    $cep = preg_replace('/\D/', '', $cep); // Remove caracteres não numéricos
    $cep = preg_replace('/^(\d{5})(\d{3})$/', '$1-$2', $cep); // Adiciona traço após os primeiros cinco dígitos
    return $cep;
}
function formataData($data)
{
    if($data != '')
    {
        $d = new DateTime($data);
        return $d->format('d/m/Y');
    }
    
}