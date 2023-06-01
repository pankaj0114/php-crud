<?php

 //error_reporting(E_ALL);
//ini_set('display_errors', 1);


session_start();

//we use function block so we can use early returns
function login(){

   // if (isset($_POST['email']) || isset($_POST['password'])) {
        //return;}

    include "config.php";

    if(empty($password)&& (empty($email))){

         echo "Please Enter the  email and Password !!";
         
    }
     
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $sql = "SELECT email FROM users WHERE email ='$email' AND  password='$password' ";
    $result = mysqli_query($conn, $sql);

 
    
    if (mysqli_num_rows($result) !== 1) 
    {
        return;
        //SYSTEM ERROR
    }
    $row = mysqli_fetch_assoc($result);
    echo "Logged in!";
    if($result == true){
        header("Location: index.php");
    }
    else if($result == false)
    {
        echo "Please Enter the Correct Email or Password if you want to Login !!!!";
    }
    
   
    $_SESSION['email'] = $row['email'];
    $_SESSION['id'] = $row['id'];
}
login();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>

<body>
<div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>
<div class="content">
    <main id="login-page">
        <div class="login-box">
            <div class="content-title">
                <img class ="img" src="https://img.icons8.com/?size=512&id=23446&format=png" alt="logo">
                <h1>Dashboard</h1>
            </div>
            <div class="content-info">
                <h2>Welcome to Dashboard 👋🏻</h2>
                <p>Please Sign-in to your Account and Start </p>
            </div>
            <form method="post" action="login.php" class="login-form">
                <label for="email"> Email</label>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" required >
                <input type="submit" value="LOG IN">
            </form>
          <div class="dash-board">
            <p  > New on our Dashboard? <a href="signup.php">Create Account🔒 </a></p> 
            </div>
            
          <div class= "dash-board">
                <p > Have an Account !! <a href ="forgotpassword.php">Forgot password</a></p>
                
            </div>
            <?php if (isset($_GET['error'])) { ?>
                <p class="error">
                    <?php echo $_GET['error']; ?>
                </p>
            <?php } ?>
                    </div>
        </div>
        
    </main>
</body>
</html>