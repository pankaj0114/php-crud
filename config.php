<?php
// this is the database connection file include on the every page of this folder  

$servername = "localhost";

$username = "pankaj"; 

$password = "password"; 

$dbname = "employees"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

}


?> 
