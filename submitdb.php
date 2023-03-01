<?php 
session_start(); 
$employeeID = $_SESSION['employeeID'];
if(isset($_POST['submit'])){
    
include "db.php";

$query = "INSERT INTO request (requestID, employeeID, requestDate, workType, description, reason, FWAstatus)
            VALUES ('R01', '$employeeID', '2022/02/23', 'Work From Home', 'Description', 'Reason', 'Pending')";

$result=mysqli_query($db,$query);
}
?>