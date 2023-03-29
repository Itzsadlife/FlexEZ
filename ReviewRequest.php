<?php
session_start();
include 'headerSupervisor.php';
include 'db.php'
?>

<main>
<div class="form-group">
    <label for="statusFilter">Filter by status:</label>
    <select class="form-control" id="statusFilter">
        <option value="">All</option>
        <option value="Accept">Accept</option>
        <option value="Reject">Reject</option>
        <option value="Pending">Pending</option>
    </select>
</div>


    <table class='table'>
        <thead>
            <th>EmployeeID</th>
            <th>RequestID</th>
            <th>Employee Name</th>
            <th>Request Status</th>
            <th>Request Type</th>
            <th></th>
        </thead>
        <?php
        $whereClause = "WHERE 1=1"; // initialize the WHERE clause
        if (isset($_GET['status']) && $_GET['status'] !== '') { // check if the status filter is set
            $selectedStatus = $_GET['status'];
            $whereClause .= " AND request.FWAstatus = '$selectedStatus'";
        }

        $sql = "SELECT request.*, employee.*, request.FWAstatus AS 'status'
        FROM request
        JOIN employee ON request.employeeID = employee.employeeID
        $whereClause";
        $result = mysqli_query($db, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $statusColor = "";
            if ($row['status'] == "Accept") {
                $statusColor = "green";
            } elseif ($row['status'] == "Reject") {
                $statusColor = "red";
            } elseif ($row['status'] == "Pending")
                $statusColor = "blue";
            echo
            "
        <tr>
        <td><a href='RequestDetail.php?id=$row[employeeID]&rID=$row[requestID]&workType=$row[workType]'>$row[employeeID]</a></td>
        <td>$row[requestID]</td>
        <td>$row[name]</td>
        <td style='color: $statusColor'>$row[status]</td>
        <td>$row[workType]</td>
        
        ";
        }
        ?>
    </table>
    <button class="btn btn-primary btn-block col-sm-3"><a href="supervisorDashBoard.php" style="color:white">Back To Home</a></button>
    <br>
</main>
<script>
    document.getElementById('statusFilter').addEventListener('change', function() {
        var selectedStatus = this.value;
        window.location.href = "ReviewRequest.php?status=" + selectedStatus; // redirect to the same page with the selected status as a query parameter
    });

    // set the selected status in the filter dropdown
    var selectedStatus = '<?php echo isset($_GET['status']) ? $_GET['status'] : '' ?>';
    if (selectedStatus !== '') {
        document.getElementById('statusFilter').value = selectedStatus;
    }
</script>
<?php
include 'footer.php'
?>
