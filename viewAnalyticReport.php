<?php 
include 'headerSupervisor.php';
include 'db.php';
session_start(); 

//fetch data that belongs to supervisor deptID
$data = " SELECT * FROM employee WHERE employeeID = '$_SESSION[employeeID]'";
$loginData = mysqli_query($db, $data);
$row = $loginData->fetch_assoc();
$deptID = $row['deptID'];

$sql = "SELECT department.*, employee.*, request.*, COUNT(DISTINCT employee.employeeID) AS num_requests
        FROM request
        INNER JOIN employee ON request.employeeID = employee.employeeID
        INNER JOIN department ON employee.deptID = department.deptID
        WHERE request.FWAstatus <> 'Pending' AND request.FWAstatus <> 'Reject' 
        AND employee.deptID = '$deptID'
        GROUP BY request.requestID";
$result = mysqli_query($db,$sql);
// table
?>


<main>
  <form>
  <div class="row">
      <h3>View FWA Analytic</h3>
    <?php
    echo "<table class='table'>";
    echo "<tr>
    <th>Date</th>
    <th>FWA Status</th>
    <th>Department</th>
    <th>Number of Requests</th>
    </tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        $requestDate = $row['requestDate'];
        $numRequests = $row['num_requests'];
        $deptName = $row['deptName'];
        $fwaStatus = $row['workType'];
        
        echo "<tr>
        <td>$requestDate</td>
        <td>$fwaStatus</td>
        <td>$deptName</td>
        <td>$numRequests</td></tr>";
    }
    echo "</table>";    
    ?>

<?php
//sql for searching date
  $schedule = "
  SELECT * FROM dailyschedule
  INNER JOIN employee ON dailyschedule.employeeID = employee.employeeID
  INNER JOIN department ON employee.deptID = department.deptID
  WHERE department.deptID = '$deptID'
  ";
  $scheduleFetch = mysqli_query($db, $schedule);

  if (isset($_GET['start-date']) && isset($_GET['end-date'])) {
    // Get start and end dates from form input
    $startDate = $_GET['start-date'];
    $endDate = $_GET['end-date'];
    // Add date range filter to SQL query
    $schedule .= " AND date BETWEEN '$startDate' AND '$endDate'";
  }
  $schedule .= " ORDER BY date ASC";
  $scheduleFetch = mysqli_query($db, $schedule);
  ?>

  <main class="container">

    <form method="GET" action="viewAnalyticReport.php">
      <div class="row">
      <h3>View Employee Schedule</h3>
        <div class="col-sm-5">
          <div class="form-group">
            <label for="start-date">Start Date:</label>
            <input type="date" class="form-control" name="start-date" id="start-date" date_format="yyyy-mm-dd">
          </div>
        </div>
        <div class="col-sm-5">
          <div class="form-group">
            <label for="end-date">End Date:</label>
            <input type="date" class="form-control" name="end-date" id="end-date" date_format="yyyy-mm-dd">
          </div>
        </div>
        <div class="col-sm-2">
        </div>
        <div class="col-sm-12">
            <button type="submit" class="btn btn-primary btn-block col-sm-3" name="search" id="search">Search</button>
            <br>
          </div>
        </div>
    </form>

    <table class="table">
      <thead>
        <tr>
          <th>Date</th>
          <th>Work Location</th>
          <th>Work Hours</th>
          <th>Department</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($scheduleFetch)) {
          echo "
          <tr>
            <td>$row[date]</td>
            <td>$row[workLocation]</td>
            <td>$row[workHours]</td>
            <td>$row[deptName]</td>
            ";
        }
        ?>
    </table>
    <button class="btn btn-primary btn-block col-sm-3"><a href="supervisorDashBoard.php" style="color:white">Back To Home</a></button>
    <br>
    </div>
</main>

<?php
include('footer.php');
?>
