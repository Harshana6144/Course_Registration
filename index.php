<?php
require('./db.php');
session_start(); // Start the session


if(isset($_POST['login'])){
    $username=$_POST['username'];
    $Login_ID=$_POST['Login_ID'];
    //$stID=$_POST['stID'];
    $password=$_POST['password'];
    $coNpassword=$_POST['coNpassword'];

    if (!empty($username) && !empty($Login_ID) && !empty($password)) {
        $checkLogin_ID  = crud::conect()->prepare('SELECT COUNT(*) FROM login_table WHERE login_ID  = :login_ID');
        $checkLogin_ID->bindValue(':login_ID', $Login_ID);
        $checkLogin_ID->execute();
        $login_IDExists =  $checkLogin_ID->fetchColumn();

        if($login_IDExists > 0){
            echo "<script type='text/javascript'> alert('data already exists.')</script>";
        } else{
            if ($password == $coNpassword) {
                $p = crud::conect()->prepare('INSERT INTO login_table(UserName,login_ID,password) VALUES(:u,:L,:p)');
                $p->bindValue('u', $username);
                $p->bindValue('L', $login_ID);
                //$p->bindValue('s', $stID);
                $p->bindValue('p', $password);
                $p->execute();

                // Store Student ID in the session
                //$_SESSION['stID'] = $stID;

                header("Location: STUDENT REGISTRATION.php");
                exit();

                echo "<script type='text/javascript'> alert('Successfully Register')</script>";
            } else{
                echo "<script type='text/javascript'> alert('Enter valid Information')</script>";
            }
        }
    }
}
?>





<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <title>Login Form</title>
</head>
<body>

<img class="wave" src="Images/wave.png">
    <div class="container">
        <div class="img">
            <img src="Images/bg.svg">
        </div>

        <div class="login-container">
            <form  method="POST" action="">
                <img class="avatar" src="Images/avatar.svg">
                <h2>Login</h2>

                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <h5>Username</h5>
                        <input class="input" autocomplete="off" type="text" name="username"  value="" required>
                    </div>
                </div>

                <!--div class="input-div two">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div>
                        <h5>Student ID</h5>
                        <input class="input" autocomplete="off" type="text" name="stID" value=""  required>
                    </div>
                </div-->

                <div class="input-div two">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div>
                        <h5>Login ID</h5>
                        <input class="input" autocomplete="off" type="text" name="Login_ID" value=""  required>
                    </div>
                </div>


                <div class="input-div two">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div>
                        <h5>Password</h5>
                        <input class="input" type="Password" name="password" value="" required>
                    </div>
                </div>

                <div class="input-div two">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div>
                        <h5>Confirm Password</h5>
                        <input class="input" type="Password" name="coNpassword" value="" required>
                    </div>
                </div>

                <a href="#">Forget Password?</a>

               
                <input type="submit" name="login" value="LOGIN"  class="btn">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="JS/main.js"></script>
</body>
</html>
