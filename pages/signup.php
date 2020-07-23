<?php
    include("../classes/connect.php");
    include("../classes/signup.php");

    $first_name     = "";
    $last_name      = "";
    $gender         = "";
    $email          = "";
    $password       = "";
    $month_birth    = "";
    $day_birth      = "";
    $year_birth     = "";

    $signup = new Signup();

    if($_SERVER['REQUEST_METHOD']=="POST"){
        $result = $signup->validate();

        if($signup->valid){
            header("Location: login.php");
            die;
        }

        $first_name     = $_POST['first_name'];
        $last_name      = $_POST['last_name'];
        $gender         = $_POST['gender'];
        $email          = $_POST['email'];
        $password       = $_POST['password'];
        $month_birth    = $_POST['month_birth'];
        $day_birth      = $_POST['day_birth'];
        $year_birth     = $_POST['year_birth'];
    }

?>


<!----------------------------------------HTML------------------------------------------->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up for Thebook | Thebook</title>
    <link rel="stylesheet" href="../styles/style1.css">
</head>
<body>
    <header>
        <div id="headerSignup">
            <div id="title">thebook </div>
            <div id="login"><a href="login.php">Log In</a></div>
        </div>
    </header>
    <main>
        <div id="mainSignup">
            <div id="title">Create a New Account</div>
            <div id="caption">It's quick but not that easy.</div>

            <form method="post" action="">
                <div id="name">
                    <div id="fName">
                        <input value="<?php echo $first_name?>" name="first_name" type="text" id="firstName" placeholder=" First Name">
                            
                        <div class="firstname-message" >
                            <?php $signup->validation_messages("first_name"); ?>
                        </div>
                    </div>
                    <div id="lName">
                        <input value="<?php echo $last_name?>" name="last_name" type="text" id="lastName" placeholder=" Last Name">

                        <div class="lastname-message" >
                            <?php $signup->validation_messages("last_name"); ?>
                        </div>
                    </div>
                </div>
                <div id="ema">
                    <input value="<?php echo $email?>" name="email" type="text" id="email" placeholder=" New Email Address">
                    <div class="failure-message">
                        <?php $signup->validation_messages("email"); ?>
                    </div>
                </div>
                <div id="pass">
                    <input value="<?php echo $password?>" name="password" type="password" id="password" placeholder=" New Password">
                    <div class="failure-message">
                        <?php $signup->validation_messages("password"); ?>
                    </div>
                </div>
                <div id="birthday">Birthday</div>
                <div id="dmy">
                    <div id="m">
                        <select id="month" value="<?php echo $month_birth?>"name="month_birth">
                            <option>Month</option>
                            <option>January</option>
                            <option>February</option>
                            <option>March</option>
                            <option>April</option>
                            <option>May</option>
                            <option>June</option>
                            <option>July</option>
                            <option>August</option>
                            <option>September</option>
                            <option>October</option>
                            <option>November</option>
                            <option>December</option>
                        </select>
                        <div class="failure-message">
                            <?php $signup->validation_messages("month_birth"); ?>
                        </div>
                    </div>
                    <div id="d">
                        <select id="day" value="<?php echo $day_birth?>" name="day_birth">
                            <option>Day</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
                            <option>13</option>
                            <option>14</option>
                            <option>15</option>
                            <option>16</option>
                            <option>17</option>
                            <option>18</option>
                            <option>19</option>
                            <option>20</option>
                            <option>21</option>
                            <option>22</option>
                            <option>23</option>
                            <option>24</option>
                            <option>25</option>
                            <option>26</option>
                            <option>27</option>
                            <option>28</option>
                            <option>29</option>
                            <option>30</option>
                            <option>31</option>
                        </select>
                        <div class="failure-message">
                            <?php $signup->validation_messages("day_birth"); ?>
                        </div>
                    </div>
                    <div id="y">
                        <select id="year" value="<?php echo $year_birth?>" name="year_birth">
                            <option>Year</option>
                            <option>1990</option>
                            <option>1991</option>
                            <option>1992</option>
                            <option>1993</option>
                            <option>1994</option>
                            <option>1995</option>
                            <option>1996</option>
                            <option>1997</option>
                            <option>1998</option>
                            <option>1999</option>
                            <option>2000</option>
                            <option>2001</option>
                            <option>2002</option>
                            <option>2003</option>
                            <option>2004</option>
                            <option>2005</option>
                            <option>2006</option>
                            <option>2007</option>
                            <option>2008</option>
                            <option>2009</option>
                            <option>2010</option>
                        </select>
                        <div class="failure-message">
                            <?php $signup->validation_messages("year_birth"); ?>
                        </div>
                    </div>
                </div>
                <div id="gender">Gender</div>
                <div id="genderSelection">
                    <div id="male">
                        <input name="gender['male']" type="radio" id="male" value="male">
                        <label for="male">Male</label><br>
                    </div>
                    <div id="female">
                        <input value="female" name="gender['female']" type="radio" id="female" value="female">
                        <label for="female">Female</label><br>
                    </div>
                    <div id="other">
                        <input value="other" name="gender['other']" type="radio" id="other" value="other">
                        <label for="other">Other</label>
                    </div>
                    <div class="failure-message">
                        <?php $signup->validation_messages("gender"); ?>
                    </div>
                </div>
                <div id="policy">By Clicking Sign Up, you agree to everything from me. You may receive SMS or email from me and can be locked your account anytime i like.</div>
                <div id="signup"><input type="submit" id="buttonSignup" value="Sign Up"></div>
            </form>
        
        </div>
    </main>
    <footer>
    </footer>
    
</body>
</html>