<?php
session_start();
include 'headerEmployee.php';
include 'db.php';
// SQL query for Department Name
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

$sqlFWAstatus = "SELECT FWAstatus
        FROM employee
        WHERE employeeID = '$_SESSION[employeeID]'";
// Execute query
$result = $db->query($sqlFWAstatus);

// Get result
$row = $result->fetch_assoc();
$FWAstatus = $row['FWAstatus'];

if ($FWAstatus == 'NEW') {
    // Show popup to change password
    echo '
        <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="newFWAstatus.php" method="POST">
                            <div class="form-group">
                                <label for="password">New Password:</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password:</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                            </div>
                            <div id="password-validation-messages"></div>
                            <input type="submit" class="btn btn-primary" name="change_password" id="change-password-btn" value="Change Password" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $("#changePasswordModal").modal("show");
            });

            $("#change-password-btn").click(function(e) {
                e.preventDefault();

                var new_password = $("#password").val();
                var confirm_password = $("#confirm_password").val();

                var error_messages = "";

                if (new_password.length == 0 || confirm_password.length == 0) {
                    error_messages += "<div class=\"alert alert-danger\" role=\"alert\">Please enter a new password and confirm it.</div>";
                } else if (new_password !== confirm_password) {
                    error_messages += "<div class=\"alert alert-danger\" role=\"alert\">New password and confirm password do not match.</div>";
                }

                if (error_messages.length > 0) {
                    $("#password-validation-messages").html(error_messages);
                } else {
                    $("#password-validation-messages").html("");
                    $("form").submit();
                }
            });
        </script>';
}
?>

<main>
    <hr>
    <h3>Welcome to the Employee Dashboard</h3>
    <label for="name"> <?php echo "Employee Name : $_SESSION[name] "; ?> </label><br><br><br>
    <label for="empID"><?php echo "Employee ID : $_SESSION[employeeID] "; ?> </label><br><br><br>
    <label for="position"><?php echo "Department name: " . $departmentName; ?></label><br><br><br>
    <label for="email"><?php echo "Email: " . $email; ?> </label><br><br><br>

    <button type="button" class="btn btn-success">Edit Profile</button>


</main>
<br>
<?php
include 'footer.php';
?>