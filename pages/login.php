<?php
    session_start();        #maintain info of user between pages
    include("../classes/connect.php");
    include("../classes/login.php");

    $login = new Login();

    # show value in form below, need to reassign to empty everytime we refresh
    $email          = "";
    $password       = "";

    if($_SERVER['REQUEST_METHOD']=="POST"){
        $result = $login->validate();

        if($login->valid){
            # to save input, in case we need to update to check something more
            $email          = $_POST['email'];
            $password       = $_POST['password'];
            
            header("Location: profile.php");
            die;    
        }

        
    }

?>

<!----------------------------------------HTML------------------------------------------->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log into Thebook | Thebook</title>
    <link rel="stylesheet" href="../styles/style1.css">
</head>
<body>
    <header>
        <div id="headerLogin">
            <div id="title"><a href="timeline.php">thebook</a> </div>
            <div id="signup"><a href="../index.php">Sign Up</a></div>
        </div>
    </header>
    <main>
        <div id="mainLogin">
            <form method="post">
                <div id="title">Log Into Thebook</div>
                <div id="ema">
                    <input name="email" value="<?php echo $email?>" type="text" id="email" placeholder=" Enter your Email">                  
                    <div class="failure-message" >
                        <?php $login->validation_messages("email"); ?>
                    </div>
                </div>

                <div id="pass">
                    <input name="password" value="<?php echo $password?>" type="password" id="password" placeholder=" Enter your Password">
                    <div class="failure-message" >
                        <?php $login->validation_messages("password"); ?>
                    </div>
                </div>

                <div id="btn"><input type="submit" id="buttonLogin" value="Log In"></div>
                <div id="or">-------------------------------   or   -------------------------------</div>
                <div id="signup2"><a href="../index.php">Create New Account</a></div>
            </form>
            
        </div>
    </main>
    <footer>
    </footer>
    
</body>
</html>