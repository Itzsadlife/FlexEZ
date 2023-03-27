<?php
session_start();
include 'headerSupervisor.php';
include 'db.php';
?>
<main>
    <table class='table'>
    <thead>
        <th>EmployeeID</th>
        <th>RequestID</th>
        <th>Employee Name</th>
        <th>Request Status</th>
        <th>Request Type</th>
        <th>Description</th>
        <th>Reason</th>
        <th></th>
    </thead>
    
    <form method="POST" action="submitRequestdb.php?<?php echo "id=$_GET[id]&rID=$_GET[rID]"?>">
<?php
    $sql = "SELECT request.*, employee.*, request.FWAstatus AS 'status'
    FROM request
    JOIN employee ON request.employeeID = employee.employeeID 
    WHERE employee.employeeID='$_GET[id]'";
    $result = mysqli_query($db,$sql);
    while($row=mysqli_fetch_assoc($result)){
        $statusColor = "";
        if($row['status'] == "Accept"){
            $statusColor = "green";
        } elseif($row['status'] == "Reject"){
            $statusColor = "red";
        }
        elseif($row['status']=="Pending")
            $statusColor="blue";
        echo
        "
        <tr>
        <td>$row[employeeID]</a></td>
        <td>$row[requestID]</td>
        <td>$row[name]</td>
        <td style='color: $statusColor'>$row[status]</td>
        <td>$row[workType]</td>
        <td>$row[description]</td>
        <td>$row[reason]</td>
        ";
        if($row['status']=="Pending"){
        echo"
        <td><select name='status'>
            <option value='Accept'>Accept</option>
            <option value='Reject'>Reject</option>
            </select>
        </td>
        ";
    }
}
?>
    
    </table>
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
</main>

<?php
include 'footer.php';
?>