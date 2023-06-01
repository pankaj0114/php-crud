<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 1);
session_start();
include "navbar.html";
include "config.php";

//if (empty($_SESSION['email']) || $_SESSION['password'] == '') {
  //header("Location:login.php");
//}


if (!empty($_POST)) {
  //$nameErr = null;
  //$emailErr = null;
  //$addressErr = null;
  $name = $_POST['name'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $states = $_POST['states'];
  $gender = $_POST['gender'];
  if (isset($_POST['programmer'])) {
    $programmer = "YES";
  } else {
    $programmer = "NO";
  }
  $valid = true;
  if (empty($name)) {
    $nameErr = 'Please Enter Employee Name';
    $valid = false;
  }
  if (empty($email)) {
    $emailErr = ' Please Enter email address';
    $valid = false;
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $emailErr = " Please Enter valid email address";
    $valid = false;
  }
  if (empty($address)) {
    $addressErr = 'Please Enter Employee Address for Registration... !!';
    $valid = false;
  }
  if ($valid == true) {
    $sql = "INSERT INTO employees_info(name, email, address , gender , states , programmer) 
              values('$name','$email','$address', '$gender', '$states', '$programmer')";
    $q = $conn->query($sql);


    $conn->close();
    header("Location:index.php");
  }
}
?>
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
  <style>
    .error {
      color: red;
    }
  </style>
</head>

<body style="background-color:lightyellow">
  <?php
  $nameErr = $emailErr = $addressErr = "";
  $name = $email = $gender = $address = $states = " ";
  ?>
  <h2 style="color:#0b5ed7; text-align:center; font-weight:bold"> New Employee Registration </h2>
  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-lg-6">
        <form method="post" action="create.php">
          <div class="row gy-6">
            <div>
              <b><label for="name" class="form-label"> Employee Name</label></b>
              <input type="text" class="form-control" name="name" id="name"
                value="<?php echo !empty($name) ? $name : ''; ?>" required title="Please enter the employee name ">
              <?php if (empty($nameErr)): ?>
                <span class="error">
                  <?php echo $nameErr; ?>
                <?php endif; ?>
              </span>
            </div>
            <div>
              <br>
              <b><label for="email" class="form-label"> Email </label></b>

              <input type="email" class="form-control" name="email" id="email" value="<?php echo $email; ?>" required
                title="Please enter the employeee email !">
              <span class="error">
                <?php echo $emailErr; ?>
              </span>
            </div>


            <div>
              <br>
              <b><label for="address" class="form-label">Address</label></b>
              <input type="text" class="form-control" name="address" id="addres" value="<?php echo $address; ?>"
                required>
              <span class="error">
                <?php echo $addressErr; ?>
              </span>


            </div>


            <div>
              <br>
              <b> <label for="gender" class="form-label">Gender</label><b></b>&nbsp; &nbsp; &nbsp;
                <input type="radio" name="gender" value="Male" <?php
                if (isset($gender) && $gender == "Male")
                  echo "checked"; ?> value="Male">Male &nbsp; &nbsp; &nbsp;

                <input type="radio" name="gender" <?php
                if (isset($gender) == "Female")
                  echo "checked";
                ?>
                  value="Female">Female &nbsp; &nbsp; &nbsp;

            </div>

            <div>
              <br>
              <label for="states" class="form-label">State</label>
              <select name="states" class="form-select" id="state" value="<?php echo $states; ?>">
                <option>Select State</option>
                <option name="states" value="Punjab" <?php if (isset($states) && $states == "Punjab")
                  echo "selected"; ?>>
                  Punjab
                </option>
                <option name="states" value="Haryana" <?php if (isset($states) && $states == "Haryana")
                  echo "selected"; ?>>
                  Haryana
                </option>
                <option name="states" value="Delhi" <?php if (isset($states) && $states == " Delhi")
                  echo "selected"; ?>>
                  Delhi
                </option>
                <option name="states" value="Goa" <?php if (isset($states) && $states == "Goa")
                  echo "selected"; ?>>Goa

                </option>
              </select>
            </div>

            <div class="col-lg-6">
              <br>
              <input type="checkbox" name="programmer"> Are you a programmer ? </input>
            </div>

            <div class="col-lg-12 d-grid">
              <br>
              <button type="submit" name="submit" class="btn btn-primary">Add Employee</button>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>
</body>


<br>
<br>
<?php


include "footer.html";

?>

</html>