<?php namespace Views\Main;
    
    use Models\Database;

    require __DIR__.'/../utils.php';

    class MainViews
    {
        public static function index()
        {   
            $db = new Database();

            render('index', ['images'=>$db->all('image')]);
        }

        public static function new_img()
        {   
            if($_SERVER['REQUEST_METHOD'] === "POST"){
                
                $db = new Database();
                
                $db->insert('table', $_POST);

                return ;
            }
            render('new_img');
        }
    }