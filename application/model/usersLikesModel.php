<?php
require_once APP . 'model/helper/database.php';
require_once APP . 'model/helper/extra.php';
class usersLikesModel extends database
{
    function __construct()
    {
       $this->model = 'users_likes';
       $this->extra = new extra();
       $this->database = new database();
    }
    
    public function voteUp($id)
    {
        if(!isset($_SESSION['user']))
        {
            $return['status'] = 0;
            $return['message'] = 'USER NOT LOGGED IN. PLEASE LOG IN';
            $return['data'] = $data;
        }
        
        $data['user_id'] = $_SESSION['user'];
        $data['post_id'] = $id;
        $post = $this->database->fetchRow($this->model, $data);
       
        if(!isset($post) || $post == '')
        {
            $data['liked'] = 1;
            $user = $this->database->insert($this->model, $data);
        }
        else
        {
            $conditions['id'] = $post['id'];
            if($post['liked'] == 1)
            {
                $up['liked'] = 0;
            }
            else
            {
                $up['liked'] = 1;
            }
            $user = $this->database->update($this->model,$up, $conditions);
        }
        
        $query = "SELECT COUNT(*) AS like_count FROM posts p INNER JOIN users_likes ul"
                        . " ON p.id=ul.post_id "
                        . " WHERE p.id='$id' AND liked = 1";
              
        return $this->database->callQuery($query);
     
    }
    
    public function likesCount($postID)
    {
        $query = "SELECT COUNT(*) AS like_count FROM posts p INNER JOIN users_likes ul"
                        . " ON p.id=ul.post_id "
                        . " WHERE p.id='$postID' AND liked = 1";
              
        return $this->database->callQuery($query);
    }
        
}