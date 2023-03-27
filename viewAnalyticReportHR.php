  <?php
  include('headerHR.php');
  include('db.php');
  ?>

  <title>FlexEZ | Analytic Report</title>
  <main>
    <form method="GET" action="viewAnalyticReportHR.php" id="filterForm">
      <?php
      // Select distinct department names from the department table
      $sql = "SELECT DISTINCT deptName FROM department WHERE deptID != 'D0003'";
      $result = mysqli_query($db, $sql);



      ?>
      <br><br>
      <select name="deptSelect" id="deptSelect">
        <option value="">Select Department</option>
        <?php
        while ($dept = mysqli_fetch_assoc($result)) {
          // Display each department as an <option> in the <select> dropdown
          echo "<option value='$dept[deptName]'>$dept[deptName]</option>";
        }
        ?>
      </select>
      <br>
      <br>
      <?php
      echo "
      <table class='table'>
          <thead>
            <tr>
              <th scope='col'>FWA Status</th>
              <th scope='col'>Department</th>
              <th scope='col'>Total</th>
            </tr>
          </thead>
      ";
      // Run the query again, this time filtering by the selected department (if any)
      $deptFilter = isset($_GET['deptSelect']) ? $_GET['deptSelect'] : '';
      $deptFilterClause = $deptFilter ? "AND department.deptName = '$deptFilter'" : '';

      $sql = "SELECT employee.*, department.* 
          FROM employee, department 
          WHERE employee.deptID = department.deptID
          AND department.deptName = '$deptFilter' 
          AND employee.employeeID NOT LIKE 'S%' 
          AND employee.employeeID NOT LIKE 'H%'
          AND employee.FWAstatus <> 'NEW'
          AND employee.FWAstatus <> 'NONE'
          ";




      $result = mysqli_query($db, $sql);
      $result2 = mysqli_query($db, $sql . " GROUP BY employee.FWAstatus");

      $workFromHome = 0;
      $Hybrid = 0;
      $FlexiHours = 0;

      while ($dept = mysqli_fetch_assoc($result)) {
        if ($dept['FWAstatus'] == 'Work From Home') {
          $workFromHome = $workFromHome + 1;
        } else if ($dept['FWAstatus'] == 'Hybrid') {
          $Hybrid = $Hybrid + 1;
        } else if ($dept['FWAstatus'] == 'FlexiHours') {
          $FlexiHours = $FlexiHours + 1;
        }
      }

      while ($dept = mysqli_fetch_assoc($result2)) {
        echo "<tr>
          <td>$dept[FWAstatus]</td>        
          <td>$dept[deptName]</td>";

        if ($dept['FWAstatus'] == 'Work From Home') {
          echo "<td>$workFromHome</td>";
        } else if ($dept['FWAstatus'] == 'Hybrid') {
          echo "<td>$Hybrid</td>";
        } else if ($dept['FWAstatus'] == 'FlexiHours') {
          echo "<td>$FlexiHours</td>";
        }

        echo "</tr>";
      }
      echo "</table>
          <br><br>
          <br><br>
      ";
      ?>
    </form>

    <form action="viewAnalyticReportHR.php" method="GET">
      <div class="row">
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
        <div class="col-sm-3">
          <button type="submit" class="btn btn-primary btn-block" name="search" id="search">Search</button>
        </div>
      </div>
      <br><br>
      <?php
      $sql = "SELECT * FROM request";
      if (isset($_GET['start-date']) && isset($_GET['end-date'])) {
        // Get start and end dates from form input
        $startDate = $_GET['start-date'];
        $endDate = $_GET['end-date'];
        // Add date range filter to SQL query
        $sql .= " WHERE requestDate BETWEEN '$startDate' AND '$endDate'";
      }
      $result = mysqli_query($db, $sql);
      $result2 = mysqli_query($db, $sql . " GROUP BY request.workType");
      ?>
      <?php
      $wfh = 0;
      $hb =0;
      $fh =0;
      // FWArequest table
      echo "<table class='table'>
          <thead>
            <tr>
              <th scope='col'>FWA Request</th>
              <th scope='col'>Request Date</th>
              <th scope='col'>Total</th>
            </tr>
          </thead>
        ";
      ?>

      <?php
      while ($dept = mysqli_fetch_assoc($result)) {
        if ($dept['workType'] == 'Work From Home') {
          $wfh = $wfh + 1;
        } else if ($dept['workType'] == 'Hybrid') {
          $hb = $hb + 1;
        } else if ($dept['workType'] == 'Flexi Hours') {
          $fh = $fh + 1;
        }
      }

      while ($dept = mysqli_fetch_assoc($result2)) {
        echo "<tr>
          <td>$dept[workType]</td>        
          <td>$dept[requestDate]</td>";

        if ($dept['workType'] == 'Work From Home') {
          echo "<td>$wfh</td>";
        } else if ($dept['workType'] == 'Hybrid') {
          echo "<td>$hb</td>";
        } else if ($dept['workType'] == 'Flexi Hours') {
          echo "<td>$fh</td>";
        }

        echo "</tr>";
      }
      echo "</table>";
      ?>
    </form>

  </main>

  <script>
    // Add an event listener to the department select dropdown
    document.getElementById("deptSelect").addEventListener("change", function() {
      // Submit the form to reload the page with the selected department filtered
      document.getElementById("filterForm").submit();
    });
  </script>

  <?php
  include('footer.php');
  ?>