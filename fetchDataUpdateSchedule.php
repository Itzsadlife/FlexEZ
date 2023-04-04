<?php
include('db.php');
/// edit data
if(isset($_POST['date']) && isset($_POST['submit'])){
    $employeeID= $_POST['date'];
    $query ="SELECT * FROM dailySchedule WHERE employeeID='$_SESSION[employeeID]' AND date='$_POST[date]'";
    $result = $db->query($query);
    if($result->num_rows> 0){
      $employees= mysqli_fetch_all($result, MYSQLI_ASSOC);
    }else{
     $employees=[];
    }
}
?>
