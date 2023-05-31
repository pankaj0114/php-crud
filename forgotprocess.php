<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


$req = $_POST; 
$email="";
$email = $req['email'];

include "config.php";
//echo "ghghi";

session_start();
if($_REQUEST['object'] == 'forgot'){ 
if($_REQUEST['newpassword'] == $req['confirmpassword']) {
    
    $SODIUM_CRYPTO_PWHASH_OPSLIMIT_INTERACTIVE="";
   // $SODIUM_CRYPTO_PWHASH_MEMLIMIT_INTERACTIVE="";

		$hash = sodium_crypto_pwhash_str(
			$password,
			$SODIUM_CRYPTO_PWHASH_OPSLIMIT_INTERACTIVE,
			$SODIUM_CRYPTO_PWHASH_MEMLIMIT_INTERACTIVE
		);
        $email =""; 
        $update = "UPDATE `users` SET 'password' = '$hash' WHERE email= '$email' ";
        $result = mysqli_query($conn, $update);
        $_SESSION['msg'] = 'Your new password has reset successfully, you can now login.';
        header("Location: index.php");
    } else {
        $_SESSION['msg'] = 'Password does not match';
        header("Location: index.php");
    }
}




?>
 