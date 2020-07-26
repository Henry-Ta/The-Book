<?php
    session_start();
    
    include("../classes/connect.php");
    include("../classes/login.php");
    include("../classes/user.php");
    include("../classes/post.php");
    include("../classes/friend.php");
    
    include("get_images.php");

    $profile_image = '';        #default profile image
    $background_image = '';     #default cover image

    
    $_SESSION['friend_button'] = "";    # display friend button

    $login = new Login();
    $user_data = $login->check_login($_SESSION['found_user']);

    $gender_user = $user_data['gender'];        #select gender for default photo

    // create a post
    if($_SERVER['REQUEST_METHOD']=='POST'){
        // post a status
        if(isset($_POST['button_post'])){
            $post = new Post();
            $result = $post->create_post($_SESSION['found_user'],$_POST);
            if($result){
                header("Location: login.php");      // to not resend data to database when reload
                die;
            }
        }
        
        // send friend request
        if(isset($_POST['button_friend'])){
            $friend = new Friend();
            $result = $friend->send_request($_SESSION['thebook_userid'],$_SESSION['found_user']);
            if($result){
                header("Location: other_user_profile.php");      // to not resend data to database when reload
                die;
            }
        }
    }

    function display_friend_button(){
        $friend = new Friend();
        $result = $friend->get_request_to_display_button($_SESSION['thebook_userid'], $_SESSION['found_user']);
        
        if(!$result){
            $_SESSION['friend_button'] = "Add Friend";
        }else{
            if($result['requested'] == 0){
                $_SESSION['friend_button'] = "Add Friend";
            }
            elseif($result['requested'] == 1){
                $_SESSION['friend_button'] = "+1 Friend Request Sent";
            }
            elseif($result['requested'] == 2){
                $_SESSION['friend_button'] = "Friend";
            }
        }
    }

    function get_posts(){
        $post = new Post();
        $posts = $post->get_posts($_SESSION['found_user']);

        if($posts){
            foreach($posts as $p){
                $user = new User();
                $data_user = $user->get_data($p['userid']);

                $avatar_user = get_profile_image($data_user['profile_image'],$data_user['gender']);

                echo '<div id="postBackground">
                        <div id="postArea">
                            <div id="userBar">
                                <img id="userImg" src="../images/' . $avatar_user . '">
                                <div id="userName">' . $data_user["first_name"] . " " . $data_user["last_name"] . '</div>
                                <div id="date">' . $p["date"] .'</div>
                            </div>
                            <div id="postContent">
                            ' . $p["post"] . '
                            <br><br>
                            <a href="">Like</a> . <a href="">Comment</a>
                            </div>
                        </div>
                    </div> ';
            }
        }
    }

    function get_friends(){
        $user = new User();
        $friends = $user->get_friends($_SESSION['found_user']);

        if($friends){
            foreach($friends as $i){
                $f = $user->get_data($i['from_userid']);
                echo '<div id="friend">
                        <img id="friendImg" src="'. get_profile_image($f['profile_image'],$f['gender']) . '">
                        <div id="friendName">' . $f['first_name'] . " " . $f['last_name'] . '</div>
                    </div>';
            }
        }

    }

    $profile_image = get_profile_image($user_data['profile_image'],$gender_user);
    $background_image = get_background_image($user_data['cover_image']);

    display_friend_button();
?>

<!----------------------------------------HTML------------------------------------------->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page | Thebook</title>
    <link rel="stylesheet" href="../styles/style2.css">
</head>
<body>
    <header>
        <?php include("topbar.php")?>
    </header>
    <main>
        <div id="backgroundCover">
            <div id="coverArea">
                <img id="coverPhoto" src="<?php echo $background_image ?>">
                <img id="profilePhoto" src="<?php echo $profile_image ?>">
                <br>
                <div id="profileName"><?php echo $user_data['first_name'] . " " . $user_data['last_name']?></div>
                <form method="post">
                    <input id="postButton" type="submit" name="button_friend" value="<?php print_r($_SESSION['friend_button']); ?>">                   
                </form>
                <br>
                <div id="menuButtons">
                    <div id="timeline"><a href="timeline.php">Timeline</a></div> 
                    <div id="about">About</div> 
                    <div id="friends">Friends</div> 
                    <div id="photos">Photos</div> 
                    <div id="settings">Settings</div>
                </div>
            </div>
        </div>

        <div id="bodyProfile">
            <div id="leftContent">
                <div id="friendsArea">
                    <div id="friendsBar">
                        <div id="title">Friends</div>
                        <div id="seeAll">See All</div>
                    </div>
                    <div id="friendsList">
                        <?php
                            get_friends();  
                        ?>
                    </div>
                </div>
                <div id="reference">
                    <ul id="referenceList">
                        <li id="privacy">Privacy</li>
                        <li id="terms">Terms</li>
                        <li id="advertising">Advertising</li>
                        <li id="more">More</li>
                    </ul>
                    Henry Ta @ 2020 ( ^ o ^)
                </div>
            </div>
            <div id="rightContent">
                <form method="post">
                    <div id="postForm">
                        <textarea name="post" placeholder=" What's on your mind?"></textarea>
                        <input id="postButton" type="submit" value="Post" name="button_post">                   
                    </div>
                </form>

                <?php
                    get_posts();  
                ?>

            </div>
        </div<>
    </main>
    <footer></footer>
</body>
</html>