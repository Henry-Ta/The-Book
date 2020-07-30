<?php

    class Database {
        private $host = "us-cdbr-east-02.cleardb.com";
        private $username = "b2a6f15ea9dd27";
        private $password = "0a885a6c";
        private $db = "heroku_13d368091f8d497";

        function connect(){
            $connection = mysqli_connect($this->host, $this->username, $this->password, $this->db);
            return $connection;
        }

        function read($query){
            $conn = $this->connect();
            $result = mysqli_query($conn,$query);

            if(!$result){
                return false;
            }else{
                $data = array();
                while($row = mysqli_fetch_assoc($result)){
                    $data[] = $row;
                }
                return $data;
            }
        }

        function save($query){
            $conn = $this->connect();
            $result = mysqli_query($conn,$query);

            if(!$result){
                return false;
            }else{
                return true;
            }
        }
        
    }

?>
