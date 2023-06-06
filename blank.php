<!--
    Blank page to given link to Reset password  on that page..
-->

<?php
//echo "http://localhost/pankaj/passwordreset.php?token=".$_GET['token'];
?>


<html>
    <head>

    </head>
    <body style ="text-align:center; background-color:lightyellow">
  <h4> <p style =" font-size:60px ; color:#239CE7 "> Password Reset Link : </p> </h4>
   <a href="<?php echo "http://localhost/pankaj/passwordreset.php?token=".$_GET['token']; ?>">
   <b> <p style="font-size:30px"> Click to Reset Your Password</p></b>
    </a>
    </body>
</html>

