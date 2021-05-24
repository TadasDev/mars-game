<?php

include_once '../vendor/autoload.php';
include_once '../config.php';
session_start();
use Core\Router;

$router = new Router();
$router->loadPage();

md5('password'.'salt');