<?php 
include 'db.php'; 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="PorSie.css">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" 
         integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    </head>
    <body>
        <div class="logoBanner">
            <img src="img/logo.jpg" alt="FlexEZ">
        </div>
        <div class="colorDiv"></div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-3 bg-secondary sticky-top">
                    <nav>
                        <div class="row row-cols-5 row-cols-md-1">
                            <div class="col py-3 text-center text-md-left">Menu</div>
                            <div class="col py-3 text-center text-md-left"><a href="RegisterEmployee.php">Register Employee</a></div>
                            <div class="col py-3 text-center text-md-left"><a href="viewAnalyticReportHR.php">View FWA Analytics</a></div>
                            <div class="col py-3 text-center text-md-left"><a href="logout.php">Logout</a></div>
                        </div>
                    </nav>
                </div>
                <div class="col-md-7 bg-light">