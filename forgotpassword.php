<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//include"navbar.html";

?>

<html>

<head>

</head>

<body>
    <h1 style="text-align:center">Forgot password</h1>
    <P style="text-align:center" >Forgot your paswsord. Please Enter the Email adddress So you able to get
    the password reset page .
    </P>
    <form action= "passwordreset.php" method="post" style="text-align:center">

        <?php if (isset($_GET['err'])) {

            $err = $_GET['err'];
            echo '<p class="errmsg">No user found. </p>';
        }

       
      
        ?>
           <?php 

           if(!isset($_GET['sent'])) 
           {
            ?>
            <div class="email-address">

                <input type="email" class="form-control" name="login_var" placeholder = " Your Email Address" required>
            </div>

            <div>
                <button type="submit"  name="subforgot" style="width:20% ;text-align:center"> Change Password Link  </button>
              
            </div>

            <?php
           
                  }

                 include "footer.html";
            ?>


          
</body>

</html>

