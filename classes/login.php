<?php

    class Login{
        private $error = Array();
        public $valid = false;
        
        public function validate(){
            global $valid;
            $email          =  addslashes($_POST['email']);     //addslashes: connect all character in string, in case of ' ' " as special characters
            $password       =  addslashes($_POST['password']);

            $query = "select * from users where email = '$email' limit 1";  // limit 1: return 1 row, the first result
            
            $DB = new Database();
            $result = $DB->read($query);

            if($result){
                $row = $result[0];      # first row
                if($password == $row['password']){
                //if(password_verify($password, $row['password'])){       // verify password hash
                    $this->valid = true;
                    $this->error[0] = '';
                    $this->error[1] = '';

                    //Create session data ( to use for other pages )
                    $_SESSION['thebook_userid'] = $row['userid'];
                }else{
                    $this->valid = false;
                    $this->error[1] = "Wrong password";
                    $this->error[0] = '';
                }
            }else{
                $this->valid=false;
                $this->error[0] = "Wrong email";
                $this->error[1] = '';
            }
        }

        public function validation_messages($type){

            if($_SERVER['REQUEST_METHOD']== 'POST')
            { 
                if($type == 'email'){
                    echo $this->error[0];
                }
                if($type == 'password'){
                    echo $this->error[1];
                }
            }
        }

        public function check_login($id){
            //check login in case someone sends fake userid to mess up the system
            if(is_numeric($_SESSION['thebook_userid'])){
                $query = "select * from users where userid = '$id' limit 1";
                $DB = new Database();
                $result = $DB->read($query);

                if($result){
                    return $result[0];
                }else{
                    header("Location: login.php");
                    die;
                }
            }else{
                header("Location: login.php");
                die;
            }
        }
    }

?>