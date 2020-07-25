<?php
    class User {
        public function get_data($id){
            $query = "select * from users where userid = '$id' limit 1";
            $DB = new Database();
            $result = $DB->read($query);

            if($result){
                $row = $result[0];
                return $row;
            }
            return false;
        }

        public function get_friends($id){
            $query = "select * from users where userid != '$id'";
            $DB = new Database();
            $result = $DB->read($query);

            if($result){
                $row = $result;
                return $row;
            }
            return false;
        }

        public function find_user($email){
            $query = "select userid from users where email = '$email' limit 1";
            $DB = new Database();
            $result = $DB->read($query);

            if($result){
                return $result[0];
            }
            return false;
        }
    }
?>