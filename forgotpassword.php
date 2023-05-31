<?php
include "config.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['sub_set'])){
    //$email = $_POST['email'];
        session_start();
        $email = mysqli_real_escape_string($conn, $_POST['email']);


        $query = "SELECT email FROM users WHERE email='$email'";
        $results = mysqli_query($conn, $query);
      
        if (empty($email)) {
          array_push($errors, "Your email is required");
        }else if(mysqli_num_rows($results) <= 0) {
          array_push($errors, "Sorry, no user exists on our system with that email");
        }

        $token = bin2hex(random_bytes(50));
        $sql = "INSERT INTO pass_reset (email_a, token) VALUES ('$email', '$token')";
        $results = mysqli_query($conn,$sql);

        if($results == true){
            header("Location: blank.php?token=".$token );
        }
}

?>

<html>
    <head>

    </head>
 <body>
<div class="wrapper" style="width: 35%; margin: 0 auto;">
    <form class="form-signin" name="forget_pass_form" action='forgotpassword.php' method="post">
        <h2 class="form-signin-heading">Forgot Password</h2><br />
        <input type="text" class="form-control" name="email" placeholder="Email Your Email" required=""
            autofocus="" />
        <button class="btn btn-small btn-primary btn-block" type="submit">Submit</button>
        <input type="hidden" name="sub_set" value="forgot" />
    </form>
</div>

</body>

</html>