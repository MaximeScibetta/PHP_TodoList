<?php
session_start();
if (!file_exists(DB_INI_FILE) ) {
    die('Le fichier db.ini n´existe pas ! Régler ce problème avant que je m´énèrve');
}

require('configs/routes.php');
$default_route = $routes['default'];
$route_parts = explode('/', $default_route);
$method = $_SERVER['REQUEST_METHOD'];
$a = $_REQUEST['a']??$route_parts[2];
$r = $_REQUEST['r']??$route_parts[1];

if (!in_array($method . '/' . $r . '/' . $a, $routes)) {
    die('Ce que vous cherchez n’est pas ici');
}
$controllerFile = $r . 'Controller.php';
require 'controllers/' . $controllerFile;
$data = call_user_func($a);