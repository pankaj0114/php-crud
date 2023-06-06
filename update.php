      <?php

      //error_reporting(E_ALL);
      //ini_set('display_errors', 1);
      include "navbar.html";
      include "config.php";
      session_start();
      if (empty($_SESSION['email']) || $_SESSION['email'] == '') {
        header("Location:login.php");

      }

      if (isset($_POST['update'])) {

        $id = $_GET['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $states = $_POST['states'];
        $sql = "UPDATE employees_info SET name='$name',email='$email',address='$address',gender='$gender',
        states='$states' WHERE id = $id";
        $result = $conn->query($sql);
        if ($result == TRUE) {
          echo "Record updated successfully.";
          header("Location:index.php");
        }
      }

      if (isset($_GET['id'])) {

        $id = $_GET['id'];

        $sql = "SELECT * FROM `employees_info` WHERE `id`='$id'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

          while ($row = $result->fetch_assoc()) {

            $name = $row['name'];

            $email = $row['email'];
            $address = $row['address'];

            $gender = $row['gender'];
            $states = $row['states'];
            $id = $row['id'];


          }

        }
      }

?>

        <!-- HTML code start from here -->

        <!DOCTYPE html>
        <html lang="en">

        <head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
          <link rel="stylesheet" href="./style.css">
          <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
          <title>PHP CRUD Operations</title>
        </head>

        <body style="background-color:lightyellow">

          <h2 style="color:#0b5ed7; text-align:center; font-weight:bold"> Update Employee Information </h2>
          </p>
          <div class="container">
            <div class="row justify-content-center mt-5">
              <div class="col-lg-6">
                <form method="post">
                  <div class="row gy-6">
                    <div>
                      <b><label for="name" class="form-label"> Employee Name</label></b>
                      <input type="text" class="form-control" name="name" id="name" value="<?php echo $name; ?>">
                    </div>
                    <div>
                      <br>
                      <b><label for="email" class="form-label"> Email </label></b>
                      <input type="email" class="form-control" name="email" id="email" value="<?php echo $email; ?>">
                    </div>
                    <div>
                      <br>
                      <b><label for="address" class="form-label">Address</label></b>
                      <input type="text" class="form-control" name="address" id="addres" value="<?php echo $address; ?>">
                    </div>
                    <div>
                      <br>
                      <b><label for="gender" class="form-label">Gender</label></b> &nbsp; &nbsp; &nbsp;
                      <input type="radio" name="gender" value="Male" <?php if ($gender == 'Male') {
                        echo "checked";
                      } ?>>Male
                      &nbsp; &nbsp; &nbsp;
                      <input type="radio" value="Female" name="gender" <?php if ($gender == 'Female') {
                        echo "checked";
                      } ?>>Female
                    </div>
                    <div>
                      <br>
                      <b><label for="states" class="form-label">State</label></b>
                      <select name="states" class="form-select" id="state">
                        <option>Select State</option>
                        <option name="states" value="Punjab" <?php if ($states == 'Punjab') 
                        {
                          echo "selected";
                        } ?>>Punjab

                        <option name="states" value="Haryana" <?php if ($states == 'Haryana')
                         {
                          echo "selected";
                        } ?>>Haryana

                <option name=" states" value="Delhi" <?php if ($states == 'Delhi') {
                  echo "selected";
                } ?>>Delhi

                <option name=" states" value="Goa" <?php if ($states == 'Goa') {
                  echo "selected";
                } ?>>Goa
              </select>
              <br>
              <div>
                <button type="update" name="update" class="btn btn-primary" style="width:100%">
                Update the Employee Information </button>
              </div>
            </div>
        </form>

              </div>
            </div>
          </div>
        </body>

        </html>

        <?php
        include "footer.html";
        ?>