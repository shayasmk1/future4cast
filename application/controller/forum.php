<?php
require_once APP . 'model/postsModel.php';
require_once APP . 'model/usersLikesModel.php';
require_once APP . 'model/usersCommentsModel.php';
class Forum extends Controller
{
    function __construct()
    {
        session_start();
        $this->posts = new postsModel();
        $this->user_likes = new usersLikesModel();
        $this->user_comments = new usersCommentsModel();
    }
    public function latest()
    {
        $posts = $this->posts->searchAll();
        $current = "latest";
        require APP . 'view/index/index.php';
    }
    
    public function trending()
    {
        $posts = $this->posts->searchMostLiked();
        $current = "trending";
        require APP . 'view/index/index.php';
    }
    public function realised()
    {
        $posts = $this->posts->searchRealised();
        $current = "realised";
        require APP . 'view/index/index.php';
    }
    public function theories()
    {
        $posts = $this->posts->searchTheories();
        $current = "theories";
        require APP . 'view/index/index.php';
    }
    public function featured()
    {
        $posts = $this->posts->searchFeatured();
        $current = "featured";
        require APP . 'view/index/index.php';
    }
}