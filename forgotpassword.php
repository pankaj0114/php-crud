<?php
include "config.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['forget_pass_form'])){
    $email = $_POST['email'];
        session_start();
        /*
$login = "";
$query = "SELECT * from  users where (email = '$login')"; 
$res = mysqli_query($conn,$query);
$count=mysqli_num_rows($res);
//echo $count;



if($count==1)

{
    */
    $login ="";
$findresult = mysqli_query($conn, "SELECT * FROM users WHERE ( email = '$login')");
if($res = mysqli_fetch_array($findresult))
{
$logemail = $res['email'];  
}
$token = bin2hex(random_bytes(50));
 $inresult = mysqli_query($conn,"INSERT INTO `pass_reset`( email_a, token) 
 VALUES ('$logemail','$token') ");
}






?>

<html>
    <head>

    </head>
 <body>
<div class="wrapper" style="width: 35%; margin: 0 auto;">
    <form class="form-signin" name="forget_pass_form" action='passwordreset.php' method="post">
        <h2 class="form-signin-heading">Forgot Password</h2><br />
        <input type="text" class="form-control" name="email" placeholder="Email Your Email" required=""
            autofocus="" />
        <button class="btn btn-small btn-primary btn-block" type="submit">Submit</button>
        <input type="hidden" name="sub_set" value="forgot" />
    </form>
</div>

</body>

</html>