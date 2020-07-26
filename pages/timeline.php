<?php

    session_start();
        
    include("../classes/connect.php");
    include("../classes/login.php");
    include("../classes/user.php");
    include("../classes/post.php");
    include("../classes/friend.php");

    include("get_images.php");

    $login = new Login();
    $user_data = $login->check_login($_SESSION['thebook_userid']);

    // create post
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $post = new Post();
        $result = $post->create_post($_SESSION['thebook_userid'],$_POST,$_FILES);
        if($result){
            header("Location: timeline.php");      // to not resend data to database when reload
            die;
        }
    }

    // get post
    function get_posts(){
        $post = new Post();
        $posts = $post->get_posts($_SESSION['thebook_userid']);
        
        if($posts){
            foreach($posts as $p){
                $image = '';
                $user = new User();
                $data_user = $user->get_data($p['userid']);

                $avatar_user = get_profile_image($data_user['profile_image'],$data_user['gender']);

                if(file_exists($p["image"])){
                    $image = '<img src=' . $p["image"] . ' />';
                }

                echo '<div id="postBackground">
                        <div id="postArea">
                            <div id="userBar">
                                <img id="userImg" src="../images/' . $avatar_user . '">
                                <div id="userName">' . $data_user["first_name"] . " " . $data_user["last_name"] . '</div>
                                <div id="date">' . $p["date"] .'</div>
                            </div>
                            <div id="postContent">    
                                <div id="post">' . $p["post"] . '</div>
                                <br><br>
                                <div id="image">' . $image .'</div>
                                <br><br>
                                <a href="">Like</a> . <a href="">Comment</a>
                            </div>
                        </div>
                    </div> ';
            }
        }
    }

    function get_friend_request(){
        $friend = new Friend();
        $result = $friend->get_all_requests($_SESSION['thebook_userid']);

        $user = new User();
        
        if($result){
            foreach($result as $r){
                $user_request = $user->get_data($r['from_userid']);
                echo '<div id="friend">
                        <form method="post">
                            <img id="friendImg" src="'. get_profile_image($user_request['profile_image'],$user_request['gender']) . '">
                            <div id="friendName">' . $user_request['first_name'] . " " . $user_request['last_name'] . '</div>
                            <div id="button">
                                <input id="yesButton" type="submit" name="yes_button" value="Yes">
                                <input id="noButton" type="submit" name="no_button" value="No">
                            </div>
                         </form>   
                    </div>';
            }
        }
    }
?>

<!----------------------------------------HTML------------------------------------------->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline Page | Thebook</title>
    <link rel="stylesheet" href="../styles/style3.css">
</head>
<body>
    <header>
        <?php include("topbar.php")?>
    </header>
    <main>

        <div id="bodyTimeline">
            <div id="leftContent">
                <a href="profile.php"><img id="userImg" src="<?php print_r($_SESSION['profile_image']) ?>"></a>
                <br>
                <div id="userName"><?php echo $user_data['first_name'] . " ". $user_data['last_name'];?></div>
            </div>
            <div id="centerContent">
                <form method="post" enctype="multipart/form-data">
                    <div id="postForm">
                        <textarea name="post" placeholder=" What's on your mind?"></textarea>
                        <input id="file" type="file" name="file">
                        <input id="postButton" type="submit" value="Post">                   
                    </div>
                </form>
                <?php
                    get_posts();  
                ?>
            </div>
            <div id="rightContent">
                <div id="request">Friend Request</div>
                <?php
                    get_friend_request();
                ?>
            </div>
        </div<>
    </main>
    <footer></footer>
</body>
</html>