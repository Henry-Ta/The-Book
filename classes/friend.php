<?php

    class Friend{
        // 0: Add Friend
        // 1: Send Friend Request
        // 2: Friend

        public function send_request($from_userid,$to_userid){
            // have to use insert select statement to insert a new row with condition
            /* Exp: INSERT INTO person (person_id, name)
                    SELECT 1, 'Me'
                    WHERE NOT EXISTS (SELECT 1 FROM person WHERE person_id = 1);*/
            $query = "insert into friend_requests (from_userid,to_userid,requested) select '$from_userid', '$to_userid', 1 where not exists (select 1 from friend_requests where from_userid='$from_userid' and to_userid='$to_userid')";
            $DB = new Database();
            $DB->save($query);
            return true;
        }

        public function get_request_to_display_button($from_userid, $to_userid){
            $query = "select requested from friend_requests where from_userid='$from_userid' and to_userid = '$to_userid' limit 1";
            $DB = new Database();
            $result = $DB->read($query);
            if($result){
                return $result[0];
            }else{
                return false;
            }
        }

        public function get_all_requests($to_userid){
            $query = "select from_userid from friend_requests where to_userid = '$to_userid' and requested = 1";
            $DB = new Database();
            $result = $DB->read($query);
            if($result){
                return $result;
            }else{
                return false;
            }
        }

        public function delete_request($from_userid,$to_userid){
            $query = "delete from friend_requests where from_userid='$from_userid' and to_userid='$to_userid'";
            $DB = new Database();
            $DB->save($query);
            return true;
        }

        public function accept_request($from_userid,$to_userid){
            $query = "update friend_requests set requested=2 where from_userid='$from_userid' and to_userid='$to_userid'";
            $DB = new Database();
            $DB->save($query);

            // make a friend connection from both sides : A->B && B->A
            $query2 = "insert into friend_requests (from_userid,to_userid,requested) values ('$to_userid','$from_userid','2')";
            $DB->save($query2);
            return true;
        }
    }

?>