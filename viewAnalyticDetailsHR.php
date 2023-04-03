<?php
include 'headerHR.php';
include 'db.php';
session_start();

$sql = "SELECT name,employee.employeeID,deptName,requestID,requestDate,employee.FWAstatus FROM employee 
inner join request on request.employeeID = employee.employeeID 
inner join department on employee.deptID = department.deptID
WHERE requestDate ='$_GET[date]' 
AND workType='$_GET[workType]'
AND request.FWAstatus = 'Accept'
AND deptName = '$_GET[deptName]'
";

$result = mysqli_query($db,$sql);
?>

<main>
    <?php
    echo "<table class='table'>";
    echo "
     <tr>
     <th>Date</th>
     <th>Employee ID</th>
     <th>Request ID</th>
     <th>Name</th>
     <th>Status</th>
     </tr>";

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "
         <tr>
         <td>$row[requestDate]</td>
         <td>$row[employeeID]</td>
         <td>$row[requestID]</td>
         <td>$row[name]</td>
         <td>$row[FWAstatus]</td>
         </tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No data found</td></tr>";
    }
    echo "</table>";
    ?>
    <a href='viewAnalyticReportHR.php'><button class = 'btn btn-primary'>Back</button></a>
</main>

<?php
include 'footer.php';
?>