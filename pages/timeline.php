<?php

    session_start();
        
    include("../classes/connect.php");
    include("../classes/login.php");
    include("../classes/user.php");
    include("../classes/post.php");

    $login = new Login();
    $user_data = $login->check_login($_SESSION['thebook_userid']);

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
                <a href="profile.php"><img id="userImg" src="../images/selfie.jpg"></a>
                <br>
                <div id="userName"><?php echo $user_data['first_name'] . " ". $user_data['last_name'];?></div>
            </div>
            <div id="centerContent">
                <div id="postForm">
                    <textarea placeholder=" What's on your mind?"></textarea>
                    <input id="postButton" type="submit" value="Post">
                </div>
                <div id="postBackground">
                    <div id="postArea">
                        <div id="userBar">
                            <img id="userImg" src="../images/user3.jpg">
                            <div id="userName">Henry Ta</div>
                            <div id="date">July 1st 2020</div>
                        </div>
                        <div id="postContent">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        <br><br>
                        <a href="">Like</a> . <a href="">Comment</a>
                        </div>
                    </div>
                </div>

                <div id="postBackground">
                    <div id="postArea">
                        <div id="userBar">
                            <img id="userImg" src="../images/user2.jpg">
                            <div id="userName">Henry Ta</div>
                            <div id="date">July 1st 2020</div>
                        </div>
                        <div id="postContent">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        <br><br>
                        <a href="">Like</a> . <a href="">Comment</a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="rightContent">
                Request
            </div>
        </div<>
    </main>
    <footer></footer>
</body>
</html>