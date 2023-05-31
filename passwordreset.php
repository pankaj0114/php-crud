<?php   
error_reporting(E_ALL);
ini_set('display_errors', 1);
        include "config.php";
       
        if(isset($_POST['sub_set'])){
          $password =" ";
          $logemail=" ";
        $cpassword =" ";
          
          $updateppassword = " UPDATE users SET password='$password' ,cpassword= '$cpassword'
                            WHERE email= 'logemail' ";

            $conn-> query($updateppassword);
}
    
?>
<html>
    <heAD>
        
    </heAD>
    <body>
        <h4> Password reset form </h4>
        <div class="login_form">
		<form action="passwordreset.php" method="POST">
  <div class="form-group">
  
    
<?php if(!isset($hide)){ ?>
    <label class="label_txt">Password </label>
      <input type="password" name="password" class="form-control" required>
  </div>
   <div class="form-group">
    <label class="label_txt">Confirm Password </label>
      <input type="password" name="Cpassword" class="form-control" required  >
  </div>
  <button type="submit" name="sub_set" >Reset Password</button>
  <?php } ?>
</form>
</div>

    </body>
</html>