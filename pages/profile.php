<?php
    session_start();
    
    include("../classes/connect.php");
    include("../classes/login.php");
    include("../classes/user.php");
    include("../classes/post.php");

    $default_image = '';
    $default_cover = '';

    $login = new Login();
    $user_data = $login->check_login($_SESSION['thebook_userid']);

    $gender_user = $user_data['gender'];
    // posting
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $post = new Post();
        $result = $post->create_post($_SESSION['thebook_userid'],$_POST);
        if($result){
            header("Location: login.php");      // to not resend data to database when reload
            die;
        }
    }

    function get_posts(){
        $post = new Post();
        $posts = $post->get_posts($_SESSION['thebook_userid']);

        if($posts){
            foreach($posts as $p){
                $user = new User();
                $data_user = $user->get_data($p['userid']);

                $avatar_user = get_default_avatar($data_user['gender']);

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

    function get_default_avatar($gender){
        if($gender == "Male"){
            return 'user1.jpg';
        }else {
            return 'user6.jpg';
        }
    }

    function get_friends(){
        $user = new User();
        $friends = $user->get_friends($_SESSION['thebook_userid']);

        if($friends){
            foreach($friends as $f){
                echo '<div id="friend">
                        <img id="friendImg" src="../images/' . get_default_avatar($f['gender']) . '">
                        <div id="friendName">' . $f['first_name'] . " " . $f['last_name'] . '</div>
                    </div>';
            }
        }

    }

    $default_image = get_default_avatar($gender_user);
    $default_cover = "default-cover.jpg";
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
        <div id="blueBar">
            <div id="headerProfile">
                <div id="logo">thebook</div>
                <div id="search"><input type="text" id="searchBox" placeholder="Search Thebook">&nbsp&nbsp</div>
                <div id="profileImage">
                    <img src="../images/<?php echo $default_image ?>">
                    <a href="logout.php">Log Out</a>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div id="backgroundCover">
            <div id="coverArea">
                <img id="coverPhoto" src="../images/<?php echo $default_cover ?>">
                <img id="profilePhoto" src="../images/<?php echo $default_image ?>">
                <br>
                <div id="profileName"><?php echo $user_data['first_name'] . " " . $user_data['last_name']?></div>
                <br>
                <div id="menuButtons">
                    <div id="timeline">Timeline</div> 
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
                        <input id="postButton" type="submit" value="Post">                   
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