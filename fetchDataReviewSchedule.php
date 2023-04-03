<?php
include('db.php');
/// edit data
if(isset($_POST['date']) && isset($_POST['submit'])){
    $date= $_POST['date'];
    $query ="SELECT * FROM dailySchedule,employee 
              WHERE employee.employeeID=dailyschedule.employeeID 
              AND SupervisorID='$_SESSION[employeeID]'
              AND date = '$date'";
    $result = $db->query($query);
    if($result->num_rows> 0){
      $employees= mysqli_fetch_all($result, MYSQLI_ASSOC);
    }else{
     $employees=[];
    }
}
?>