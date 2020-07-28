<?php

    session_start();
        
    include("../classes/connect.php");
    include("../classes/login.php");
    include("../classes/user.php");
    include("../classes/post.php");

    $login = new Login();
    $user_data = $login->check_login($_SESSION['thebook_userid']);

    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_FILES['file']['name']) && $_FILES['file']['name']!="" && $_FILES['file']['type']=='image/jpeg'){

            $files_location = "../uploads/cover_photos/" . $_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'],$files_location); // change location of default destination when uploading
            
            if(file_exists($files_location)){
                $userid = $user_data['userid'];
                $query = "update users set cover_image='$files_location' where userid='$userid' limit 1";
                $DB = new Database();
                $DB->save($query);

                header("Location: profile.php");
                die;
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
    <title>Change Cover Image | Thebook</title>
    <link rel="stylesheet" href="../styles/style3.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="get_preview_Image.js"></script>
</head>
<body>
    <header>
        <?php include("topbar.php")?>
    </header>
    <main>
        <div id="bodyTimeline">
            <div id="centerContent">
                <form method="post" enctype="multipart/form-data"> <!-- enctype="mul..." : for encoding when submiting post -->
                    <div id="postForm" style="height:100px;">
                        <input type="file" name="file">        <!-- post file always goes with enctype="mul..." -->
                        <input id="postButton" type="submit" value="Update Cover Photo">
                    </div>
                </form> 

                <br>
                <div id="showImg"></div>
                <div id="userImg">
                    Cover Image
                    <br><br>
                    <img src="<?php echo $user_data['cover_image'];?>">
                </div>
            </div>
        </div<>
    </main>
    <footer></footer>
</body>
</html>