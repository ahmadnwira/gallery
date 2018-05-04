<?php namespace Views\User;
    
    use Models\Database;

    require __DIR__.'/../utils.php';

    class UserViews
    {
        public static function profile()
        {   
            session_start();
            if(empty($_SESSION['usr'])){
                redirect('/login');
            }
            try{
                $db = new Database();
                $images = $db->get('image', sprintf('user_id="%s"', $_SESSION['usr']));
            }

            catch(Exception $e){ /* LOG ERROR */ }

            render('profile', ['images'=>$images]);
        }

        public static function login()
        {
            if($_SERVER['REQUEST_METHOD'] === "POST"){

                if(!empty($_POST['name']) and !empty($_POST['pass'])){

                    $db = new Database();
                    $usr = $db->get('user', sprintf('usr_name="%s"', $_POST['name']));

                    if(password_verify($_POST['pass'], $usr[0]['password'])){
                        session_start();
                        $_SESSION['usr'] = $usr[0]['id'];
                        redirect('profile');
                    }
                }

                redirect_flash('login', 'user name and password do not match');
                return;
            }
            render('login_form');
            return;
        }

        public static function signup()
        {
            if($_SERVER['REQUEST_METHOD'] === "POST"){

                if(empty($_POST['name']) and empty($_POST['pass'])){
                    redirect_flash('/signup', 'username and password are required');
                }
                if(strlen($_POST['pass']) < 3) {
                    redirect_flash('/signup', 'password must be at least four charchters');
                }
                if(strlen($_POST['name']) > 140 ){
                    redirect_flash('/signup', 'username is too long');
                }

                if( $_POST['pass'] != $_POST['confirm'] ){
                    redirect_flash('/signup', 'password doesn\'t match');
                }

                $db = new Database();
                if($db->get('user', sprintf('id="%s"', $_POST['name']))){
                    redirect_flash('/signup', 'this username is taken');
                }

                $paramters = [
                    'usr_name'=>$_POST['name']  ,
                    'password' => password_hash($_POST['pass'], PASSWORD_DEFAULT)
                ];
                
                if($db->insert('user', $paramters)){
                    $usr = $db->get('user', sprintf('usr_name="%s"', $_POST['name']));
                    session_start();
                    $_SESSION['usr'] = $usr[0]['id'];

                    redirect('/');
                }
                redirect_flash('login', 'something went wrong please try again');
                return;
            }
            render('signup_form');
            return;
        }

        public static function logout()
        {
            session_start();
            unset($_SESSION['usr']);
            redirect('/');
        }
    }