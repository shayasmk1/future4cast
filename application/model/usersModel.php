<?php
require_once APP . 'model/helper/database.php';
require_once APP . 'model/helper/extra.php';
class usersModel extends database
{
    function __construct()
    {
       $this->model = 'users';
       $this->extra = new extra();
       $this->database = new database();
    }
    
    public function insertData($data)
    {
        
            $message = '';
            $success = 1;
            if($data['name'] == '')
            {
                $message.= 'Name is required<br/>';
                $success = 0;
            }
            
            if($data['email'] == '')
            {
                $message.= 'Email is required<br/>';
                $success = 0;
            }
            
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $message.= "Invalid email format<br/>"; 
                $success = 0;
            }
            
            
            if($data['password'] == '')
            {
                $message.= 'Password is required<br/>';
                $success = 0;
            }
            
            if(strlen($data['password']) < 6)
            {
                $message.= 'Password length cannot be less than 6<br/>';
                $success = 0;
            }

            if($data['password'] != $data['confirm_password'])
            {
                $message.= "Password and confirm password doesnot match<br/>"; 
                $success = 0;
            }
            
            $email['email'] = $data['email'];
            $user = $this->database->fetchRow($this->model, $email);
            
            if(($user))
            {
                $message.= "Email already exists<br/>"; 
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
            $data['salt'] = $this->extra->generate_random_string(10);
            $data['password'] = hash('sha512', $data['password'].$data['salt']);
//            if($data['dob'] != '' && $data['dob'] != null)
//            {
//                $data['dob'] = date("Y-m-d", strtotime($data['dob']));
//            }
            $data['created_at'] = $data['updated_at'] = date("Y-m-d H:i:s");
            unset($data['confirm_password']);
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
            $database = new database;
            $data['updated_at'] = date('Y-m-d H:i:s');
            $conditions['id'] = $id;
            return $database->update('trolls',$data, $conditions);
        }
        
        public function searchCurrentID($id)
        {
            $where = array('id' => $id);
            return $this->database->fetchRow($this->model, $where);
        }
        
        public function sendMail($data)
        {
            $email = $data['email'];
            $user = $this->database->fetchRow($this->model, $data);
            $error = 1;
            if($user == '' || count($user) < 1 || $user['type'] == 'administrator')
            {
                $return['message'] = 'Email not registered with us';
                $return['status'] = 0;
                return $return;
            }
            
            $salt = $user['salt'];
            $passwordFront = $password['password'] = $this->randomString(6);
            
            $password['password'] = hash('sha512', $password['password'].$salt);
            $userUpdated = $this->database->update($this->model, $password, $data);
            
            $msg = "Hello ".$user['name'].",<br/> Your password is successfully reset.Please find the below details.<br/> Your new password is : <b>".$passwordFront."</b>";
            $headers = 'From: info@future4cast.com' . "\r\n";
            $headers.= 'MIME-Version: 1.0' . "\r\n";
            $headers.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            
            
            mail($email, "Future4cast - Password Reset", $msg, $headers);
            $return['message'] = 'Mail successfully sent. Please check your email for password';
            $return['status'] = 1;
            return $return;
        }
        
        private function randomString($length) {
            $key = '';
            $keys = array_merge(range(0,9), range('a', 'z'));

            for($i=0; $i < $length; $i++) {
                $key.= $keys[array_rand($keys)];
            }
            return $key;
        }
        public function resetPassword($data)
        {
            $message = '';
            $success = 1;
            if($data['current_password'] == '')
            {
                $message.= 'Current Password is required<br/>';
                $success = 0;
            }
            
            if($data['password'] == '')
            {
                $message.= 'New Password is required<br/>';
                $success = 0;
            }
            
            if($data['reenter_password'] == '')
            {
                $message.= 'Confirm Password is required<br/>';
                $success = 0;
            }
            
            if($data['password'] != $data['reenter_password'])
            {
                $message.= 'Password and Confirm Password does not match<br/>';
                $success = 0;
            }
            $userID = $_SESSION['user'];
            $user['id'] = $userID;
            $user = $this->database->fetchRow($this->model, $user);
            if(hash('sha512', $data['current_password'].$user['salt']) != $user['password'])
            {
                $message.= 'Your password is incorrect<br/>';
                $success = 0;
            }
            $return = array();
            if($success == 0)
            {
                $return['status'] = $success;
                $return['message'] = $message;
                return $return;
            }
            
            
            
            $salt = $user['salt'];
            $where['id'] = $userID;
            $password['password'] = hash('sha512', $data['password'].$salt);
            $userUpdated = $this->database->update($this->model, $password, $where);
            
            if($userUpdated)
            {
                $return['status'] = $success;
                $return['message'] = 'Password Successfully reset';
                $return['user'] = $user;
            }
            else {
                $return['status'] = 0;
                $return['message'] = 'Something Went Wrong';
            }
            return $return;
        }
        
       public function searchAll()
        {
            return $this->database->fetchAll($this->model,null,'id','DESC');
        } 
        
        public function getCount()
        {
            $query = "SELECT COUNT(*) AS count FROM users";
            return $this->database->callQuery($query);
        }
        
    
}