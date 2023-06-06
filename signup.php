<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
$showAlert = false;
$showErr = false;
$exist = false;



if ($_SERVER["REQUEST_METHOD"] == "POST") {


    include "config.php";

    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    $num = mysqli_num_rows($result);
    if ( $password != $cpassword ){
        $showErr = "Password doesn't match";
        echo "Password does not match";
    } 
    
    else if((empty($password)&& (empty($email)&& empty($cpassword)))){
            echo "Please enter Email and passowrd";
    }

    else if((empty($email)&& (!empty($password) &&(!empty($cpassword))))){
                echo "Please enter the Email  ";
    }
    else if ((!empty($email)&&(empty($password)&&empty($cpassword )))){
                    echo "Please enter the Password & Confirm Password ";
    }

    
    else if ($num >= 0 && ($password == $cpassword) && $exist == false) {

        $sql = "INSERT INTO users ( email, password,  date )
         VALUES ('$email' ,'$password' ,  current_timestamp())";

        $result = mysqli_query($conn, $sql);

        echo "Signed up Successfully";

        echo "Now you can Login !";
        header("Location:login.php");
        
    }
    
       
    /*
    //var_dump($showErr);
    //die();
    */

    

}

?>

<!DOCTYPE HTML>
<HTML>

<head>
    <title>Signup</title>
    <link rel="stylesheet" type="text/css" href="signup.css">
</head>

<body>
<div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>
<div class="content">
    <main id="signup-page">
        <div class="signup-box">
            <div class="content-title">
                <img class="img" src="https://img.icons8.com/?size=512&id=23446&format=png" alt="logo">
                <h1>Dashboard</h1>
            </div>
            <div class="content-info">
                <h2>Welcome to Dashboard 👋🏻</h2>
                <p>Sign-Up to your Account🔒 </p>
            </div>


            <form method="post" action="signup.php" class="signup-form">
                <label for="email"> Email</label>
                <input type="email" name="email" id="email" placeholder="Email">
                    <br>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password">
                <br>
                
                <label for="cpassword"> Confirm Password</label>
                <input type="password" name="cpassword" id="cpassword" placeholder="Confirm Password">
                
                
                <br>
                <input type="submit" value="SIGN UP ">

            
            </form>
            <div class="dash-board">
                <p> Already have an account? <a href="login.php"> Sign In Instead🔒 </a></p>
            </div>

          
       </div>
        </div>
    </main>
</body>

</HTML>