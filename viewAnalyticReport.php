<?php 
include 'headerSup.php';
include 'db.php';
session_start(); 
//fetch data that belongs to supervisor deptID
$data = " SELECT * FROM employee WHERE employeeID = '$_SESSION[employeeID]'";
$loginData=mysqli_query($db,$data);
$row = $loginData->fetch_assoc();
$deptID = $row['deptID'];
//table
$sql = "SELECT * FROM employee WHERE employee.deptID = '$deptID'  AND employeeID NOT LIKE 'S%'";
$result=mysqli_query($db,$sql);
?>

<main>
    <form>
    <?php
    if (mysqli_num_rows($result) > 0) {
    //echo "<table><tr><th>Employee ID</th><th>Employee Name</th></tr>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>".$row["employeeID"].
    ";
";}
    }
    ?>

    </form>

</main>


<?php
    include('footerkai.php');
?>