<?php 
//logout page for CRUD
session_start();

session_unset();

session_destroy();

header("Location: login.php");

?>