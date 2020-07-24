<?php
    function get_profile_image($image,$gender){
        if(file_exists($image)){
            return $image;
        }else{
            if($gender == "Male"){
                return '../images/user1.jpg';
            }else {
                return '../images/user6.jpg';
            }
        }
        
    }

    function get_background_image($image){
        if(file_exists($image)){
            return $image;
        }else{
            return "../images/default-cover.jpg";
        }
    }
?>