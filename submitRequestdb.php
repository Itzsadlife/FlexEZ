<?php
include('db.php');
if(isset($_POST['submit'])){
    $status=$_POST['status'];
    $employeeID=$_GET['id'];
    $requestID=$_GET['rID'];
    $workType=$_GET['workType'];
    if($status === "Accept"){
        $updateRequest = "UPDATE request SET FWAstatus = '$status' WHERE requestID = '$requestID'";
        $updateFWAstatus = "UPDATE employee SET FWAstatus = '$workType' where employeeID = '$employeeID'";
        mysqli_query($db, $updateRequest);
        mysqli_query($db,$updateFWAstatus);
        header('Location: ReviewRequest.php');
        exit();
    }
    elseif($status === 'Reject'){
        $updateRequest = "UPDATE request SET FWAstatus = '$status' WHERE requestID = '$requestID'";
        $updateFWAstatus = "UPDATE employee SET FWAstatus = 'NONE' where employeeID = '$employeeID'";
        mysqli_query($db, $updateRequest);
        mysqli_query($db,$updateFWAstatus);
        header('Location: ReviewRequest.php');
        exit();
    }
}
?>
