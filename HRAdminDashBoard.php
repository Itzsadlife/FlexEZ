<?php include 'header.php';
include 'db.php';
session_start(); 

if (isset($_SESSION['employeeID']) && isset($_SESSION['name'])) {
    ?>


<main>
    <hr>
    <h3>Welcome to the HR Admin Dashboard</h3>
    <label for="name"> <?php echo "Employee Name : $_SESSION[name] ";?> </label><br><br><br>
    <label for="empID"><?php echo "Employee ID : $_SESSION[employeeID] ";?> </label><br><br><br>
    <label for="position">Position: HR Admin</label><br><br><br>
    <label for="email">Email: HRAdmin@gmail.com </label><br><br><br>

    <button type="button" class="btn btn-success">Edit Profile</button>

        
</main>
<br>
<?php
 include 'footer.php'; 
}
?>