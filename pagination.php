<?php
session_start();
?>
<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

include "navbar.html";
include "config.php";



if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
    $page_no = $_GET['page_no'];
} else {
    $page_no = 1;
}

$total_records_per_page = "2";
$offset = ($page_no - 1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";


$result_count = mysqli_query(
    $conn,
    "SELECT COUNT(*) As total_records FROM `employees_info`"
);
$total_records = mysqli_fetch_array($result_count);
$total_records = $total_records['total_records'];
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1; // total pages minus 1
//print_r($total_no_of_pages);

?>

<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" type="text/css" href="./favicon.ico" type="image/x-icon">
    <title> pagination</title>
</head>

<body style="background-color:lightyellow">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>

                <th style='width:150px;'> Employee Name</th>
                <th style='width:50px;'>Email</th>
                <th style='width:150px;'>Address</th>
                <th style='width:150px;'>Gender</th>
                <th style='width:150px;'>States</th>
                <th style='width:150px;'>Programmer</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = " SELECT * from employees_info  LIMIT $offset , $total_records_per_page ";
            $result = $conn->query($sql);
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>
                    <td>".$row['name'] ."</td>
                    <td>".$row['email']."</td>
                    <td>".$row['address']."</td>
                    <td>".$row['gender']."</td>
                    <td>".$row['states']."</td>
                    <td>".$row['programmer']."</td>
                    </tr>";

            }
            mysqli_close($conn);
            ?>
        </tbody>
    </table>

    <div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
        <strong>Page
            <?php echo $page_no . " of " . $total_no_of_pages; ?>
        </strong>


        <ul class="pagination">
            <?php if ($page_no > 1) {
                echo "<li><a href='pagination.php?page_no=1'>First Page</a></li>";
            } ?>

            <li <?php if ($page_no <= 1) {
                echo "class='disabled'";
            } ?>>
                <a <?php if ($page_no > 1) {
                    echo "href='?page_no=$previous_page'";
                } ?>>Previous</a>
            </li>


            <?php
            if ($total_no_of_pages <= 10) {
                for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
                    if ($counter == $page_no) {
                        echo "<li class='active'><a>$counter</a></li>";
                    } else {
                        echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                    }
                }
            }
            ?>

            <li <?php if ($page_no >= $total_no_of_pages) {
                echo "class='disabled'";
            } ?>>
                <a <?php if ($page_no < $total_no_of_pages) {
                    echo "href='?page_no=$next_page'";
                } ?>>Next</a>
            </li>

            <?php if ($page_no < $total_no_of_pages) {
                echo "<li><a href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
            } ?>
           
            
        </ul>

    </div>

    <?php
    include "footer.html";
?>
</body>

</html>