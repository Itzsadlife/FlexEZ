<?php
include('headerHR.php');
include('db.php');
session_start();

//
$sql = "SELECT DISTINCT department.deptName, request.workType, request.requestDate,COUNT(DISTINCT employee.employeeID) AS total
        FROM request
        INNER JOIN employee ON request.employeeID = employee.employeeID
        INNER JOIN department ON employee.deptID = department.deptID
        WHERE request.FWAstatus ='Accept' ";

if (!isset($_POST['deptName'])) {
  $_POST['deptName'] = 'All Departments';
}

if ($_POST['deptName'] != 'All Departments') {
  $deptName = $_POST['deptName'];
  $sql .= "AND department.deptName = '$deptName' ";
} else {
  $sql .= "AND department.deptID LIKE 'D%'";
}

$sql .= "GROUP BY department.deptName, request.workType, request.requestDate ";
$sql .= "ORDER BY request.requestDate ASC";

$dept = "SELECT * FROM department WHERE deptName!='Human Resources'";
$deptName = mysqli_query($db, $dept);


$result = mysqli_query($db, $sql);
?>

<title>FlexEZ | Analytic Report</title>
<main>
  <form method="POST" action="viewAnalyticReportHR.php" id="filterForm">
    <br>
    <label>Department:</label>
    <select class="form-control" name='deptName' id='deptName'>
      <option value='All Departments' <?php if ($_POST['deptName'] == 'All Departments') echo 'selected'; ?>>All Departments</option>
      <?php
      while ($row = mysqli_fetch_assoc($deptName)) {
        $selected = '';
        if ($_POST['deptName'] == $row['deptName']) {
          $selected = 'selected';
        }
        echo "<option value='$row[deptName]' $selected>$row[deptName]
          </option>";
      }

      ?>
    </select>


    <?php

    echo "<table class='table'>";
    echo "
        <tr>
        <th>Date</th>
        <th>FWA Status</th>
        <th>Department Name</th>
        <th>Total</th>
        </tr>";

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $deptName = $row['deptName'];
        $fwaStatus = $row['workType'];
        $total = $row['total'];
        $requestDate = $row['requestDate'];

        echo "
            <tr>
            <td><a href='viewAnalyticDetailsHR.php?date=$requestDate&workType=$fwaStatus&deptName=$deptName'>$requestDate</a></td>
            <td>$fwaStatus</td>
            <td>$deptName</td>
            <td>$total</td>
            </tr>";
      }
    } else {
      echo "<tr><td colspan='3'>No data found</td></tr>";
    }
    echo "</table>";

    ?>
    <br><br>
  </form>
    <hr>
  <?php

  //sql for searching date
  $schedule = "SELECT * FROM dailyschedule
  INNER JOIN employee ON dailyschedule.employeeID = employee.employeeID
  INNER JOIN department ON employee.deptID = department.deptID";
  $scheduleFetch = mysqli_query($db, $schedule);

  if (isset($_GET['start-date']) && isset($_GET['end-date'])) {
    // Get start and end dates from form input
    $startDate = $_GET['start-date'];
    $endDate = $_GET['end-date'];
    // Add date range filter to SQL query
    $schedule .= " WHERE date BETWEEN '$startDate' AND '$endDate'";
  }

  if (isset($_GET['deptName'])) {
    // Get selected department from form input
    $deptName = $_GET['deptName'];
    // Add department filter to SQL query
    $schedule .= " AND department.deptName = '$deptName'";
  }

  $schedule .= " ORDER BY date ASC";
  $scheduleFetch = mysqli_query($db, $schedule);
  ?>

  <main class="container">

    <form method="GET" action="viewAnalyticReportHR.php" id="filterForm">
      <div class="row">
      <h1>View Employee Schedule</h1>
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
          <div class="form-group">
            <label for="deptName">Department:</label>
            <select name="deptName" id="deptName" class="form-control">
              <option value="">-- Select Department --</option>
              <?php
              // Query the departments table to get a list of all departments
              $deptQuery = "SELECT * FROM department";
              $deptResult = mysqli_query($db, $deptQuery);
              while ($deptRow = mysqli_fetch_assoc($deptResult)) {
                // Output a select option for each department
                echo '<option value="' . $deptRow['deptName'] . '"';
                if (isset($_GET['deptName']) && $_GET['deptName'] == $deptRow['deptName']) {
                  echo ' selected';
                }
                echo '>' . $deptRow['deptName'] . '</option>';
              }
              ?>
            </select>
            <br>
            <button type="submit" class="btn btn-primary btn-block col-sm-3" name="search" id="search">Search</button>
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
    </div>
  </main>

  <script>
    // Add an event listener to the department select dropdown
    document.getElementById("deptName").addEventListener("change", function() {
      // Submit the form to reload the page with the selected department filtered
      document.getElementById("filterForm").submit();
    });
  </script>

  <?php
  include('footer.php');
  ?>