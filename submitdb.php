<?php 
    
    include "db.php";
session_start(); 
$employeeID = $_SESSION['employeeID'];

// generate a random ID
$randomID = 'R' . str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT);

// check if the ID already exists in the database

$sql = "SELECT * FROM request WHERE requestID = '$randomID'";
$checkingResult = mysqli_query($db, $sql);

if(mysqli_num_rows($checkingResult) > 0) {
    // the ID already exists in the database, regenerate the ID
    $randomID = 'R' . str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT);
}

if(isset($_POST['submit'])){

// Set the timezone to Malaysia
date_default_timezone_set('Asia/Kuala_Lumpur');

// Get the current date in the format of "DD-MM-YYYY"
$localDate = date('d-m-Y');

// Convert the local date format to "YYYY-MM-DD"
$convertedDate = date('Y-m-d', strtotime($localDate));


$workType= $_POST['workType']; // Retrieve the ID value from the form
$Description = $_POST['description']; // Retrieve the name value from the form
$Reason = $_POST['Reason']; // Retrieve the name value from the form

$query = "INSERT INTO request (requestID, employeeID, requestDate, workType, description, reason, FWAstatus)
            VALUES ('$randomID', '$employeeID', '$convertedDate', '$workType', '$Description', '$Reason', 'Pending')";

$result=mysqli_query($db,$query);
}
?>