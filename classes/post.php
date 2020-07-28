<?php

    class Post{
        public function create_post($userid, $data, $file){
            $image = '';
            $has_image = 0;

            if(isset($data['post']) || isset($file['file']['name'])){
                $post = addslashes($data['post']);
                $postid = $this->create_postid();

                if(isset($file['file']['name']) && ($file['file']['name']!="" && $file['file']['type']=='image/jpeg')){
                    $image = "../uploads/post_photos/" . $file['file']['name'];
                    move_uploaded_file($_FILES['file']['tmp_name'],$image);

                    $has_image = 1;
                }

                $query = "insert into posts (postid,userid,post,image,has_image) values ('$postid','$userid','$post','$image','$has_image')";

                $DB = new Database();
                $DB->save($query);
                return true;
            }else{
                return false;
            }
        }

        public function create_post_on_other_user($userid, $data, $file,$guestid){
            $image = '';
            $has_image = 0;

            if(isset($data['post']) || isset($file['file']['name'])){
                $post = addslashes($data['post']);
                $postid = $this->create_postid();

                if(isset($file['file']['name']) && ($file['file']['name']!="" && $file['file']['type']=='image/jpeg')){
                    $image = "../uploads/post_photos/" . $file['file']['name'];
                    move_uploaded_file($_FILES['file']['tmp_name'],$image);

                    $has_image = 1;
                }

                $query = "insert into posts (postid,userid,post,image,has_image,guestid) values ('$postid','$userid','$post','$image','$has_image','$guestid')";

                $DB = new Database();
                $DB->save($query);
                return true;
            }else{
                return false;
            }
        }

        public function get_posts($id){
            $query = "select * from posts where userid='$id' and guestid = 0 order by id desc ";

            $DB = new Database();
            $result = $DB->read($query);

            if($result){
                return $result;
            }else{
                return false;
            }
        }

        public function get_posts_on_other_user($id){
            $query = "select * from posts where userid='$id' and guestid != 0 order by id desc ";

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