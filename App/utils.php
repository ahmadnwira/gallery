<?php
    function render($name, $data=[])
    {
        extract($data);
        return require __DIR__ . "/html/{$name}.template.php";
    }

    function redirect($url)
    {
        header('Location: ' . $url);
        exit();
    }

    function  redirect_flash($url, $msg){
        session_start();
        $_SESSION['msg'] = $msg;
        redirect($url);
    }