<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);


include "config.php";
//echo "ghghi";

if (isset($_POST['subforgot'])) 
{
    $login = $_REQUEST['login_var'];
    $query = "SELECT * from  users where email='$login' ";
    $res = mysqli_query($conn, $query);
    $count = mysqli_num_rows($res);

    $login = $_RESULT ['login_var'];
    $query ="SELECT *from users where email ='$login'";
    
    $res = mysqli_num_rows($res);
       //echo"$count";

    if ($count == 1) {

       $findresult = mysqli_query($conn, " SELECT * FROM users WHERE email = '$login'");
        if ($res = mysqli_fetch_array($findresult)) {
            $oldftemail = $res['email'];
         }


    }

    $token = bin2hex(random_bytes(50));
    
    $oldeftemail =" ";

    $inresult = "INSERT INTO pass_reset(email_a , token ) values ('$oldftemail' , '$token' )"; 
    $conn ->query($inresult);
    
    if($inresult == true)

            {
                //echo "hello";
                header("location:http://localhost/pankaj/passwordreset.php?token=" . $token . " ");
            
                
            }
        
}

?>
 