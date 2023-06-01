<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include "navbar.html";
include "config.php";
session_start();
$where = "";
if ((isset($_POST['save']))) {
  if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $where = " WHERE name like '%$search%' OR email like '%$search%' ";
  }
}

$sql = "SELECT * FROM employees_info " . $where;
$result = $conn->query($sql);
if (empty($_SESSION['email']) || $_SESSION['email'] == '') {
  header("Location:login.php");
}
?>
<?php
$employeesdata = "";
$searchErr = " ";
$name = "";
$email = "";
$search = " ";


if ((isset($_POST['save']))) {

  if (isset($_POST['search'])) {

    $search = $_POST['search'];

    $sql = "SELECT *from employees_info WHERE name like '%$search%' OR email like '%$search%'   ";
    //$result = $conn->query($sql);
    $employeesdata = []; //$result -> fetch_all(MYSQLI_ASSOC);

    //print_r($employeesdata);

  } else {
    $searchErr = " Please send something";
  }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.1/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <link rel="shortcut icon" type="text/css" href="./favicon.ico" type="image/x-icon">
  <title>PHP CRUD Operations</title>
</head>

<body style="background-color :lightyellow">
  <h2 style="color:green; text-align:center; font-weight:bold"> Employee Details </h2>
  <div class="container">
    <div class="py-4">
      <ul style="display :flex">
        <li>
          <div class="add-employee">
            <a href="./create.php" class="btn btn-secondary">
              <i class="bi bi-plus-circle-fill"></i> Add Employee
            </a>
        </li>
        <form action="index.php " method="post" style="padding-left:500px">
          <li>
            <div class="search-box" style="margin-top:0 ; padding-right:50px">
              <button class="btn-search " name="save">
                <p style="text-align:center">🔎 </p><i class="fas fa-search"></i>
              </button>
              <input type="text" class="input-search" name="search" placeholder="Type to Search...">
            </div>
    
    <!--
                <div class="search-bar" style="margin-top:0 ; padding-right:50px">
                  <input type="text" class="form-control" name="search" placeholder="Search here">
                </div>
                <div>
                  <button type="submit" method="post" action=" index.php " name="save" class="btn btn-primary"
                    style="width:85% ;text-align:center"> Search </button>
                </div>
    -->

          </li>
      </ul>
    </div>
    <div class="form-group">
      <span class="error" style="color:red ">
        <?php echo $searchErr; ?>
      </span>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th> Employee Name </th>
          <th>Email</th>
          <th>Address</th>
          <th>Gender</th>
          <th>State</th>
          <th>Programmer</th>
          <?php if (!isset($_POST['search']) && empty($_POST['search'])) { ?>
            <th> Actions </th>
          <?php } ?>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
              <td>
                <?php echo $row['name']; ?>
              </td>
              <td>
                <?php echo $row['email']; ?>
              </td>
              <td>
                <?php echo $row['address']; ?>
              </td>
              <td>
                <?php echo $row['gender']; ?>
              </td>
              <td>
                <?php echo $row['states']; ?>
              </td>
              <td>
                <?php echo $row['programmer']; ?>
              </td>
              <?php if (!isset($_POST['search']) && empty($_POST['search'])) { ?>
                <td><a class="btn btn-info" href="update.php?id=<?php echo $row['id']; ?>">Edit</a>
                  &nbsp;
                  <a class="btn btn-danger" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
                </td>
                <?php
              }
          }
        }
        ?>
        </tr>
      </tbody>

      <tbody>

        <?php
        if (!$employeesdata) {

        } else {
          foreach ($employeesdata as $value) {
            ?>
            <tr>
              <td>
                <?php echo $value['name']; ?>
              </td>
              <td>
                <?php echo $value['email']; ?>
              </td>
              <td>
                <?php echo $value['address']; ?>
              </td>
              <td>
                <?php echo $value['gender']; ?>
              </td>
              <td>
                <?php echo $value['states']; ?>
              </td>
              <td>
                <?php echo $value['programmer']; ?>
              </td>
            </tr>
            <?php
          }
        }
        ?>
      </tbody>

    </table>

    <?php
    if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
      $page_no = $_GET['page_no'];
    } else {
      $page_no = 1;
    }
    $total_records_per_page = 2;
    //$offset = ($page_no-1)* $total_records_per_page;
    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;
    $adjacents = "2";
    $result_count = mysqli_query(
      $conn,
      " SELECT COUNT(*) As total_records FROM `employees_info`"
    );
    $total_records = mysqli_fetch_array($result_count);
    $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
    $second_last = $total_no_of_pages - 1;
    // total pages minus 1
    //print_r($total_records);
    ?>
    <ul class="pagination">
      <?php if ($page_no > 1) {
        echo "<li><a href='pagination.php?page_no=1'>First Page</a></li>";
      } ?>

      <li <?php if ($page_no <= 1) {
        echo "class='disabled'";
      } ?>>
        <a <?php if ($page_no > 1) {
          echo "href='pagination.php?page_no=$previous_page'";
        } ?>>Previous</a>
      </li>
      <?php
      if ($total_no_of_pages <= 10) {
        for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
          if ($counter == $page_no) {
            echo "<li class='active'><a>$counter</a></li>";
          } else {

            echo "<li><a href='pagination.php?page_no=$counter'>$counter</a></li>";
          }
        }
      }
      ?>
      <li <?php if ($page_no >= $total_no_of_pages) {
        echo "class='disabled'";
      } ?>>
        <a <?php if ($page_no < $total_no_of_pages) {
          echo "href='pagination.php?page_no=$next_page'";
        } ?>>Next</a>
      </li>

      <?php if ($page_no < $total_no_of_pages) {
        echo "<li><a href='pagination.php?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
      } ?>
    </ul>
  </div>
</body>

</html>
<?php
include "footer.html";
?>