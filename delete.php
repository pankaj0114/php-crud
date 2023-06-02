<?php 
//delete page for crud .....html and css cahnge required

include "config.php"; 

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "DELETE FROM `employees_info` WHERE `id`='$id'";

     $result = $conn->query($sql);

     if ($result == TRUE) {


        //echo "Employee Record Deleted Successfully !!!!";



    }else{

        echo "Error:" . $sql . "<br>" . $conn->$err;

    }

} 
   
?>
<html>
    <head>

    </head>
    <body style="background-color:lightyellow ; text-align:center ">
        <b><h1 style="text-align:center; color: #008080; ">Employee Record deleted Successfully.</h1></b>
        <img class ="img" src="https://img.icons8.com/?size=512&id=23446&format=png" style=" padding-left:10%" alt="logo">
        <p><h2 style="color: crimson"> Thanks for visiting Dashboard !!</h2></p>
        <p><h2 style="color: crimson"><a href="index.php">Back to home Page</a></h2></p>

         </body>

         <?php
         include "footer.html";
         ?>

</html>
