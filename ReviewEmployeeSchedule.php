<?php include 'headerSupervisor.php';
include 'db.php';
include('fetchDataReviewSchedule.php');
?>
                    <main>
                        <hr>
                        <h1>Review Employee Schedule</h1><br><hr>
                        <h3>Date Available</h3>
                    <form action="ReviewEmployeeSchedule.php" method="POST">
                        <?php
                        echo "<select name='date'>
                                    <option value=''>Available Date</option>";
                        $query ="SELECT * FROM dailySchedule";
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
if(isset($employees)>0)
{
?>
        <h3>Employee Supervised</h3>
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
                            <td><a href="EmployeeSchedule.php?employeeID=<?php echo $employee['employeeID'];?>
                            &workLocation=<?php echo $employee['workLocation'];?>&workHours=<?php echo $employee['workHours'];?>
                            "><?php echo $employee['employeeID']; ?></td>
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
                    <button type="button" class="btn btn-light"><a href='SupervisorDashboard.php'>Back</button>

                </div>
<?php include('footer.php');?>