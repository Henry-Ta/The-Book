<?php

    class Post{
        public function create_post($userid, $data){
            if(isset($data['post'])){
                $post = addslashes($data['post']);
                $postid = $this->create_postid();

                $query = "insert into posts (postid,userid,post) values ('$postid','$userid','$post')";

                $DB = new Database();
                $DB->save($query);
            }else{
                return false;
            }
        }

        public function get_posts($id){
            $query = "select * from posts where userid='$id' order by id desc ";

            $DB = new Database();
            $result = $DB->read($query);
            if($result){
                return $result;
            }else{
                return false;
            }
        }

        private function create_postid(){
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