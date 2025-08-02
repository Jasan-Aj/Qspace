<?php 
    const BASE_PATH = __DIR__.'/../';
    
    require BASE_PATH.('Core/function.php');
    require base_path('Core/Router.php');
    require base_path('Core/Database.php');
    require base_path('Core/Validation.php');
    require base_path('Core/Authenticator.php');

    session_start();

    $router = new Router();

    require base_path('Core/routes.php');

    $url = parse_url($_SERVER['REQUEST_URI'])['path'];
    $method = isset($_POST['__method']) ? $_POST['__method'] : $_SERVER['REQUEST_METHOD'] ;
    $router->route($url,$method);
?>