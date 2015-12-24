<?php
require_once APP . 'model/postsModel.php';
class Home extends Controller
{
    var $slider_image;

    var $communty_img;
    var $community_name;


    function __construct()
    {
        session_start();
        $this->posts = new postsModel();
    }

    public function index()
    {
        $posts = $this->posts->searchAll();
        $current = "latest";
        require APP . 'view/index/index.php';
    }
    
    public function search()
    {
        if(!isset($_POST['search']))
        {
            header("Location:/");
        }
         $search = $_POST['search'];
        $posts = $this->posts->searchByPart($search);
        require APP . 'view/index/index.php';
    }
    
}