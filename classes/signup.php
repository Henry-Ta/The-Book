<?php

    class Signup{
        private $error = Array();
        public $valid = false;

        public function validate(){
            global $valid;
            $email = '#^(.+)@([^\.].*)\.([a-z]{2,})$#';
            $name = "/^[a-zA-Z'-]+$/";
            $password = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,10}$/"; // 1 number, 1 uper, 1 lower, 5-10 characters

            $validFirstName     = false;
            $validLastName      = false;
            $validEmail         = false;
            $validPassword      = false;
            $validMonthBirth    = false;
            $validDayBirth      = false;
            $validYearBirth     = false;
            $validGender        = false;

            if(!empty($_POST['first_name'])){
                if(preg_match($name, $_POST['first_name'])){
                    $validFirstName = true;
                    $this->error[0] = '';
                }else{
                    $this->error[0] = 'Only letters';
                }
            }else{
                $validFirstName = false;
                $this->error[0] = 'First name is empty';
            }

            if(!empty($_POST['last_name'])){
                if(preg_match($name, $_POST['last_name'])){
                    $validLastName = true;
                    $this->error[1] = '';
                }else{
                    $this->error[1] = 'Only letters';
                }
            }else{
                $validLastName = false;
                $this->error[1] = 'Last name is empty';
            }

            if(!empty($_POST['email'])){
                if (preg_match($email, $_POST['email'])){
                    $validEmail = true;
                    $this->error[2] = '';
                }else{
                    $this->error[2] = 'Email is invalid';
                }
            }else{
                $validEmail = false;
                $this->error[2] = 'Email is empty';
            }

            if(!empty($_POST['password'])){
                if (preg_match($password, $_POST['password'])){
                    $validPassword = true;
                    $this->error[3] = '';
                }else{
                    $this->error[3] = 'Password includes 1 number, 1 upper, 1 lower, 5-10 characters';
                }
            }else{
                $validPassword = false;
                $this->error[3] = 'Password is empty';
            }
            
            if(!empty($_POST['month_birth']) && ($_POST['month_birth'] != "Month")){
                $validMonthBirth = true;
                $this->error[4] = '';
            }else{
                $validMonthBirth = false;
                $this->error[4] = ' ------------';
            }

            if(!empty($_POST['day_birth']) && ($_POST['day_birth'] != "Day")){
                $validDayBirth = true;
                $this->error[5] = '';
            }else{
                $validDayBirth = false;
                $this->error[5] = ' ---- ';
            }

            if(!empty($_POST['year_birth']) && ($_POST['year_birth'] != "Year")){
                $validYearBirth = true;
                $this->error[6] = '';
            }else{
                $validYearBirth = false;
                $this->error[6] = '--------';
            }

            if(!empty($_POST['gender'])){
                if (count($_POST['gender'])==1){
                    $validGender = true;
                    $this->error[7] = '';
                }else{
                    $this->error[7] = 'Please select 1 gender';
                }
            }else{
                $validGender = false;
                $this->error[7] = '--------------------------------------';
            }

            if($validFirstName && $validLastName && $validEmail && $validPassword && $validMonthBirth && $validDayBirth && $validYearBirth && $validGender){
                $this->valid = true;
                $this->create_user();
            }
        }

        public function create_user(){
            $first_name     = ucfirst($_POST['first_name']);
            $last_name      = ucfirst($_POST['last_name']);

            $gender = $this->get_gender();
            
            $email          = $_POST['email'];
            $password       = password_hash($_POST['password'],PASSWORD_BCRYPT);        //hash password
            $month_birth    = $_POST['month_birth'];
            $day_birth      = $_POST['day_birth'];
            $year_birth     = $_POST['year_birth'];

            //Create these
            $url_address    = strtolower($first_name) . "." . strtolower($last_name);
            $userid         = $this->create_userid();

            $query = "insert into users 
            (userid,first_name,last_name,gender,email,password,month_birth,day_birth,year_birth,url_address) 
            values 
            ('$userid','$first_name','$last_name','$gender','$email','$password','$month_birth','$day_birth','$year_birth','$url_address')";
            
            $DB = new Database();
            $DB->save($query);
        }

        public function validation_messages($type){

            if($_SERVER['REQUEST_METHOD']== 'POST')
            { 
                if($type == 'first_name'){
                    echo $this->error[0];
                }
                if($type == 'last_name'){
                    echo $this->error[1];
                }
                if($type == 'email'){
                    echo $this->error[2];
                }
                if($type == 'password'){
                    echo $this->error[3];
                }
                if($type == 'month_birth'){
                    echo $this->error[4];
                }
                if($type == 'day_birth'){
                    echo $this->error[5];
                }
                if($type == 'year_birth'){
                    echo $this->error[6];
                }
                if($type == 'gender'){
                    echo $this->error[7];
                }
            }
        }

        private function get_gender(){
            foreach($_POST['gender'] as $gender){
                if($gender == 'male'){
                    return "Male";
                }else if($gender == 'female'){
                    return "Female";
                }else {
                    return "Other";
                }
            }
        }

        private function create_userid(){
            $length = rand(5,20);
            $number = "";
            for($i=0;$i<$length;$i++){
                $ran_num = rand(0,9);
                $number.=$ran_num;
            }
            return $number;
        }
    }

?>