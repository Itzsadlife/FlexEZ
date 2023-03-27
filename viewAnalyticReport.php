<?php 
include 'headerSupervisor.php';
include 'db.php';
session_start(); 

//fetch data that belongs to supervisor deptID
$data = " SELECT * FROM employee WHERE employeeID = '$_SESSION[employeeID]'";
$loginData = mysqli_query($db, $data);
$row = $loginData->fetch_assoc();
$deptID = $row['deptID'];

// table
$sql = "SELECT * FROM employee, department 
        WHERE employee.deptID = '$deptID'  
        AND employeeID NOT LIKE 'S%' 
        AND employeeID NOT LIKE 'H%'
        AND '$deptID' = department.deptID
        GROUP BY employee.FWAstatus";
$result = mysqli_query($db, $sql);

$sql = "SELECT COUNT(employee.FWAstatus) AS `Total`, employee.*, department.* 
        FROM employee, department 
        WHERE employee.deptID = '$deptID' 
        AND employee.FWAstatus = 'Work From Home' 
        AND department.deptID = employee.deptID";
$workFromHome = mysqli_query($db, $sql);

$sql = "SELECT COUNT(employee.FWAstatus) AS `Total`, employee.*, department.* 
        FROM employee, department 
        WHERE employee.deptID = '$deptID' 
        AND employee.FWAstatus = 'FlexiHours' 
        AND department.deptID = employee.deptID";
$flexihours = mysqli_query($db, $sql);

$sql = "SELECT COUNT(employee.FWAstatus) AS `Total`, employee.*, department.* 
        FROM employee, department 
        WHERE employee.deptID = '$deptID' 
        AND employee.FWAstatus = 'Hybrid' 
        AND department.deptID = employee.deptID";
$hybrid = mysqli_query($db, $sql);
?>

<main>
  <form>
    <?php
    echo "
      <table class='table'> 
        <thead>
          <tr>
            <th scope='col'>FWA Status</th>
            <th scope='col'>Department</th>
            <th scope='col'>Total</th>
          </tr>
        </thead>
    ";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "
          <tr>
            <td>$row[FWAstatus]</td>
            <td>$row[deptName]</td>
        ";

        if ($row['FWAstatus'] === 'Work From Home') {
            while ($workRow = mysqli_fetch_assoc($workFromHome)) {
                echo "<td>$workRow[Total]</td>";
            }
            echo "</tr>";
        } elseif ($row['FWAstatus'] === 'FlexiHours') {
            while ($flexiRow = mysqli_fetch_assoc($flexihours)) {
                echo "<td>$flexiRow[Total]</td>";
            }
            echo "</tr>";
        }else{
            while ($hybridRow = mysqli_fetch_assoc($hybrid)) {
                echo "<td>$hybridRow[Total]</td>";
            }
            echo "</tr>";
        }
    }

    echo "</table>";
    ?>
  </form>
</main>

<?php
include('footer.php');
?>
