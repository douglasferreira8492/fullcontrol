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