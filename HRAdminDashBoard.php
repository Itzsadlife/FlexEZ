<?php include 'header.php';
include 'db.php';
session_start(); 
$sql = "SELECT department.deptName
        FROM department
        JOIN employee ON department.deptID = employee.deptID
        WHERE department.deptID = employee.deptID
        AND employee.employeeID = '$_SESSION[employeeID]'";

// Execute query
$result = $db->query($sql);

// Get result
$row = $result->fetch_assoc();
$departmentName = $row['deptName'];

// SQL QUERY FOR EMAIL
$sqlEmail = "SELECT email
        FROM employee
        WHERE employeeID = '$_SESSION[employeeID]'";
// Execute query
$result = $db->query($sqlEmail);

// Get result
$row = $result->fetch_assoc();
$email = $row['email'];

if (isset($_SESSION['employeeID']) && isset($_SESSION['name'])) {
    ?>


<main>
    <hr>
    <h3>Welcome to the HR Admin Dashboard</h3>
    <label for="name"> <?php echo "Employee Name : $_SESSION[name] ";?> </label><br><br><br>
    <label for="empID"><?php echo "Employee ID : $_SESSION[employeeID] ";?> </label><br><br><br>
    <label for="position"><?php echo "DepartmentName : $departmentName ";?></label><br><br><br>
    <label for="email"><?php echo "Email : $email ";?> </label><br><br><br>

    <button type="button" class="btn btn-success">Edit Profile</button>

        
</main>
<br>
<?php
 include 'footer.php'; 
}
?>