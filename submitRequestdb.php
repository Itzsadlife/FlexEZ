<?php
include('db.php');
if(isset($_POST['submit'])){
    $status=$_POST['status'];
    $employeeID=$_GET['id'];
    $requestID=$_GET['rID'];
    if($status === "Accept"){
        $sql = "UPDATE request SET FWAstatus = '$status' WHERE requestID = '$requestID'";
        mysqli_query($db, $sql);
        header('Location: ReviewRequest.php');
        exit();
    }
    elseif($status === 'Reject'){
        $sql = "UPDATE request SET FWAstatus = '$status' WHERE requestID = '$requestID'";
        mysqli_query($db, $sql);
        header('Location: ReviewRequest.php');
        exit();
    }
}
?>
