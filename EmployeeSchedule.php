<?php
include('db.php');
include('headerSupervisor.php');
$employeeID = $_GET['id'];
$workHours = $_GET['workHours'];
$workLocation = $_GET['workLocation'];
$query ="SELECT * FROM employee WHERE employeeID='$employeeID'";

$result = $db->query($query);
if($result->num_rows> 0){
    $employees= mysqli_fetch_all($result, MYSQLI_ASSOC);
  }else{
   $employees=[];
  }

?>
<?php
// Form submit
if (isset($_POST['submitForm'])) 
{
    $comments = filter_input(INPUT_POST,'comments',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $sql = "UPDATE dailySchedule SET supervisorComments='$comments' WHERE employeeID='$employeeID'";
    if (mysqli_query($db, $sql)) {
        echo '<script type="text/javascript">';
        echo ' alert("Comments have been added")';  //not showing an alert box.
        echo '</script>';
    } else {
        // error
        echo 'Error: ' . mysqli_error($db);
    }
}
?>
<?php foreach ($employees as $employee) {?>
<main>
    <hr>
    <h3>Employee Daily Schedule Details</h3>
    <label for="name"> Employee Name: <?php echo $employee['name']; ?> </label><br><br><br>
    <label for="empID"> Employee ID: <?php echo $employeeID; ?></label><br><br><br>
    <label for="workHours">Work Hours: <?php echo $workHours; ?></label><br><br><br>
    <label for="workLocation">Work Location: <?php echo $workLocation; ?> </label><br><br><br><hr>

    <form action="" method="POST">
        <div class="form-group input-control">
            <label for="comments">Comments: </label>
            <input type="text" class="form-control form-control-sm" name="comments" id="comments">
            <p>Error message</p>
        </div>

        <input type="submit" name="submitForm" class="btn btn-success" id="submit">
    </form><hr>

    <button type="button" class="btn btn-light"><a href='ReviewEmployeeSchedule.php'>Back</button>
    
<?php }?>
        
</main>
<br>
<?php
 include 'footer.php'; 
?>