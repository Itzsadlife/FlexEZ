<?php include 'header.php';
include 'db.php';
?>

<?php
// Form submit
if (isset($_POST['submitForm'])) 
{
    $EmployeeID = filter_input(INPUT_POST,'EmployeeID', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $EmployeeName = filter_input(INPUT_POST,'EmployeeName',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pw = filter_input(INPUT_POST,'pw',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $EmployeePosition = filter_input(INPUT_POST,'EmployeePosition',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $Email = filter_input(INPUT_POST,'Email',FILTER_SANITIZE_EMAIL);
    $SupervisorID = filter_input(INPUT_POST,'SupervisorID',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $deptID = filter_input(INPUT_POST,'deptID',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $sql = "INSERT INTO employee (employeeID, password, name, position, email, SupervisorID, deptID) 
        VALUES ('$EmployeeID', '$pw', '$EmployeeName', '$EmployeePosition', '$Email', '$SupervisorID', '$deptID')";
    if (mysqli_query($db, $sql)) {
        // success
        header('Location: Submit.php');
    } else {
        // error
        echo 'Error: ' . mysqli_error($db);
    }
}
?>

<main>
    <hr>
    <div id="EmployeeForm">
        <h3>Register Employee</h3>
        <hr>
        <form id="empForm" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
            <fieldset class="border p-2">
                <div class="form-group input-control">
                    <label for="deptID">Please select the department ID: </label>
                    <select class="form-select" name="deptID" id="deptID">
                        <option selected value="department0"> Department ID </option>
                        <option value="D0001"> D0001 </option>
                        <option value="D0002"> D0002 </option>
                        <option value="D0003"> D0003</option>
                    </select>
                    <p>Error message</p>
                </div>
                <div class="form-group input-control">
                    <label for="EmployeeID">Employee ID </label>
                    <input type="text" class="form-control form-control-sm" name="EmployeeID" id="EmployeeID">
                    <p>Error message</p>
                </div>
                <div class="form-group input-control">
                    <label for="pw">Create a new password </label>
                    <input type="text" class="form-control form-control-sm" name="pw" id="pw">
                    <p>Error message</p>
                </div>
                <div class="form-group input-control">
                    <label for="EmployeeName">EmployeeName </label>
                    <input type="text" class="form-control form-control-sm" name="EmployeeName" id="EmployeeName">
                    <p>Error message</p>
                </div>
                <div class="form-group input-control">
                    <label for="SAposition">Position</label>
                    <input type="text" class="form-control form-control-sm" name="EmployeePosition" id="EmployeePosition">
                    <p>Error message</p>
                </div>
                <div class="form-group input-control">
                    <label for="Email">Email </label>
                    <input type="text" class="form-control form-control-sm" name="Email" id="Email">
                    <p>Error message</p>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-6 input-control">
                        <label for="SupervisorID">Supervisor ID (if available) </label>
                        <input type="text" class="form-control form-control-sm" name="SupervisorID" id="SupervisorID">
                    </div>
                    <div class="form-group col-sm-6 input-control">
                        <label for="SupervisorName">Supervisor Name</label>
                        <input type="text" class="form-control form-control-sm" name="SupervisorName" id="SupervisorName">
                    </div>
                </div>
                <input type="submit" name="submitForm" class="btn btn-success" id="submit">
            </fieldset>
        </form>
    </div>
</main>
<br>
<?php include 'footer.php'; ?>