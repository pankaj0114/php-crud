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

    $sql = "SELECT email_a FROM pass_reset WHERE token='$token' LIMIT 1";
    $results = mysqli_query($conn, $sql);
    $email_a = mysqli_fetch_assoc($results)['email_a'];

    if ($email_a) {
      $sql = "UPDATE users SET password='$password' WHERE email='$email_a'";
      $results = mysqli_query($conn, $sql);
      header('location: index.php');
      $sql = "DELETE FROM pass_reset WHERE email='$email_a'";
      $results = mysqli_query($conn, $sql);
    }
  }
}



?>
<html>

<heAD>

</heAD>

<body>
  <h4> Password reset form </h4>
  <div class="login_form">
    <form action="passwordreset.php?token=<?php echo $token; ?>" method="POST">
      <div class="form-group">


        <?php if (!isset($hide)) { ?>
          <label class="label_txt">Password </label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
          <label class="label_txt">Confirm Password </label>
          <input type="password" name="cpassword" class="form-control" required>
        </div>
        <button type="submit" name="reset_password">Reset Password</button>
      <?php } ?>
    </form>
  </div>

</body>

</html>