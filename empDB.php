<?php
include("db.php");

$query = "SELECT * FROM employee";
if($result = mysqli_query($db, $query)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
                $row['employeeID'] ;
                $row['name'];
                $row['position'] ;
                $row['SupervisorID'];
           
        }
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
}