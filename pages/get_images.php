<?php
    function get_profile_image($image,$gender){
        if(file_exists($image)){
            return $image;
        }else{
            if($gender == "Male"){
                return '../images/default_male.jpg';
            }else {
                return '../images/default_female.jpg';
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