<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    if(isset($_POST['password']) && isset($_POST['confirm_password']))
    {
        $new_password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
    
        $update_password_sql = "UPDATE employee SET password='$new_password', FWAstatus='NONE' WHERE employeeID='$_SESSION[employeeID]'";
        
        if (mysqli_query($db, $update_password_sql)) 
        {
            // Redirect to the home page if password update is successful
            echo "Updated password";
            echo "<script>window.location.href='EmployeeHome.php'</script>";

        } else {
            // Display error message if update fails
            echo "Failed to update password.";
        }
    }
}
?>