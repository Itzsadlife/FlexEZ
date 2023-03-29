<?php include 'headerEmployee.php';
include 'db.php';
session_start();
$_SESSION['employeeID'];
include('fetchDataUpdateSchedule.php');

?>

                <main>
                        <hr>
                        <h1>Update Daily Schedule</h1><br><hr>
                        <h3>Date Available</h3>
                    <form action="UpdateDailySchedule.php" method="POST">
                        <?php
                        echo "<select name='date'>
                                    <option value=''>Available Date</option>";
                        $query ="SELECT * FROM dailySchedule WHERE employeeID='$_SESSION[employeeID]'";
                        $result = mysqli_query($db, $query);
                        foreach ($result as $row) {
                            echo "<option value='" . $row['date'] . "'>" . $row['date'] . "</option>";
                        }
                        
                        ?>                    
                        <?php
                            echo"</select>";
                        ?>
                    <input type="submit" name="submit">
                    </form>
                <br>
                <hr>

<?php
// Form submit
if (isset($_POST['submitForm'])) 
{
    $workHours = filter_input(INPUT_POST,'workHours', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $workLocation = filter_input(INPUT_POST,'workLocation',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $workReport = filter_input(INPUT_POST,'workReport',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $sql = "UPDATE dailySchedule SET workHours='$workHours', workLocation='$workLocation', workReport='$workReport' WHERE employeeID='$_SESSION[employeeID]'";
    if (mysqli_query($db, $sql)) {
        // success
        //header('Location: EmployeeHome.php');
        echo '<script type="text/javascript">';
        echo ' alert("Schedule have been updated")';  //not showing an alert box.
        echo '</script>';
    } else {
        // error
        echo 'Error: ' . mysqli_error($db);
    }
}
?>

<?php
if(isset($employees)>0)
{
?>
        <h3>Daily Schedule</h3>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" data-column="employeeID" data-order="desc">Employee ID </th>
                                <th scope="col" data-column="workLocation" data-order="desc">Work Location</th>
                                <th scope="col" data-column="workHours" data-order="desc">Work Hours</th>
                                <th scope="col" data-column="workReport" data-order="desc">Work Report</th>
                            </tr>
                        </thead>
                        <tbody id="tableEmployee">

                            <?php
                            if(count($employees)>0)
                            {
                            foreach ($employees as $employee) {
                            ?>
                            <tr>
                            <td><?php echo $employee['employeeID']; ?></td>
                            <td><?php echo $employee['workLocation']; ?></td>
                            <td><?php echo $employee['workHours']; ?></td>
                            <td><?php echo $employee['workReport']; ?></td>
                            </tr>
                            <?php
                            }
                            }else{
                            echo "<tr><td colspan='3'>No Data Found</td></tr>";
                            }
                            ?>
                            </table>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table><hr><br><br><br>
                <hr>

    <form method="POST" action="">
            <fieldset class="border p-2">
                <div class="form-group input-control">
                    <label for="workLocation">Work Location: </label>
                    <input type="text" class="form-control form-control-sm" name="workLocation" id="workLocation">
                    <p>Error message</p>
                </div>
                <div class="form-group input-control">
                    <label for="workHours">Work Hours: </label>
                    <input type="text" class="form-control form-control-sm" name="workHours" id="workHours">
                    <p>Error message</p>
                </div>
                <div class="form-group input-control">
                    <label for="workReport">Work Report: </label>
                    <input type="text" class="form-control form-control-sm" name="workReport" id="workReport">
                    <p>Error message</p>
                </div>
                <input type="submit" name="submitForm" class="btn btn-success" id="submit">
            </fieldset>
        </form><br><hr>
        <button type="button" class="btn btn-success"><a href='EmployeeHome.php'>Back</button><br><br>
                        </div>

<?php include('footer.php');?>