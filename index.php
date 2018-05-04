<?php
    require __DIR__ . '/vendor/autoload.php';

    $routes = [
        '' =>'Views\Main\MainViews::index',
        'new/image' => 'Views\Main\MainViews::new_img',
        'delete/image' => 'Views\Main\MainViews::delete_img',
<<<<<<< HEAD
        'like' => 'Views\Main\MainViews::like_img',
=======
>>>>>>> 72d5499d81e9eab294ee0add96676d2820023b7f
        'profile' => 'Views\User\UserViews::profile',
        'login' => 'Views\User\UserViews::login',
        'signup' => 'Views\User\UserViews::signup',
        'logout' => 'Views\User\UserViews::logout'
    ];
<<<<<<< HEAD
    $url = trim($_SERVER['REQUEST_URI'], '/');
    $url = explode('?',$url);
    
    if(!isset($routes[$url[0]])){
        http_response_code(404);
        include('my404.php');
        die();
    }
    $route = $routes[$url[0]];
    isset($url[1]) ? $route($url[1]) : $route();
    
=======

    $url = trim($_SERVER['REQUEST_URI'], '/');
    $url = explode('?',$url);
    
    $route = $routes[$url[0]];

    isset($url[1]) ? $route($url[1]) : $route();
>>>>>>> 72d5499d81e9eab294ee0add96676d2820023b7f
