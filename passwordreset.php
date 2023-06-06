<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "config.php";
$token = $_GET['token'];
if (isset($_POST['reset_password'])) {
  $errors = [];
  session_start();
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

  // Grab to token that came from the email link

  $token = $_GET['token'];
  

  if (empty($password) || empty($cpassword))
    array_push($errors, "Password is required");
  if ($password !== $cpassword)
    array_push($errors, "Password do not match");
  if (count($errors) == 0) {
    // select email address of user from the password_reset table 

    $sql = "SELECT email FROM pass_reset WHERE token='$token' LIMIT 1";
    $results = mysqli_query ($conn, $sql);
    $email = mysqli_fetch_assoc($results)['email'];

    if ($email) {
      $sql = "UPDATE users SET password='$password' WHERE email='$email'";
      $results = mysqli_query($conn, $sql);
      header('location: index.php');
      $sql = "DELETE FROM pass_reset WHERE email='$email'";
      $results = mysqli_query($conn, $sql);
    }
  }
}
?>

        
<html>

<heAD>

</heAD>

<body style="text-align:center ; background-color:lightyellow">
  <h4 style=" font-size:60px ; color:#239CE7 "> Reset Password Form</h4>
  <div class="login_form">
    <form action="passwordreset.php?token=<?php echo $token; ?>" method="POST">
      <div class="form-group" style=" text-align: center ; margin-right:8.0%">

        <?php include('messages.php'); ?>
        <?php if (!isset($hide)) { ?>
          <b><label class="label_txt" style="color:#008080 ; font-size:30px ">Change Your Password </label></b>
          <input type="password" name="password" class="form-control" style="font-size:20px" required
            title="Please enter the Required password">
        </div>
        <br>
        <div class="form-group" style="margin-right:8.0%">
          <b><label class="label_txt" style="color:#008080 ; font-size:30px ">Confirm Your Password </label></b>

          <input type="password" name="cpassword" class="form-control" style="font-size:20px ;  " required
            title=" Please enter the Confirm password">

        </div>
        <br>
        <button type="submit" style=" background-color:#16C3C3 ; font-size:30px ; width:30% ; margin-right:8% "
          name="reset_password">Reset Password</button>
      <?php } ?>
    
    </form>
  </div>

</body>

</html>