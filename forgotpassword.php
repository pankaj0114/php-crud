<?php
include "config.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['sub_set'])) {
    //$email = $_POST['email'];
    $errors=[];
    session_start();
    $email = mysqli_real_escape_string($conn, $_POST['email']);


    $query = "SELECT email FROM users WHERE email='$email'";
    $results = mysqli_query($conn, $query);

    if (empty($email)) {
        array_push($errors, "Your email is required");
        echo " Email is required";
    } else if (mysqli_num_rows($results) <= 0) {
        array_push($errors, "Sorry, no user exists on our system with that email");
        echo "No User exist ";
    }

    $token = bin2hex(random_bytes(50));
    $sql = "INSERT INTO pass_reset (email_a, token) VALUES ('$email', '$token')";
    $results = mysqli_query($conn, $sql);

    if ($results == true) {
        header("Location: blank.php?token=" . $token);
    }
}

?>

<html>

<head>
    

</head>

<body style="background-color:lightyellow ; text-align:center">
    <div class="wrapper" style="width: 35%; margin: 0 auto; padding-top:80px">
        <form class="form-signin" name="forget_pass_form" action='forgotpassword.php' method="post">
            <b>
                <h2 style="color:#239CE7 ;font-size:60px ">Forgot Password</h2>
            </b> 
            <?php include('messages.php'); ?>
            <p style="font-size:20px; color:crimson"> Forgot Password ! Enter Your Email to get Password Reset Link </p>
            <input type="text" class="form-control" style="font-size: 30px ; width:80%" name="email"
                placeholder=" Enter Your Email" required="" autofocus="" />
            <br><br>
            <button class="btn-btn-primary" style="font-size:20px ; background-color:#16C3C3 ; width:80%"
                type="submit">Submit</button>
            <input type="hidden" name="sub_set" value="forgot" />
        </form>
    </div>

</body>

</html>