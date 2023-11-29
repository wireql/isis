<?php 

session_start();

/*

$router - это экземпляр класса Router, создан в файле Web/router.php где и задаются все маршруты приложения

*/

require_once __DIR__ . '/src/Web/routes.php';

$router->init();

