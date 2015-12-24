<?php
require_once APP . 'model/postsModel.php';
require_once APP . 'model/usersLikesModel.php';
require_once APP . 'model/usersCommentsModel.php';
class Post extends Controller
{
    
    function __construct()
    {
        session_start();
        if(!isset($_SESSION['user']) || $_SESSION['user'] == '' || $_SESSION['user'] == 0)
        {
            header('Location: /auth/login ');
        }
        $this->posts = new postsModel();
        $this->user_likes = new usersLikesModel();
        $this->user_comments = new usersCommentsModel();
    }

    public function create()
    {
        $message = '';
        if(isset($_POST['data']))
        {
            $data = $_POST['data'];
            if(isset($_FILES["image"]["name"]) && $_FILES["image"]["name"] != '')
            {
                $target_dir = URL_DOCUMENT_ROOT . 'public/img/posts/';
                $random_name = rand(1000000,999999) . date("YdHsim"). '_000_'.rand(1000000,9999999);
                $uploadOk = 1;
                $imageFileType = pathinfo(basename($_FILES["image"]["name"]),PATHINFO_EXTENSION);
               $target_file = $target_dir . $random_name . '.' . $imageFileType;
                // Check if image file is a actual image or fake image

                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if($check !== false) {

                    $uploadOk = 1;
                } else {
                    $message.= "File is not an image.";
                    $uploadOk = 0;
                }

                // Check if file already exists
                if (file_exists($target_file)) {
                    $message.= "Sorry, file already exists.";
                    $uploadOk = 0;
                }
                // Check file size
                if ($_FILES["image"]["size"] > 500000000) {
                    $message.= "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                    $message.= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    $message.= "Sorry, your file was not uploaded.";
                    $uploadOk = 0;
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        $message.= "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";

                        $uploadOk = 1;
                    } else {
                        $message.= "Sorry, there was an error uploading your file.";
                        $uploadOk = 0;
                    }
                }
                if($uploadOk == 1)
                {
                    $data['image'] = $random_name . '.' . $imageFileType;
                }   
            }
            $data['user_id'] = $_SESSION['user'];
            $post = $this->posts->insertData($data);
            
            if(isset($post['status']) && $post['status'] == 1)
            {
                header('Location: /post/create?message=Successfully added '.$message);
            }
            else
            {
                $message.= $post['message'];
            }
        }
        if(isset($_GET['message']))
        {
            $message.= $_GET['message'];
        }
        require APP . 'view/forum/new.php';
    }
    public function vote()
    {
        if(isset($_POST['id']))
        {
            $id = $_POST['id'];
            $post = $this->user_likes->voteUp($id);
            echo json_encode($post);
        }
    }
    
    public function index()
    {
        if(!isset($_GET['id']))
        {
            header('Location: /');
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
        require APP . 'view/forum/single.php';
    }
    
    public function comment()
    {
        if(!isset($_GET['id']))
        {
            header('Location: /');
        }
        if(isset($_POST['data']))
        {
            $id = $_GET['id'];
            $data = $_POST['data'];
            $data['post_id'] = $id;
            $comment = $this->user_comments->insertData($data);
            if(isset($comment['status']) && $comment['status'] == 1)
            {
                header('Location: /post/index?id='.$id.'&message=Successfully added');
            }
            else
            {
                $message = $comment['message'];
                header('Location: /post/index?id='.$id.'&message='.$message);
            }
        }
    }
    
    public function close()
    {
        if(!isset($_GET['id']))
        {
            header('Location: /');
        }
            $id = $_GET['id'];
            if(!is_numeric($_GET['id']))
            {
                header('Location: /');
            }
            
            $post = $this->posts->searchCurrentID($id);
            if($post == '' || count($post) < 1)
            {
                header('Location: /');
            }
            if($post['user_id'] != $_SESSION['user'])
            {
                header('Location: /');
            }
            $comment = $this->posts->closePost($id);
            if($comment)
            {
                header('Location: /post/index?id='.$id.'&message=Successfully closed');
            }
            else
            {
                $message = 'Something went wrong';
                header('Location: /post/index?id='.$id.'&message='.$message);
            }
        
    }
    
}
