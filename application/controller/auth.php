<?php
require_once APP . 'model/usersModel.php';
class Auth extends Controller
{
    var $slider_image;

    var $communty_img;
    var $community_name;


    function __construct()
    {
        session_start();
        $this->users = new usersModel();
    }
    public function g()
    {
        echo hash('sha512', 'futurePasswordfyhiju');
    }
    public function index()
    {
        require APP . 'view/news/index.php';
    }
    
    public function login()
    {
        if(isset($_COOKIE['url'])) {
            $url = $_COOKIE['url'];
        }
        else {
            $url = '/';
        }
        if(isset($_POST['data']))
        {
            $user = $this->users->login($_POST['data']);
            if(isset($user['status']) && $user['status'] == 1)
            {
                $type = $user['user']['type'];
                if($type != 'administrator')
                {
                    $_SESSION["user"] = $user['user']['id'];
                    $_SESSION["name"] = $user['user']['name'];
                    header('Location: '.$url);
                }
                else
                {
                    $message = 'username password combination doesnot match';
                }
            }
            else
            {
                $message = $user['message'];
            }
        }
        require APP . 'view/auth/login.php';
    }
    
    public function register()
    {
        if(isset($_POST['data']))
        {
            $user = $this->users->insertData($_POST['data']);
            
            if(isset($user['status']) && $user['status'] == 1)
            {
                header('Location: /auth/login?message=successfully registered');
            }
            else
            {
                $message = $user['message'];
            }
        }
        require APP . 'view/auth/register.php';
    }
    
    public function create()
    {
        $trollsTable = new trollsModel;
        if(isset($_POST['data']))
        {
            $data = $_POST['data'];
            
            $trolls = $trollsTable->insertData($data);
            if($trolls['status'] == 'success')
            {
                header('Location: /news?id='.$trolls['id'].'&message='.$trolls['message'].'&first=yes');
            }
            else
            {
                $message = $trolls['message'];
               // header('Location: /news/create?message='.$trolls['message']);
            }
            
        }
        $trollsPopular = $trollsTable->searchPopular(0,4);
            $trollsLatest = $trollsTable->searchLatest(0,4);
        require APP . 'view/news/create-news.php';
    }
    
    
    public function logout()
    {
        session_destroy();
        if(isset($_COOKIE['url'])) {
            $url = $_COOKIE['url'];
        }
        else {
            $url = '/';
        }
        
        header('Location: '.$url);
    }
    
    public function forgot_password()
    {
        if(isset($_POST['data']))
        {
            $user = $this->users->sendMail($_POST['data']);
            
            $message = $user['message'];
        }
        require APP . 'view/auth/forgot_password.php';
    }

    public function reset_password()
    {
        if(!isset($_SESSION['user']) || $_SESSION['user'] == '' || $_SESSION['user'] == 0)
        {
            header('Location: /auth/login ');
        }
        if(isset($_POST['data']))
        {
            $user = $this->users->resetPassword($_POST['data']);
            
            $message = $user['message'];
        }
        require APP . 'view/auth/reset_password.php';
    }
    
    public function admin()
    {
        if(isset($_COOKIE['url'])) {
            $url = $_COOKIE['url'];
        }
        else {
            $url = '/';
        }
        if(isset($_POST['data']))
        {
            $user = $this->users->login($_POST['data']);
            
            if(isset($user['status']) && $user['status'] == 1)
            {
                $type = $user['user']['type'];
                if($type == 'administrator')
                {
                    $_SESSION["admin"] = $user['user']['id'];
                    $_SESSION["name"] = $user['user']['name'];
                    header('Location: /admin');
                }
            }
            else
            {
                $message = $user['message'];
            }
        }
        require APP . 'view/auth/admin.php';
    }
}
