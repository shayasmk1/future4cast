<?php
require_once APP . 'model/helper/database.php';
require_once APP . 'model/helper/extra.php';
class postsModel extends database
{
    function __construct()
    {
       $this->model = 'posts';
       $this->extra = new extra();
       $this->database = new database();
    }
    
    public function insertData($data)
    {
            $message = '';
            $success = 1;
            if((isset($data['text']) && $data['text'] == '') || ((isset($data['url'])) && $data['url'] == '') || (!isset($data['url']) && !isset($data['text'])))
            {
                $message.= 'Text or url is required<br/>';
                $success = 0;
            }
            if(isset($data['url']))
            {
                if(!filter_var($data['url'], FILTER_VALIDATE_URL)){ 
                    $message.= 'url not valid';
                    $success = 0;
                }
            }
            $return = array();
            if($success == 0)
            {
                $return['status'] = $success;
                $return['message'] = $message;
                $return['data'] = $data;
                return $return;
            }
            
            $data['created_at'] = $data['updated_at'] = date("Y-m-d H:i:s");
            
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
        
        public function login($data)
        {
            $message = '';
            $success = 1;
            if($data['email'] == '')
            {
                $message.= 'Email is required<br/>';
                $success = 0;
            }
            
            if($data['password'] == '')
            {
                $message.= 'Password is required<br/>';
                $success = 0;
            }
            
            $return = array();
            if($success == 0)
            {
                $return['status'] = $success;
                $return['message'] = $message;
                return $return;
            }
            
            $email['email'] = $data['email'];
            $user = $this->database->fetchRow($this->model, $email);
            if(hash('sha512', $data['password'].$user['salt']) == $user['password'])
            {
                $return['status'] = $success;
                $return['message'] = 'Login Successfull';
                $return['user'] = $user;
            }
            else {
                $return['status'] = 0;
                $return['message'] = 'username password combination doesnot match';
            }
            return $return;
        }
       
        public function updateData($data, $id)
        {
            $data['updated_at'] = date('Y-m-d H:i:s');
            $conditions['id'] = $id;
            return $this->database->update($this->model,$data, $conditions);
        }
        
        public function searchCurrentID($id)
        {
            $where = array('id' => $id);
            return $this->database->fetchRow($this->model, $where);
        }
        
        public function searchAll()
        {
            $query = "SELECT * FROM(SELECT p.*,COUNT(*) AS like_count FROM posts p INNER JOIN users_likes ul"
                    . " ON p.id=ul.post_id WHERE liked = 1 GROUP BY p.id "
                    . " UNION ALL "
                    . " SELECT p.*, 0 AS like_count FROM posts p WHERE id NOT IN (SELECT post_id FROM users_likes WHERE liked = 1 GROUP BY post_id)) AS t ORDER BY CAST(t.`id` AS SIGNED INTEGER) DESC LIMIT 0,50";
             
            return $this->database->callQuery($query);
        }
        
        public function searchMostLiked()
        {
            $query = "SELECT * FROM(SELECT p.*,COUNT(*) AS like_count FROM posts p INNER JOIN users_likes ul"
                    . " ON p.id=ul.post_id WHERE liked = 1 GROUP BY p.id "
                    . " UNION ALL "
                    . " SELECT p.*, 0 AS like_count FROM posts p WHERE id NOT IN (SELECT post_id FROM users_likes WHERE liked = 1 GROUP BY post_id)) AS t ORDER BY CAST(t.`like_count` AS SIGNED INTEGER) DESC LIMIT 0,50";
                
            return $this->database->callQuery($query);
        }
        
        public function searchRealised()
        {
            $query = "SELECT * FROM(SELECT p.*,COUNT(*) AS like_count FROM posts p INNER JOIN users_likes ul"
                    . " ON p.id=ul.post_id WHERE ul.liked = 1 AND p.realised = 1 GROUP BY p.id "
                    . " UNION ALL "
                    . " SELECT p.*, 0 AS like_count FROM posts p WHERE realised = 1 AND id NOT IN (SELECT post_id FROM users_likes WHERE liked = 1 GROUP BY post_id)) AS t ORDER BY CAST(t.`id` AS SIGNED INTEGER) DESC LIMIT 0,50";
                
            return $this->database->callQuery($query);
        }
        
        public function searchTheories()
        {
            $query = "SELECT * FROM(SELECT p.*,COUNT(*) AS like_count FROM posts p INNER JOIN users_likes ul"
                    . " ON p.id=ul.post_id WHERE ul.liked = 1 AND p.theory = 1 GROUP BY p.id "
                    . " UNION ALL "
                    . " SELECT p.*, 0 AS like_count FROM posts p WHERE theory = 1 AND id NOT IN (SELECT post_id FROM users_likes WHERE liked = 1 GROUP BY post_id)) AS t ORDER BY CAST(t.`id` AS SIGNED INTEGER) DESC LIMIT 0,50";
                
            return $this->database->callQuery($query);
        }
        
        public function searchFeatured()
        {
            $query = "SELECT * FROM(SELECT p.*,COUNT(*) AS like_count FROM posts p INNER JOIN users_likes ul"
                    . " ON p.id=ul.post_id WHERE ul.liked = 1 AND p.featured = 1 GROUP BY p.id "
                    . " UNION ALL "
                    . " SELECT p.*, 0 AS like_count FROM posts p WHERE featured = 1 AND id NOT IN (SELECT post_id FROM users_likes WHERE liked = 1 GROUP BY post_id)) AS t ORDER BY CAST(t.`id` AS SIGNED INTEGER) DESC LIMIT 0,50";
                
            return $this->database->callQuery($query);
        }
        
        public function searchByPart($search)
        {
             $query = "SELECT * FROM(SELECT p.*,COUNT(*) AS like_count FROM posts p INNER JOIN users_likes ul"
                    . " ON p.id=ul.post_id WHERE ul.liked = 1 AND p.title LIKE '%$search%' GROUP BY p.id "
                    . " UNION ALL "
                    . " SELECT p.*, 0 AS like_count FROM posts p WHERE featured = 1 AND title LIKE '%$search%' AND id NOT IN (SELECT post_id FROM users_likes WHERE liked = 1 GROUP BY post_id)) AS t ORDER BY CAST(t.`id` AS SIGNED INTEGER) DESC LIMIT 0,50";
              
            return $this->database->callQuery($query);
        }
        
        public function closePost($id)
        {
            $where['id'] = $id;
            $data['realised'] = 1;
            return $this->database->update($this->model,$data, $where);
        }
        
        public function searchAllPosts()
        {
            return $this->database->fetchAll($this->model,null,'id','DESC');
        } 
        
        public function getPostCount()
        {
            $query = "SELECT COUNT(*) AS count FROM posts";
            return $this->database->callQuery($query);
        }
        
        public function getFeaturedPostCount()
        {
            $query = "SELECT COUNT(*) AS count FROM posts WHERE featured = 1";
            return $this->database->callQuery($query);
        }
        
        public function getActivePostCount()
        {
            $query = "SELECT COUNT(*) AS count FROM posts WHERE realised = 1";
            return $this->database->callQuery($query);
        }
        
        public function deletePost($id)
        {
            $where['id'] = $id;
            return $this->database->delete($this->model, $where);
        }
        
    
}