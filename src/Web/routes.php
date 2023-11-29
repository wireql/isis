<?php

require_once __DIR__ . './../Router/Router.php';

$router = new Router();

$router->addPath("/test", function () {
    echo "HELLO";
});

$router->addPath("/lab5", function () {
    require_once __DIR__ . '/../App/Services/Lab5.php';
});

$router->addPath("/", "mainController@index");

$router->addPath("/login", "authController@login");
$router->addPath("/registration", "authController@registration");
$router->addPath("/logout", "authController@logout");

$router->addPath("/index", "mainController@report");

$router->addPath("/datas", "mainController@datas");