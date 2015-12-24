<?php
require_once APP . 'model/helper/database.php';
require_once APP . 'model/helper/extra.php';
class usersCommentsModel extends database
{
    function __construct()
    {
       $this->model = 'user_comments';
       $this->extra = new extra();
       $this->database = new database();
    }
    
    public function insertData($data)
    {
        $message = '';
            $success = 1;
            if($data['comment'] == '')
            {
                $message.= 'Please enter something in comment<br/>';
                $success = 0;
            }
            
            
            $return = array();
            if($success == 0)
            {
                $return['status'] = $success;
                $return['message'] = $message;
                $return['data'] = $data;
                return $return;
            }
            $data['user_id'] = $_SESSION['user'];
            
            $user = $this->database->insert($this->model, $data);
            if($user)
            {
                $return['status'] = $success;
                $return['message'] = 'Successfully inserted';
            }
            else
            {
                $return['status'] = 0;
                $return['message'] = 'Something went wrong';
                $return['data'] = $data;
            }
            return $return;
    }
    
    
    public function searchAllWithPostID($id)
    {
        $where['post_id'] = $id;
        return $this->database->fetchAll($this->model,$where,'id','DESC');
    }
        
    public function searchCurrentID($id)
    {
        $where = array('id' => $id);
        return $this->database->fetchRow($this->model, $where);
    }
        
    public function deleteComment($id)
    {
        $where['id'] = $id;
        return $this->database->delete($this->model, $where);
    }
        
}