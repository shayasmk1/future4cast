<?php
require_once APP . 'model/usersModel.php';
require_once APP . 'model/postsModel.php';
require_once APP . 'model/usersLikesModel.php';
require_once APP . 'model/usersCommentsModel.php';
class Admin extends Controller
{
    function __construct()
    {
        session_start();
        if(!isset($_SESSION['admin']) || $_SESSION['admin'] == '' || $_SESSION['admin'] == 0)
        {
            header('Location: /auth/admin ');
        }
        $this->users = new usersModel();
        $this->posts = new postsModel();
        $this->user_likes = new usersLikesModel();
        $this->user_comments = new usersCommentsModel();
    }
    public function index()
    {
        $userCount = $this->users->getCount();
        $postCount = $this->posts->getPostCount();
        $featuredPostCount = $this->posts->getFeaturedPostCount();
        $postCommentCount = $this->posts->getActivePostCount();
        require APP . 'view/admin/index.php';
    }
    
    public function users()
    {
        $users = $this->users->searchAll();
        require APP . 'view/admin/user-list.php';
    }
    
    public function posts()
    {
        $posts = $this->posts->searchAllPosts();
        require APP . 'view/admin/post-list.php';
    }
    
    public function make_featured()
    {
        if(!isset($_GET['id']))
        {
            header('Location: /');
        }
        $id = $_GET['id'];
        $data['featured'] = 1;
        $post = $this->posts->updateData($data, $id);
        if($post)
        {
            header('Location: /admin/posts?message=post changed to featured');
        }
        else {
            header('Location: /admin/posts?message=Something went wrong');
        }
    }
    
    public function show_post()
    {
        if(!isset($_GET['id']))
        {
            header('Location: /admin');
        }
        
        $postID = $_GET['id'];
        $post = $this->posts->searchCurrentID($postID);
        if($post == '' || count($post) < 1)
        {
            header('Location: /');
        }
        $likes = $this->user_likes->likesCount($postID);
        if($likes == '' || count($likes) == 0)
        {
            $likes['like_count'] = 0;
        }
        
        $comments = $this->user_comments->searchAllWithPostID($postID);
        require APP . 'view/admin/show_post.php';
    }
    
    public function post_close()
    {
        if(!isset($_GET['id']))
        {
            header('Location: /admin');
        }
        $id = $_GET['id'];
        if(!is_numeric($_GET['id']))
        {
            header('Location: /admin');
        }

        $post = $this->posts->searchCurrentID($id);
        if($post == '' || count($post) < 1)
        {
            header('Location: /admin');
        }
        
        $comment = $this->posts->closePost($id);
        if($comment)
        {
            header('Location: /admin/show_post?id='.$id.'&message=Successfully closed');
        }
        else
        {
            $message = 'Something went wrong';
            header('Location: /admin/show_post?id='.$id.'&message='.$message);
        }
        
    }
    
    public function delete_comment()
    {
        if(!isset($_GET['id']))
        {
            header('Location: /admin');
        }
        $id = $_GET['id'];
        if(!is_numeric($_GET['id']))
        {
            header('Location: /admin');
        }

        $comment = $this->user_comments->searchCurrentID($id);
        $postID = $comment['post_id'];
        if($comment == '' || count($comment) < 1)
        {
            header('Location: /admin');
        }
        
        $comment = $this->user_comments->deleteComment($id);
        if($comment)
        {
            header('Location: /admin/show_post?id='.$postID.'&message=Comment Successfully deleted ');
        }
        else
        {
            $message = 'Something went wrong';
            header('Location: /admin/show_post?id='.$postID.'&message='.$message);
        }
    }
    
    public function delete_post()
    {
        if(!isset($_GET['id']))
        {
            header('Location: /admin/posts');
        }
        $id = $_GET['id'];
        if(!is_numeric($_GET['id']))
        {
            header('Location: /admin/posts');
        }

        $post = $this->posts->searchCurrentID($id);
        $postID = $post['post_id'];
        if($post == '' || count($post) < 1)
        {
            header('Location: /admin/posts');
        }
        
        $comment = $this->posts->deletePost($id);
        if($comment)
        {
            header('Location: /admin/posts?message=Post Successfully deleted ');
        }
        else
        {
            $message = 'Something went wrong';
            header('Location: /admin/posts?message='.$message);
        }
    }
}
?>