


<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

header("Content-Security-Policy: script-src 'unsafe-eval' 'unsafe-inline' *;");
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: DENY");
header("X-XSS-Protection: 1; mode=block");
header("Strict-Transport-Security: max-age=31536000; includeSubDomains");
header("X-Permitted-Cross-Domain-Policies: none");
header("Referrer-Policy: no-referrer");
header("Feature-Policy: geolocation 'self';");
// header("Expect-CT: max-age=86400, enforce, report-uri=\"https://example.com/ct-report\"");
header("Permissions-Policy: autoplay=(self), camera=(), microphone=()");

date_default_timezone_set('America/Bogota');

require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createUnsafeImmutable('/var/www/html/sipec/'); $dotenv->load();
require_once 'config/db.php';

$controller = 'home';

// Todo esta lógica hara el papel de un FrontController
if(!isset($_REQUEST['c']))
{
    require_once "app/controllers/$controller.controller.php";
    $controller = ucwords($controller) . 'Controller';
    $controller = new $controller;
    $controller->Index();
}
else
{
    // Obtenemos el controlador que queremos cargar
    $controller = strtolower($_REQUEST['c']);
    $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';

    // Instanciamos el controlador
    require_once "app/controllers/$controller.controller.php";
    $controller = ucwords($controller) . 'Controller';
    $controller = new $controller;

    // Llama la accion
    if(is_callable(array( $controller, $accion ) )){
        call_user_func( array( $controller, $accion ) );
    }else{
        header("Location: 404.html");
    }
}