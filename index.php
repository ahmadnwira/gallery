<?php
    require __DIR__ . '/vendor/autoload.php';

    $routes = [
        '' =>'Views\Main\MainViews::index',
        'new/image' => 'Views\Main\MainViews::new_img',
        'profile' => 'Views\User\UserViews::profile',
        'login' => 'Views\User\UserViews::login',
        'signup' => 'Views\User\UserViews::signup',
        'logout' => 'Views\User\UserViews::logout'
    ];

   $uri = $routes[trim($_SERVER['REQUEST_URI'], '/')];
   $uri();
