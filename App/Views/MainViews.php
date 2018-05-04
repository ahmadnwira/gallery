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
            session_start();

            if(empty($_SESSION['usr'])){
                redirect_flash('/login', 'You need to signin before sharing your images');
            }

            if($_SERVER['REQUEST_METHOD'] === "POST"){

                if(empty($_POST['caption'])){
                    redirect_flash('/new/image', 'please provide a caption for your image');
                }

                if($_FILES['img']['size'] > 250000){
                    redirect_flash('/new/image', 'maximum allowed size is 2MB');
                }
                
                $tmp_name = $_FILES['img']['tmp_name'];

                if ( (exif_imagetype($tmp_name) !== IMAGETYPE_PNG) && (exif_imagetype($tmp_name) !== IMAGETYPE_JPEG) ) {
                    redirect_flash('/new/image', 'Only a jpeg or png format are accepted');
                }

                $img_name = '/static/img/media/'. date("ih") . basename($_FILES['img']['name']);
                $end_name =  getcwd() . $img_name;

                $paramters = [
                    'title' => $_POST['caption'],
                    'user_id' => $_SESSION['usr'],
                    'created_at'=> date("Y/m/d"),
                    'img' => $img_name
                ];

                if(!move_uploaded_file($_FILES['img']['tmp_name'], $end_name)){
                    redirect_flash('/new/image', 'file - something went wrong please try again later.');
                }

                $db = new Database();
                if(!$db->insert('image', $paramters)){
                    redirect_flash('/new/image', 'something went wrong please try again later.');
                }

                redirect('/profile');
                return ;
            }

            render('new_img');
        }

        public static function delete_img()
        {
            session_start();
            if(!isset($_GET['id'])){
                redirect('/');
            }
            if(empty($_SESSION['usr'])){
                redirect_flash('/login', 'Your not allowed to do take this action.');
            }
            
            $db = new Database();

            $match = sprintf('id=%s and user_id=%s', $_GET['id'], $_SESSION['usr']);

            $img = $db->get('image', $match);
            if($img){
                if(unlink(getcwd() . $img[0]['img']))
                {
                    $db->delete('image', $_GET['id']);
                    redirect_flash('/profile', 'The image was deleted.');
                }
                redirect_flash('/profile', 'something went wrong try again later.');
            }
        }

        public static function like_img()
        {

            if(!isset($_GET['id'])){
                redirect('/');
            }

            session_start();
            if(!isset($_SESSION['usr'])){
                redirect_flash('/login', 'You need to login first.');
            }

            $db = new Database();
            $img = $db->get('image', 'id='.$_GET['id']);
            if(!$img){
                redirect('/');
            }

            $match = sprintf(' usr_id=%s and img_id=%s', $_SESSION['usr'], $img[0]['id']) ;        
            $is_liked = $db->get('likes', $match);
            $val = empty($is_liked) ? 1 : -1;
  
            $params = [
                'usr_id'=>$_SESSION['usr'],
                'img_id' => $img[0]['id']
            ];

            if($val === -1){
                $db->delete('likes', $is_liked[0]['id']);
                $db->update_likes($img[0]['id'], $val);
                redirect('/');
                die();
            }
            if($db->insert('likes', $params)){
                $db->update_likes($img[0]['id'], $val);
                redirect('/');
                die();
            }

            redirect_flash('/', 'failed to like the image');
        }
    }